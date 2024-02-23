<?php

namespace App\Http\Livewire\Dashboard\Categories;

use App\Models\Category;
use App\Models\FaqItem;
use App\Models\Post;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoriesTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = Category::class;

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
        return Category::query()
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Items", "id")->format(function ($value, $category, $column) {

                if($category->model == Product::class) {
                    return $category->products->count();
                }

                if($category->model == Post::class) {
                    return $category->posts->count();
                }

                if($category->model == FaqItem::class) {
                    return $category->faqItems->count();
                }

                return 0;

            }),
            Column::make("Model", "model")
                ->searchable(),
            Column::make("Actions", "id")->format(function ($value, $row, $column) {

                $category = Category::find($value);

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $value . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="' . route('dashboard.categories.edit', $category->slug) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                return $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(Category $item): void
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

            if($this->itemToBeDeleted->posts->count() || $this->itemToBeDeleted->products->count() || $this->itemToBeDeleted->faqItems->count()) {
                $this->alert('error', 'This category has items assigned to it, can not be deleted.');
            } else {
                $this->itemToBeDeleted->delete();
                $this->alert('success', 'Item successfully deleted.', [
                    'position' => 'top-end',
                    'timer' => 5000,
                    'toast' => true,
                ]);

            }

        }


    }


}
