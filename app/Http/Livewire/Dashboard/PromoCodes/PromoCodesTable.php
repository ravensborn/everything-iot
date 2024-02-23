<?php

namespace App\Http\Livewire\Dashboard\PromoCodes;


use App\Models\PromoCode;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PromoCodesTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = PromoCode::class;

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
        return PromoCode::query()
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Code", "code")
                ->searchable(),
            Column::make("Uses", "uses")
                ->searchable(),
            Column::make("Max uses", "max_uses")
                ->searchable(),
            Column::make("Discount amount", "discount_amount")
                ->searchable(),
            Column::make("Discount type", "discount_type")
                ->searchable(),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $promoCode, $column) {

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $promoCode->id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';

                return $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(PromoCode $item): void
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
