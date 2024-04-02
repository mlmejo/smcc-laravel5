@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<style>
  .page-link {
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
    font-size: .875rem;
  }
</style>
@endpush

@section('content')
<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Technical Department</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="w-100"></div>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <form action="{{ route('logout') }}" method="post" id="logoutForm">
        {{ csrf_field() }}
      </form>
      <a class="nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">
      Sign out
    </a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ !(request()->is('instructors*') || request()->is('trainees*')) ? 'active' : ''}}"
              aria-current="page"
              href="{{ route('programs.index') }}">
              <i class="fa fa-solid fa-gauge"></i>
              Programs Monitoring
            </a>
          </li>
          @if (request()->user()->role === 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('instructors*') ? 'active' : '' }}"
              href="{{ route('instructors.index') }}">
              <i class="fa fa-solid fa-chalkboard-user"></i>
              Instructor Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('trainees*') ? 'active' : '' }}"
              href="{{ route('trainees.index') }}">
              <i class="fa fa-solid fa-graduation-cap"></i>
              Trainee Management
            </a>
          </li>
          @endif
        </ul>
      </div>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 p-md-4">
      @if (session('status'))
      <div class="mb-3 alert alert-success">
        {{ session('status') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p class="mb-0">{{ $error }}</p>
        @endforeach
      </div>
      @endif

      @yield('main')
    </main>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(function() {
    $('.form-select').addClass('form-select-sm');
  });
</script>
@endpush
