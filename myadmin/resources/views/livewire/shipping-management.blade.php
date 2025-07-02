<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Assign Orders for Shipping</h5>
                    
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Order Numbers (one per line)</label>
                            <textarea 
                                class="form-control" 
                                rows="4"
                                wire:model="selectedOrders"
                                placeholder="Enter order numbers, one per line"
                            ></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Select Rider</label>
                            <select class="form-select" wire:model="selectedRider">
                                <option value="">Choose a rider...</option>
                                @foreach($availableRiders as $rider)
                                    <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                @endforeach
                            </select>
                            
                            <button 
                                class="btn btn-primary mt-3 w-100" 
                                wire:click="assignRider"
                            >
                                Assign Orders
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ready for Shipping</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Assigned Rider</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->items_count }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'shipped' ? 'primary' : 'secondary' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $order->rider ? $order->rider->name : 'Unassigned' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No orders ready for shipping</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>