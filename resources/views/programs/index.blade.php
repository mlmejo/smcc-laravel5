@extends('layouts.admin')

@section('main')
<h1 class="h4 mb-4">Programs Monitoring</h1>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createProgramModal">
  Create Program
</button>

<div class="modal fade" id="createProgramModal" tabindex="-1" aria-labelledby="createProgramModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createProgramModalLabel">Create Program</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('programs.store') }}" method="post" id="createProgramForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="instructor" class="col-form-label col-form-label-sm">Instructor</label>
            <select name="instructor" id="instructor" class="form-select form-select-sm">
              <option value="" disabled selected>Select Instructor</option>
              @foreach ($instructors as $instructor)
               <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="name" class="col-form-label col-form-label-sm">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="school_year" class="col-form-label col-form-label-sm">
              School year
            </label>
            <input type="text" name="school_year" id="school_year" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="semester" class="col-form-label col-form-label-sm">Semester</label>
            <select name="semester" id="semester" class="form-select form-select-sm">
              <option value="" disabled selected>Select Semester</option>
              <option value="1st semester">1st semester</option>
              <option value="2nd semester">2nd semester</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" form="createProgramForm">Create</button>
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
        <th>Instructor</th>
        <th>School year</th>
        <th>Semester</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($programs as $program)
      <tr>
        <td>{{ $program->id }}</td>
        <td>
          <a href="{{ route('programs.qualifications.index', $program) }}" class="text-decoration-none">
            {{ $program->name }}
          </a>
        </td>
        <td>{{ $program->instructor->user->name }}</td>
        <td>{{ $program->school_year }}</td>
        <td>{{ $program->semester }}</td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editProgramModal{{ $program->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Program">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>
          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteProgramModal{{ $program->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Program">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>
      <div class="modal fade" id="editProgramModal{{ $program->id }}" tabindex="-1" aria-labelledby="editProgramModal{{ $program->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editProgramModal{{ $program->id }}Label">Edit Program</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('programs.update', $program) }}" method="post" id="programUpdateForm{{ $program->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="instructor" class="col-form-label col-form-label-sm">Instructor</label>
                  <select name="instructor" id="instructor" class="form-select form-select-sm">
                    <option value="" disabled>Select Instructor</option>
                    @foreach ($instructors as $instructor)
                      @if ($program->instructor === $instructor)
                        <option value="{{ $instructor->id }}" selected>{{ $instructor->user->name }}</option>
                      @else
                        <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="name" class="col-form-label col-form-label-sm">Name</label>
                  <input type="text" name="name" id="name" value="{{ $program->name }}" class="form-control form-control-sm">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="programUpdateForm{{ $program->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteProgramModal{{ $program->id }}" tabindex="-1" aria-labelledby="deleteProgramModal{{ $program->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteProgramModal{{ $program->id }}Label">Delete Program Account</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('programs.destroy', $program) }}" method="post" id="deleteProgramForm{{ $program->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete <strong>{{ $program->name }}</strong>?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteProgramForm{{ $program->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
