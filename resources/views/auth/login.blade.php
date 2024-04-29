@extends('layout.layout2')
@section('title', 'Login')
    
@section('content')

<div class="container-fluid position-relative">
  <div class="mt-5">
    @if($errors->any())
    <div class="col-12">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
  </div>
  <!-- Sign In Start -->
  <div class="container-fluid">
      <div class="row h-100 align-items-center justify-content-center" >
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <form action="{{ route('login.post') }}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px;">
              @csrf
              <div class=" rounded p-4 p-sm-5 my-4 mx-3" style="background-color: #1E1916">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                      <a href="{{ route('home') }}" class="">
                          <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i></h3>
                      </a>
                      <h3 class="text-primary">Sign In</h3>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                      <label for="email">Email address</label>
                  </div>
                  <div class="form-floating mb-4">
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                      <label for="password">Password</label>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                      <a href="">Forgot Password</a>
                  </div>
                  <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                  <p class="text-center mb-0" style="color: #a2a2a2">Don't have an Account? <a href="{{ route('register')}}">Sign Up</a></p>
              </div>
            </form>
          </div>
      </div>
  </div>
  <!-- Sign In End -->
</div>
@endsection