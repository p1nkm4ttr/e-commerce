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
                  <h2>Form Elements</h2>
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
                      <li class="breadcrumb-item"><a href="#0">Forms</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Form Elements
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
          <form method="post" action='{{ url()->route("form_save") }}'>
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
            <div class="form-elements-wrapper">
              <div class="row">
                <div class="col-lg-12">
                  <!-- input style start -->
                  < class="card-style mb-30">
                    <h6 class="mb-25">Input Fields</h6>
                  <form method="post" action='{{ url()->route("form_save") }}'>
                    <div class="input-style-1">
                      <label>Full Name</label>
                      <input type="text" placeholder="Full Name" name="name"/>
                      @error('name') <span class="error">{{ $message }}</span>@enderror
                        
                    </div>
                    <!-- end input -->
                    <div class="input-style-2">
                      <input name="first_name" placeholder="First Name"  type="text"/>
                    </div>
                    <!-- end input -->
                    <div class="input-style-2">
                      <input name="last_name" placeholder="Last Name"  type="text"/>
                    </div>
                    <div class="input-style-2">
                      <input name="email" placeholder="Email" type="email" />
                      @error('email') <span class="error">{{ $message }}</span>@enderror
                      
                    </div>
                    <div class="input-style-2">
                      <input name= "password" placeholder="Password" type="password" pattern="[a-z0-5]{8,}"/>
                      @error('password') <span class="error">{{ $message }}</span>@enderror
                      
                    </div>
                    <input type="submit" value="Submit" />
                  
                    <!-- end input -->
                  </div>
                  <!-- end card -->
                  <!-- ======= input style end ======= -->
                </div>
                <!-- end col -->
                
              </div>
              <!-- end row -->
            </div>
          </form>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== tab components end ========== -->
@endsection

