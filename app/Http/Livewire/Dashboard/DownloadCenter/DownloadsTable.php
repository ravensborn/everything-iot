<?php

namespace App\Http\Livewire\Dashboard\DownloadCenter;

use App\Models\DownloadableFile;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DownloadsTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = DownloadableFile::class;

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
        return DownloadableFile::query()
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Description", "description"),
            Column::make("Download", "id")->format(function ($id, $row) {
                $file = DownloadableFile::find($id);
                return '<a href="' . $file->getFirstMediaUrl('files') . '" download><i class="bi bi-download"></i> Download now</a>';
            })->html(),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html(),
            Column::make("Actions", "id")->format(function ($value, $file, $column) {

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $file->id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                return  $deleteBtn;
            })->html(),

        ];
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(DownloadableFile $item): void
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
