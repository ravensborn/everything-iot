<?php

namespace App\Http\Livewire\Dashboard\Comments;


use App\Models\Comment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CommentsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = Comment::class;

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

    public function approveComment(Comment $comment) {
        $comment->update([
            'is_approved' => true
        ]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Comment::query()
            ->with(['post', 'user'])
            ->orderBy('is_approved')
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Content", "content")
                ->searchable(),
            Column::make("Name", "user.name")
                ->searchable(),
            Column::make("E-Mail", "user.email")
                ->searchable(),
            Column::make("Post title", "post.title")
                ->searchable(),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $comment, $column) {

                $comment = Comment::find($comment->id);

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $comment->id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                if(!$comment->is_approved) {
                    $approveBtn = '<button wire:click="approveComment(' . $comment->id . ')"  class="btn btn-success btn-sm me-1"><i class="bi bi-check2"></i> Approve</button>';
                } else {
                    $approveBtn = '<button class="btn btn-secondary btn-sm me-1"><i class="bi bi-check2"></i> Approved</button>';
                }
                $viewBtn = '<a target="_bank" href="'. route('posts.show', $comment->post->slug) .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> View post</a>';

                return $viewBtn . $approveBtn . $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(Comment $item): void
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
