<div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Orders</h4>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        @if($loading)
                            <div class="text-center p-4">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Picker</th>
                                            <th>Packer</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>#{{ $order['id'] ?? 'N/A' }}</td>
                                                <td>{{ $order['customer_name'] ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ 
                                                        $order['status'] === 'completed' ? 'success' : 
                                                        ($order['status'] === 'ready_to_pick' ? 'warning' :
                                                        ($order['status'] === 'picked' ? 'info' :
                                                        ($order['status'] === 'ready_to_pack' ? 'primary' : 'secondary')))
                                                    }}">
                                                        {{ ucfirst(str_replace('_', ' ', $order['status'] ?? 'Unknown')) }}
                                                    </span>
                                                </td>
                                                <td>{{ $order['items_count'] ?? 0 }}</td>
                                                <td>${{ number_format($order['total_amount'] ?? 0, 2) }}</td>
                                                <td>{{ isset($order['created_at']) ? \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                                <td>
                                                    @if(isset($order['picker']) && $order['picker'])
                                                        {{ $order['picker']['name'] ?? 'Unknown' }}
                                                    @else
                                                        Unassigned
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($order['packer']) && $order['packer'])
                                                        {{ $order['packer']['name'] ?? 'Unknown' }}
                                                    @else
                                                        Unassigned
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        @if($order['status'] === 'placed')
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                    Assign Picker
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @foreach($availablePickers as $picker)
                                                                        <li><a class="dropdown-item" href="#" wire:click.prevent="assignPicker({{ $order['id'] }}, {{ $picker->id }})">
                                                                            {{ $picker->name }}
                                                                        </a></li>
                                                                    @endforeach
                                                                    @if($availablePickers->isEmpty())
                                                                        <li><span class="dropdown-item text-muted">No available pickers</span></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        @elseif($order['status'] === 'picked')
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                    Assign Packer
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @foreach($availablePackers as $packer)
                                                                        <li><a class="dropdown-item" href="#" wire:click.prevent="assignPacker({{ $order['id'] }}, {{ $packer->id }})">
                                                                            {{ $packer->name }}
                                                                        </a></li>
                                                                    @endforeach
                                                                    @if($availablePackers->isEmpty())
                                                                        <li><span class="dropdown-item text-muted">No available packers</span></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <button class="btn btn-sm btn-primary" wire:click="viewOrder({{ $order['id'] }})">
                                                            View
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No orders found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($error)
            <div class="alert alert-danger mt-3">
                {{ $error }}
                <button wire:click="syncOrders" class="btn btn-sm btn-outline-danger ms-2">
                    Try Again
                </button>
            </div>
        @endif

        @if($showModal)
            <div class="modal fade show" style="display: block" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order #{{ $selectedOrder->original_id }}</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-3">Order Information</h6>
                                    <p><strong>Date:</strong> {{ $selectedOrder->created_at->format('Y-m-d H:i:s') }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge bg-{{ $selectedOrder->status === 'completed' ? 'success' : 'primary' }}">
                                            {{ ucfirst($selectedOrder->status) }}
                                        </span>
                                    </p>
                                    <p><strong>Total Amount:</strong> ${{ number_format($selectedOrder->total_amount, 2) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-3">Customer Information</h6>
                                    <p><strong>Name:</strong> {{ $selectedOrder->customer_name }}</p>
                                    <p><strong>Email:</strong> {{ $selectedOrder->customer_email }}</p>
                                    <p><strong>Phone:</strong> {{ $selectedOrder->address['phone'] ?? 'N/A' }}</p>
                                    <h6 class="mb-2 mt-3">Shipping Address</h6>
                                    <address class="mb-0">
                                        {{ $selectedOrder->address['street'] ?? '' }}<br>
                                        {{ $selectedOrder->address['city'] ?? '' }}, {{ $selectedOrder->address['state'] ?? '' }} {{ $selectedOrder->address['zip_code'] ?? '' }}<br>
                                        {{ $selectedOrder->address['country'] ?? '' }}
                                    </address>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="mb-3">Order Items</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($selectedOrder->items_with_details as $item)
                                                    <tr>
                                                        <td>
                                                            @if($item['image'])
                                                                <img src="{{ $item['image'] }}" 
                                                                     alt="{{ $item['name'] }}"
                                                                     class="img-thumbnail"
                                                                     style="max-width: 50px; height: auto; object-fit: contain;">
                                                            @else
                                                                <div class="img-thumbnail text-center" 
                                                                     style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                                    <i class="fas fa-image text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['quantity'] }}</td>
                                                        <td>${{ number_format($item['price'], 2) }}</td>
                                                        <td>{{ $item['discount'] ?? 0 }}%</td>
                                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                                    <td><strong>${{ number_format($selectedOrder->total_amount, 2) }}</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif

        <style>
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.5);
            }
            
            .modal {
                background-color: rgba(0, 0, 0, 0.5);
            }

            .img-thumbnail {
                border: 1px solid #dee2e6;
                padding: 0.25rem;
                background-color: #fff;
                border-radius: 0.25rem;
                max-width: 50px;
                height: auto;
            }

            .gap-2 {
                gap: 0.5rem;
            }
            
            .d-flex {
                display: flex;
            }
            
            .dropdown-menu {
                min-width: 200px;
            }
        </style>
    </div>
</div>

<script>
    // Auto refresh every 30 seconds
    setInterval(function() {
        @this.loadOrders();
    }, 30000);
</script>