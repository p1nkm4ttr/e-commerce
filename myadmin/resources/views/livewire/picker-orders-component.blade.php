<div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>My Assigned Orders</h4>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>#{{ $order['id'] ?? 'N/A' }}</td>
                                                <td>{{ $order['customer_name'] ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-warning">
                                                        Ready to Pick
                                                    </span>
                                                </td>
                                                <td>{{ $order['items_count'] ?? 0 }}</td>
                                                <td>${{ number_format($order['total_amount'] ?? 0, 2) }}</td>
                                                <td>{{ isset($order['created_at']) ? \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-primary" wire:click="startPicking({{ $order['id'] }})">
                                                            Pick
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No orders assigned to you</td>
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

        @if($showModal)
            <div class="modal fade show" style="display: block" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pick Order #{{ $selectedOrder->id }}</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Scan Barcode</label>
                                <input type="text" class="form-control" id="barcodeInput" 
                                       wire:model.live="scannedBarcode" autofocus>
                                @if($errorMessage)
                                    <div class="text-danger mt-2">{{ $errorMessage }}</div>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Required Quantity</th>
                                            <th>Picked Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($selectedOrder->items_with_details as $item)
                                            <tr>
                                                <td>
                                                    @if($item['image'])
                                                        <img src="{{ $item['image'] }}" 
                                                             alt="{{ $item['name'] }}"
                                                             class="img-thumbnail me-2"
                                                             style="max-width: 50px; height: auto;">
                                                    @endif
                                                    {{ $item['name'] }}
                                                </td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td>
                                                    {{ isset($pickedItems[$item['product_id']]) 
                                                        ? $pickedItems[$item['product_id']]['picked_qty'] 
                                                        : 0 
                                                    }}
                                                </td>
                                                <td>
                                                    @if(isset($pickedItems[$item['product_id']]) && 
                                                        $pickedItems[$item['product_id']]['picked_qty'] >= $item['quantity'])
                                                        <span class="badge bg-success">Complete</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                Close
                            </button>
                            <button type="button" class="btn btn-success" 
                                    wire:click="completeOrder({{ $selectedOrder->id }})"
                                    {{ !$this->allItemsPicked() ? 'disabled' : '' }}>
                                Complete Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </div>
</div>

<script>
    let barcodeBuffer = '';
    let lastKeyTime = Date.now();

    
    document.addEventListener('keydown', function(e) {
        const currentTime = Date.now();
        
        
        if (currentTime - lastKeyTime > 50) {
            barcodeBuffer = '';
        }
        
        lastKeyTime = currentTime;

        
        if (e.key === 'Enter') {
            e.preventDefault();
            
            
            if (!barcodeBuffer) {
                const input = document.getElementById('barcodeInput');
                barcodeBuffer = input.value;
            }
            
            
            if (document.querySelector('.modal.show') && barcodeBuffer) {
                const componentId = document.querySelector('[wire\\:id]').getAttribute('wire:id');
                Livewire.find(componentId).set('scannedBarcode', barcodeBuffer);
                Livewire.find(componentId).scanItem();
                
                
                barcodeBuffer = '';
                document.getElementById('barcodeInput').value = '';
            }
            return;
        }

        
        if (e.key.length === 1) {
            barcodeBuffer += e.key;
        }
    });

    
    window.addEventListener('livewire:load', function () {
        Livewire.on('showModal', function () {
            setTimeout(function() {
                document.getElementById('barcodeInput').focus();
            }, 100);
        });
    });
</script>