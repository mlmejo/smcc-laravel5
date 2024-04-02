@extends('layouts.admin')

@section('main')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
      <a href="{{ route('programs.qualifications.index', $qualification->program) }}">
        {{ $qualification->title }}
      </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Competencies</li>
  </ol>
</nav>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createCompetencyModal">
  Create Competency
</button>

<div class="modal fade" id="createCompetencyModal" tabindex="-1" aria-labelledby="createCompetencyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createCompetencyModalLabel">Create Competency</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('qualifications.competencies.store', $qualification) }}" method="post" id="createCompetencyForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="title" class="col-form-label col-form-label-sm">Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-sm">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="createCompetencyForm" class="btn btn-sm btn-primary">Create</button>
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
      @foreach ($competencies as $competency)
      <tr>
        <td>
          {{ $competency->id }}
        </td>
        <td>
          <a href="{{ route('competencies.learning-outcomes.index', $competency) }}" class="text-decoration-none">
            {{ $competency->title }}
          </a>
        </td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editCompetencyModal{{ $competency->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Competency">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>

          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteCompetencyModal{{ $competency->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Competency">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>

      <div class="modal fade" id="editCompetencyModal{{ $competency->id }}" tabindex="-1" aria-labelledby="editCompetencyModal{{ $competency->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editCompetencyModal{{ $competency->id }}Label">Edit Competency</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('competencies.update', $competency) }}" method="post" id="competencyUpdateForm{{ $competency->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="title" class="col-form-label col-form-label-sm">Title</label>
                  <input type="text" name="title" id="title" value="{{ $competency->title }}" class="form-control form-control-sm">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="competencyUpdateForm{{ $competency->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteCompetencyModal{{ $competency->id }}" tabindex="-1" aria-labelledby="deleteCompetencyModal{{ $competency->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteCompetencyModal{{ $competency->id }}Label">Delete Competency</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('competencies.destroy', $competency) }}" method="post" id="deleteCompetencyForm{{ $competency->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete this competency?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteCompetencyForm{{ $competency->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
