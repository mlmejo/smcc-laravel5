@extends('layouts.admin')

@section('main')
<h1 class="h4 mb-4">Trainee Management</h1>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createTraineeModal">
  Create Trainee Entry
</button>

<div class="modal fade" id="createTraineeModal" tabindex="-1" aria-labelledby="createTraineeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createTraineeModalLabel">Create Trainee Entry</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('trainees.store') }}" method="post" id="createTraineeForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="trainee_number" class="col-form-label col-form-label-sm">Trainee number</label>
            <input type="text" name="trainee_number" id="trainee_number" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="last_name" class="col-form-label col-form-label-sm">Last name</label>
            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="first_name" class="col-form-label col-form-label-sm">First name</label>
            <input type="text" name="first_name" id="first_name" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="middle_initial" class="col-form-label col-form-label-sm">Middle initial</label>
            <input type="text" name="middle_initial" id="middle_initial" class="form-control form-control-sm">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" form="createTraineeForm">Create</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="datatable table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Trainee number</th>
        <th>Last name</th>
        <th>First name</th>
        <th>Middle initial</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($trainees as $trainee)
      <tr>
        <td>{{ $trainee->id }}</td>
        <td>{{ $trainee->trainee_number }}</td>
        <td>{{ $trainee->last_name }}</td>
        <td>{{ $trainee->first_name }}</td>
        <td>{{ $trainee->middle_initial }}</td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editTraineeModal{{ $trainee->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Trainee">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>
          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteTraineeModal{{ $trainee->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Trainee">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>

      <div class="modal fade" id="editTraineeModal{{ $trainee->id }}" tabindex="-1" aria-labelledby="editTraineeModal{{ $trainee->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editTraineeModal{{ $trainee->id }}Label">Edit Trainee Account</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('trainees.update', $trainee) }}" method="post" id="traineeUpdateForm{{ $trainee->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="trainee_number" class="col-form-label col-form-label-sm">Trainee number</label>
                  <input type="text" name="trainee_number" id="trainee_number" value="{{ $trainee->trainee_number }}" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                  <label for="last_name" class="col-form-label col-form-label-sm">Last name</label>
                  <input type="text" name="last_name" id="last_name" value="{{ $trainee->last_name }}" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                  <label for="first_name" class="col-form-label col-form-label-sm">First name</label>
                  <input type="text" name="first_name" id="first_name" value="{{ $trainee->first_name }}" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                  <label for="middle_initial" class="col-form-label col-form-label-sm">Middle initial</label>
                  <input type="text" name="middle_initial" id="middle_initial" value="{{ $trainee->middle_initial }}" class="form-control form-control-sm">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="traineeUpdateForm{{ $trainee->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteTraineeModal{{ $trainee->id }}" tabindex="-1" aria-labelledby="deleteTraineeModal{{ $trainee->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteTraineeModal{{ $trainee->id }}Label">Delete Trainee Account</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('trainees.destroy', $trainee) }}" method="post" id="deleteTraineeForm{{ $trainee->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete <strong>{{ $trainee->last_name }}, {{ $trainee->first_name }} {{ $trainee->middle_initial }}</strong>?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteTraineeForm{{ $trainee->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
