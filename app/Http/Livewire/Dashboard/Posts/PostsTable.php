<?php

namespace App\Http\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class PostsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = Post::class;

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Category')
                ->options(
                    Category::query()
                        ->where('model', $this->model)
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn($category) => $category->name)
                        ->toArray()
                )->filter(function (Builder $builder, $value) {
                    $builder->whereIn('category_id', $value);
                }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-sm table-bordered',
        ]);
        $this->setTableWrapperAttributes([
            'class' => 'table-responsive'
        ]);

    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Post::query()
            ->with(['visitLogs', 'author'])
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Title", "title")
                ->searchable(),
            Column::make("Author", "author.name")
                ->searchable(),
            Column::make("Category", "category.name")
                ->searchable(),
            Column::make("Hidden", "is_hidden")
                ->format(function ($value, $row, $column) {
                    return $value ? 'Yes' : 'No';
                })->searchable(),
            Column::make("Views", "id")
                ->format(function ($value, $row, $column) {
                    return count($row->visitLogs);
                }),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $row, $column) {

                $post = Post::find($value);

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $value . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="'. route('dashboard.posts.edit', $post->slug) .'" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                $mediaManagerBtn = '<a href="'. route('dashboard.posts.media-manager', $post->slug) .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> Media Manager</a>';
                $viewBtn = '<a target="_bank" href="'. route('posts.show', $post->slug) .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> View on website</a>';

                return $viewBtn . $mediaManagerBtn . $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(Post $item): void
    {
        $this->confirm('Are you sure that you want to delete this item?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'deleteItem'
        ]);

        $this->itemToBeDeleted = $item;
    }

    public function deleteItem(): void
    {
        if ($this->itemToBeDeleted) {
            $this->itemToBeDeleted->delete();
        }

        $this->alert('success', 'Item successfully deleted.', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);

    }


}
