<?php

namespace App\Http\Livewire\Dashboard\Partners;

use App\Models\Partner;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PartnersTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = Partner::class;

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
        return Partner::query()
            ->orderBy('order');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->searchable(),

            Column::make("Visible", "is_visible")
                ->format(function($value) {
                    return $value ? 'Yes' : 'No';
                })->html(),

            Column::make("Position", "order")
                ->searchable(),

            Column::make("Actions", "id")->format(function ($id, $row, $column) {

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="' . route('dashboard.partners.edit', $id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                $moveUpBtn = '<button wire:click="moveUp('. $id .')" class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-up"></i></button>';
                $moveDownBtn = '<button wire:click="moveDown('. $id .')"  class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-down"></i></button>';
                return $moveUpBtn . $moveDownBtn . $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public function moveUp($partnerId): void
    {
        $partner = Partner::find($partnerId);
        if ($partner) {
            $previousPartner = Partner::where('order', '<', $partner->order)
                ->orderBy('order', 'desc')
                ->first();

            if ($previousPartner) {
                $this->swapOrder($partner, $previousPartner);
            }
        }
    }
    public function moveDown($partnerId): void
    {
        $partner = Partner::find($partnerId);
        if ($partner) {
            $nextPartner = Partner::where('order', '>', $partner->order)
                ->orderBy('order')
                ->first();

            if ($nextPartner) {
                $this->swapOrder($partner, $nextPartner);
            }
        }
    }

    private function swapOrder($partner1, $partner2): void
    {
        $order1 = $partner1->order;
        $order2 = $partner2->order;

        $partner1->update(['order' => $order2]);
        $partner2->update(['order' => $order1]);
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(Partner $item): void
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
            $this->alert('success', 'Item successfully deleted.', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);

        }


    }


}
