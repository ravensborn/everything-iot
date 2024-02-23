<?php

namespace App\Http\Livewire\Dashboard\SupportRequestItems;

use App\Models\SupportRequestItem;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SupportRequestItemsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = SupportRequestItem::class;

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
        return SupportRequestItem::query();
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("E-Mail", "email")
                ->searchable(),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Message", "message")
                ->searchable(),

            Column::make("Read", "read")
                ->format(function ($value) {
                    return $value ? 'Yes' : 'No';
                })
                ->html(),

            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $item, $column) {

                $markAsRead = '<button wire:click="markAsRead(' . $item->id . ')"  class="btn btn-info btn-sm me-1"><i class="bi bi-check2"></i></button>';
                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $item->id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';

                if (!$item->read) {
                    return $markAsRead . $deleteBtn;
                }

                return $deleteBtn;

            })->html(),

        ];
    }

    public function markAsRead($id): void
    {

        $item = SupportRequestItem::find($id);
        $item->update([
            'read' => true,
        ]);

        $this->alert('success', 'Successfully marked as read.');
    }


    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(SupportRequestItem $item): void
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
