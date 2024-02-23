<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Lwwcas\LaravelCountries\Models\Country;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{

    use LivewireAlert;

    protected $model = User::class;


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
        return User::query()->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id"),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("E-Mail", "email")
                ->sortable()
                ->searchable(),
            Column::make("Phone", "phone_number")
                ->sortable()
                ->searchable(),
            Column::make("Country", "lc_country_id")
                ->format(function ($value, $row, $column) {
                    return Country::find($value)->iso_alpha_3;
                })
                ->html(),
            Column::make("Verified at", "email_verified_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html()
                ->sortable(),

            Column::make("Actions", "id")->format(function ($id, $row, $column) {



                $user = User::find($id);

                $userOrdersUrl = route('dashboard.orders.index') . '?table[search]=' . urlencode($user->email);

                if ($user->isBanned()) {

                    $banBtn = '<button wire:click="toggleBan(' . $id . ')" class="btn btn-danger btn-sm me-1"><i class="bi bi-lock"></i></button>';
                } else {

                    $banBtn = '<button wire:click="toggleBan(' . $id . ')" class="btn btn-success btn-sm me-1"><i class="bi bi-unlock"></i></button>';
                }
                $editBtn = '<a href="' . route('dashboard.users.edit', $id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pen"></i></a>';
                $viewBtn = '<a href="'. route('dashboard.users.show', $id) .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> View</a>';
                $ordersBtn = '<a href="'. $userOrdersUrl .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> Orders</a>';

                return $ordersBtn . $viewBtn . $editBtn . $banBtn;

            })->html(),

        ];
    }

    public function toggleBan(User $user): void
    {
        $user->isBanned() ? $user->unban() : $user->ban();
    }


}
