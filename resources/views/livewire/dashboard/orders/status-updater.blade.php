<div>

    Current Status:
    <span class="badge bg-{{ $order->getStatusColorAndIcon()['color'] }}">
                                {{ $order->getStatusName() }}
    </span>

    <div class="row g-3 mt-1 align-items-center">
        <div class="col-auto">
            <label for="status_id" class="col-form-label">Update Status</label>
        </div>
            <div class="col-auto">
                <select class="form-control form-control-sm" id="status_id" wire:model="status_id">
                    @foreach($statusArray as $status)
                        <option value="{{ $status }}">{{ \App\Models\Order::processStatusName($status) }}</option>
                    @endforeach
                </select>
            </div>
            </div>


        </div>
