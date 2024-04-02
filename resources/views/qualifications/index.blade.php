@extends('layouts.admin')

@section('main')
<h1 class="h4 mb-4">{{ $program->name }} Qualifications</h1>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createQualificationModal">
  Create Qualification
</button>

<div class="modal fade" id="createQualificationModal" tabindex="-1" aria-labelledby="createQualificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createQualificationModalLabel">Create Qualification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('programs.qualifications.store', $program) }}" method="post" id="createQualifiationForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="title" class="col-form-label col-form-label-sm">Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-sm">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="createQualifiationForm" class="btn btn-sm btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="datatable table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($qualifications as $qualification)
      <tr>
        <td>
          {{ $qualification->id }}
        </td>
        <td>
          <a href="{{ route('qualifications.charts.index', $qualification) }}" class="text-decoration-none">
            {{ $qualification->title }}
          </a>
        </td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editQualificationModal{{ $qualification->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Qualification">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>
          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteQualificationModal{{ $qualification->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Qualification">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>

          <a href="{{ route('qualifications.competencies.index', $qualification) }}" data-bs-toggle="tooltip" data-bs-title="View Competencies">
            <i class="fa fa-solid fa-lines-leaning text-primary"></i>
          </a>
        </td>
      </tr>

      <div class="modal fade" id="editQualificationModal{{ $qualification->id }}" tabindex="-1" aria-labelledby="editQualificationModal{{ $qualification->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editQualificationModal{{ $qualification->id }}Label">Edit Qualification</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('qualifications.update', $qualification) }}" method="post" id="qualificationUpdateForm{{ $qualification->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="title" class="col-form-label col-form-label-sm">Title</label>
                  <input type="text" name="title" id="title" value="{{ $qualification->title }}" class="form-control form-control-sm">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="qualificationUpdateForm{{ $qualification->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteQualificationModal{{ $qualification->id }}" tabindex="-1" aria-labelledby="deleteQualificationModal{{ $qualification->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteQualificationModal{{ $qualification->id }}Label">Delete Qualification</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('qualifications.destroy', $qualification) }}" method="post" id="deleteQualificationForm{{ $qualification->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete <strong>{{ $qualification->title }}</strong>?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteQualificationForm{{ $qualification->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
