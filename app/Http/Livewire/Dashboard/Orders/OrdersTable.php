<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Order;
use Lwwcas\LaravelCountries\Models\Country;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrdersTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableAttributes([
            'class' => 'table-sm table-bordered',
        ]);

    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Order::query()->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Number", "number")->searchable(),
            Column::make("User", "user.email")
                ->searchable()
                ->sortable(),
            Column::make("Country", "lc_country_id")->format(function ($id, $row) {

                $country = Country::find($id);

                if($country) {
                    return $country->iso_alpha_3;
                }

                return '';
            })
                ->sortable(),
            Column::make("Status", "status")
                ->format(function ($value, $row, $column) {
                    return "<span class='badge bg-" . $row->getStatusColorAndIcon()['color'] . "'>" . $row->getStatusName() . "</span>";
                })->html()
                ->sortable(),

            Column::make("Total", "total")
                ->format(function ($value, $row, $column) {
                    return '$' . number_format($value, 2);
                })->html()
                ->sortable(),

            Column::make("Created at", "created_at")
                ->format(function ($value, $row, $column) {
                    if ($value) {
                        return $value->format('d-m-Y / h:i A');
                    }
                    return '';
                })->html()
                ->sortable(),
            Column::make("Actions", "id")->format(function ($value, $row, $column) {

                $order = Order::find($value);

                $viewBtn = '<a href="'. route('dashboard.orders.show', $order->id) .'" class="btn btn-info btn-sm me-1"><i class="bi bi-list"></i> View</a>';
                $userBtn = '<a href="'. route('dashboard.users.show', ['user' => $order->user_id]) .'" class="btn btn-success btn-sm me-1"><i class="bi bi-person"></i> User</a>';

                return $viewBtn . $userBtn;
            })->html(),

        ];
    }
}
