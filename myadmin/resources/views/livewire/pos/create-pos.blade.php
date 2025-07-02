<div class="pos-component" wire:id="pos-component">
    <style>
        .header-section {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .store-info {
            display: flex;
            gap: 20px;
        }
        .till-info {
            background-color: #6f42c1;
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
        }
        .main-content {
            display: flex;
            height: calc(100vh - 60px);
            overflow: hidden;
        }
        .products-section {
            flex: 2;
            padding: 20px;
            overflow-y: auto;
        }
        .cart-section {
            flex: 1;
            background-color: white;
            border-left: 1px solid #dee2e6;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-width: 400px;
        }
        .cart-items {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .cart-footer {
            position: sticky;
            bottom: 0;
            background-color: white;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table th, .order-table td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }
        .summary-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .payment-button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            margin-top: 20px;
        }
        .product-card {
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 3px;
        }
        .product-card:hover {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .quantity-btn {
            padding: 2px 8px;
            border: 1px solid #dee2e6;
            background: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        .remove-btn {
            color: #dc3545;
            cursor: pointer;
            padding: 4px 8px;
            border: none;
            background: none;
        }
    </style>

    <div class="header-section">
        <div class="store-info">
            <span>Store: Online Warehouse</span>
        </div>
        <div class="till-info">
            Till ID: 123
        </div>
    </div>

    <div class="main-content">
        <div class="products-section">
            <div class="search-container">
                <input 
                    type="text" 
                    id="barcode-input"
                    wire:model.live="search" 
                    class="search-bar" 
                    placeholder="Enter or Scan Product Barcode"
                    autocomplete="off"
                    autofocus
                >
            </div>
            
            <div class="products-grid">
                @foreach($searchResults as $product)
                <div class="product-card" wire:click="addToCart({{ $product->id }})">
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Rs. {{ number_format($product->price, 2) }}</span>
                        <span>Stock: {{ $product->qty }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="cart-section">
            <div class="cart-items">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $id }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>Rs. {{ number_format($item['price'], 2) }}</td>
                            <td>
                                <div class="quantity-control">
                                    <button class="quantity-btn" wire:click="decreaseQuantity({{ $id }})">-</button>
                                    <span>{{ $item['quantity'] }}</span>
                                    <button class="quantity-btn" wire:click="addToCart({{ $id }})">+</button>
                                </div>
                            </td>
                            <td>
                                <button class="remove-btn" wire:click="removeFromCart({{ $id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-footer">
                <div class="summary-section">
                    <h3>Order Totals</h3>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal</span>
                        <span>Rs. {{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Discount %</span>
                        <span>Rs. 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px; font-weight: bold;">
                        <span>Total</span>
                        <span>Rs. {{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <button class="payment-button" wire:click="processPayment">
                    Process Payment
                </button>
            </div>
        </div>
    </div>
</div>

@section('custom_script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        onScan.attachTo(document, {
            suffixKeyCodes: [13],
            reactToPaste: true,
            onScan: function(barcode) {
                console.log('Scanned barcode:', barcode);
                
                const input = document.getElementById('barcode-input');
                if (input) {
                    input.value = barcode;
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                    setTimeout(() => {
                        input.value = '';
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    }, 500);
                }
            },
            onScanError: function(error) {
                console.error('Scan error:', error);
            }
        });
    });
</script>
@endsection