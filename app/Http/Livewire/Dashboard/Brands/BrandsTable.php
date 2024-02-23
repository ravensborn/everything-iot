<?php

namespace App\Http\Livewire\Dashboard\Brands;

use App\Models\Brand;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BrandsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = Brand::class;

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
        return Brand::query()
            ->with(['products'])
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Display on Website", "is_displayable_on_website")
                ->format(function ($value, $row, $column) {
                    return $value ? 'Yes' : 'No';
                })->searchable(),
            Column::make("Items", "id")->format(function ($value, $brand, $column) {
                return $brand->products->count();
            }),
            Column::make("Actions", "id")->format(function ($value, $row, $column) {

                $brand = Brand::find($value);

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $value . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="' . route('dashboard.brands.edit', $brand->slug) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                return $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(Brand $item): void
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

            if($this->itemToBeDeleted->products->count()) {
                $this->alert('error', 'This brand has items assigned to it, can not be deleted.');
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
