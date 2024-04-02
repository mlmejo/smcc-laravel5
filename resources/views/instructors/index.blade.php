@extends('layouts.admin')

@section('main')
<h1 class="h4 mb-4">Instructor Management</h1>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createIntructorModal">
  Create Instructor Account
</button>

<div class="modal fade" id="createIntructorModal" tabindex="-1" aria-labelledby="createIntructorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createIntructorModalLabel">Create Instructor Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('instructors.store') }}" method="post" id="createInstructorForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="name" class="col-form-label col-form-label-sm">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="email" class="col-form-label col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="password" class="col-form-label col-form-label-sm">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="col-form-label col-form-label-sm">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="createInstructorForm" class="btn btn-sm btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="datatable table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($instructors as $instructor)
      <tr>
        <td>{{ $instructor->id }}</td>
        <td>{{ $instructor->user->name }}</td>
        <td>{{ $instructor->user->email }}</td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editInstructorModal{{ $instructor->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Instructor">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>
          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteInstructorModal{{ $instructor->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Instructor">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>

      <div class="modal fade" id="editInstructorModal{{ $instructor->id }}" tabindex="-1" aria-labelledby="editInstructorModal{{ $instructor->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editInstructorModal{{ $instructor->id }}Label">Edit Instructor Account</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('instructors.update', $instructor) }}" method="post" id="instructorUpdateForm{{ $instructor->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="name" class="col-form-label col-form-label-sm">Name</label>
                  <input type="text" name="name" id="name" value="{{ $instructor->user->name }}" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                  <label for="email" class="col-form-label col-form-label-sm">Email address</label>
                  <input type="email" name="email" id="email" value="{{ $instructor->user->email }}" class="form-control form-control-sm">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="instructorUpdateForm{{ $instructor->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteInstructorModal{{ $instructor->id }}" tabindex="-1" aria-labelledby="deleteInstructorModal{{ $instructor->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteInstructorModal{{ $instructor->id }}Label">Delete Instructor Account</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('instructors.destroy', $instructor) }}" method="post" id="deleteInstructorForm{{ $instructor->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete <strong>{{ $instructor->user->name }}</strong>?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteInstructorForm{{ $instructor->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
