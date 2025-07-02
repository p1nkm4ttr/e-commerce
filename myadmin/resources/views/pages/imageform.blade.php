@extends('layouts.app')

@section('content')
<!-- ========== section start ========== -->
<!-- ========== tab components start ========== -->
      <section class="tab-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Product Form</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item"><a href="#0">Products</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Add Product
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <!-- ========== form-elements-wrapper start ========== -->
          @if(session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
          @endif

          <div class="form-elements-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <h6 class="mb-25">Product Details</h6>
                  <form method="post" action='{{ url()->route("imageform_save") }}' enctype="multipart/form-data">
                    @csrf
                    <div class="input-style-1">
                      <label>Product Name</label>
                      <input type="text" placeholder="Product Name" name="name"/>
                      @error('name') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>Product Image</label>
                      <input type="file" name="image" accept="image/*"/>
                      @error('image') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>Description</label>
                      <textarea name="description" placeholder="Product Description" rows="4"></textarea>
                      @error('description') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>Price</label>
                      <input type="number" step="0.01" placeholder="Price" name="price"/>
                      @error('price') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>SKU</label>
                      <input type="text" placeholder="Stock Keeping Unit" name="sku"/>
                      @error('sku') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>Barcode</label>
                      <input type="text" placeholder="Barcode" name="barcode"/>
                      @error('barcode') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-style-1">
                      <label>Quantity</label>
                      <input type="number" placeholder="Quantity" name="qty" min="0"/>
                      @error('qty') <span class="error">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="main-btn primary-btn btn-hover">
                                Add Product
                            </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== tab components end ========== -->
@endsection

