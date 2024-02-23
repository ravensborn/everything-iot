<?php

namespace App\Http\Livewire\Dashboard\FaqItems;

use App\Models\Category;
use App\Models\FaqItem;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

class FaqItemsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = FaqItem::class;

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
        return FaqItem::query()
            ->orderBy('order');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Title", "Title")
                ->searchable(),
            Column::make("Category", "category.name"),

            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $file, $column) {

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $file->id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="' . route('dashboard.faq-items.edit', $value) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                $moveUpBtn = '<button wire:click="moveUp(' . $value . ')" class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-up"></i></button>';
                $moveDownBtn = '<button wire:click="moveDown(' . $value . ')"  class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-down"></i></button>';

                return $moveUpBtn . $moveDownBtn . $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public function moveUp($faqItemId): void
    {
        $faqItem = FaqItem::find($faqItemId);
        if ($faqItem) {
            $previousFaqItem = FaqItem::where('category_id', $faqItem->category_id)
                ->where('order', '<', $faqItem->order)
                ->orderBy('order', 'desc')
                ->first();

            if ($previousFaqItem) {
                $this->swapOrder($faqItem, $previousFaqItem);
            }
        }
    }

    public function moveDown($faqItemId): void
    {
        $faqItem = FaqItem::find($faqItemId);
        if ($faqItem) {
            $nextFaqItem = FaqItem::where('category_id', $faqItem->category_id)
                ->where('order', '>', $faqItem->order)
                ->orderBy('order')
                ->first();

            if ($nextFaqItem) {
                $this->swapOrder($faqItem, $nextFaqItem);
            }
        }
    }

    private function swapOrder($faqItem1, $faqItem2): void
    {
        $order1 = $faqItem1->order;
        $order2 = $faqItem2->order;

        $faqItem1->update(['order' => $order2]);
        $faqItem2->update(['order' => $order1]);
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(FaqItem $item): void
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
