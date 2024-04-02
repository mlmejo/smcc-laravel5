@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/signin.css') }}">
@endpush

@section('content')
<div class="container">
  <div class="row bg-white mt-5">

    <div class="col img-login"></div>

    <div class="col p-5">
      <main class="form-signin w-100 m-auto">
        <form action="{{ route('login') }}" method="post">
          {{ csrf_field() }}
          <h1 class="h4 mb-3 fw-normal text-center">Please sign in</h1>

          <div class="mb-3">
            <label for="email" class="col-form-label col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="password" class="col-form-label col-form-label-sm">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-sm">
          </div>

          <button type="submit" class="w-100 btn btn-sm btn-primary">Sign in</button>
        </form>
      </main>
    </div>
  </div>
</div>
@endsection
