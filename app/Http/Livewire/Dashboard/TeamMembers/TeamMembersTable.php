<?php

namespace App\Http\Livewire\Dashboard\TeamMembers;

use App\Models\TeamMember;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TeamMembersTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = TeamMember::class;

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
        return TeamMember::query()
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

            Column::make("Position", "position")
                ->searchable(),

            Column::make("Actions", "id")->format(function ($id, $row, $column) {

                $deleteBtn = '<button wire:click="triggerDeleteItem(' . $id . ')"  class="btn btn-danger btn-sm me-1"><i class="bi bi-trash"></i></button>';
                $editBtn = '<a href="' . route('dashboard.team-members.edit', $id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                $moveUpBtn = '<button wire:click="moveUp('. $id .')" class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-up"></i></button>';
                $moveDownBtn = '<button wire:click="moveDown('. $id .')"  class="btn btn-info btn-sm me-1"><i class="bi bi-arrow-down"></i></button>';
                return $moveUpBtn . $moveDownBtn . $editBtn . $deleteBtn;
            })->html(),

        ];
    }

    public function moveUp($teamMemberId): void
    {
        $teamMember = TeamMember::find($teamMemberId);
        if ($teamMember) {
            $previousTeamMember = TeamMember::where('order', '<', $teamMember->order)
                ->orderBy('order', 'desc')
                ->first();

            if ($previousTeamMember) {
                $this->swapOrder($teamMember, $previousTeamMember);
            }
        }
    }
    public function moveDown($teamMemberId): void
    {
        $teamMember = TeamMember::find($teamMemberId);
        if ($teamMember) {
            $nextTeamMember = TeamMember::where('order', '>', $teamMember->order)
                ->orderBy('order')
                ->first();

            if ($nextTeamMember) {
                $this->swapOrder($teamMember, $nextTeamMember);
            }
        }
    }

    private function swapOrder($teamMember1, $teamMember2): void
    {
        $order1 = $teamMember1->order;
        $order2 = $teamMember2->order;

        $teamMember1->update(['order' => $order2]);
        $teamMember2->update(['order' => $order1]);
    }

    public $itemToBeDeleted = null;

    protected $listeners = [
        'deleteItem',
        'refresh-items' => '$refresh',
    ];

    public function triggerDeleteItem(TeamMember $item): void
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

            if($this->itemToBeDeleted->posts->count() || $this->itemToBeDeleted->products->count()) {
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
