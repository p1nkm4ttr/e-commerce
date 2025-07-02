@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-4">
        <div style="padding: 20px;">
        <h2>Cart</h2>
        <div id="cart"></div>
        <div class="cart-summary" id="summary">Total: €0.00<br>Taxes: €0.00</div>
        </div>
    </div>
    <div class="col-lg-8">
        <div style="display:flex; justify-content: space-between; background-color: transparent; padding: 20px;;" class="header">
            <h1>Fruits and Vegetables</h1>
            <div class="search-bar">
                <input type="text" id="productSearch" placeholder="Search products...">
            </div>
        </div>
        <div style="padding: 20px;" class="products" id="productList">
            <div class="product" data-name="Black Grapes" data-barcode="111" data-price="2.36">
                <div class="price">2.36 €/Kg</div>
                <img src="https://via.placeholder.com/100x80?text=Grapes" alt="Black Grapes">
                <div class="product-name">Black Grapes</div>
            </div>
            <div class="product" data-name="Oranges" data-barcode="112" data-price="1.54">
                <div class="price">1.54 €/Kg</div>
                <img src="https://via.placeholder.com/100x80?text=Oranges" alt="Oranges">
                <div class="product-name">Oranges</div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('custom_scripts')
<script>
const searchInput = document.getElementById('productSearch');
    const productList = document.getElementById('productList');
    const cartContainer = document.getElementById('cart');
    const summary = document.getElementById('summary');

    const cart = {};

    function updateCart() {
      cartContainer.innerHTML = '';
      let total = 0;
      for (const [name, item] of Object.entries(cart)) {
        const div = document.createElement('div');
        div.className = 'cart-item';
        div.innerHTML = `
          ${name} (${item.qty}kg) 
          <span>€${(item.qty * item.price).toFixed(2)}</span>
          <button onclick="removeFromCart('${name}')" style="margin-left: 5px;">x</button>
        `;
        cartContainer.appendChild(div);
        total += item.qty * item.price;
      }
      const tax = total * 0.15;
      summary.innerHTML = `Total: €${total.toFixed(2)}<br>Taxes: €${tax.toFixed(2)}`;
    }

    function removeFromCart(name) {
      delete cart[name];
      updateCart();
    }

    document.querySelectorAll('.product').forEach(product => {
      product.addEventListener('click', () => {
        const name = product.dataset.name;
        const price = parseFloat(product.dataset.price);

        if (!cart[name]) {
          cart[name] = { qty: 1, price };
        } else {
          cart[name].qty += 1;
        }
        updateCart();
      });
    });

    searchInput.addEventListener('input', function () {
      const searchText = this.value.toLowerCase();
      const products = productList.querySelectorAll('.product');
      products.forEach(product => {
        const name = product.dataset.name.toLowerCase();
        const barcode = product.dataset.barcode.toLowerCase();
        product.style.display = name.includes(searchText) || barcode.includes(searchText) ? '' : 'none';
      });
    });
    </script>
@endsection