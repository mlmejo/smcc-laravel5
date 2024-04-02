@extends('layouts.admin')

@section('main')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
      <a href="{{ route('programs.qualifications.index', $qualification->program) }}">
        {{ $qualification->title }}
      </a>
    </li>
    <li class="breadcrumb-item text-uppercase">
      <a href="{{ route('qualifications.competencies.index', $qualification) }}">
        {{ $competency->title }}
      </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Learning Outcomes</li>
  </ol>
</nav>

<button type="button" class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createLearningOutcomeModal">
  Create Learning Outcome
</button>

<div class="modal fade" id="createLearningOutcomeModal" tabindex="-1" aria-labelledby="createLearningOutcomeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createLearningOutcomeModalLabel">Create Learning Outcome</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('competencies.learning-outcomes.store', $competency) }}" method="post" id="createLearningOutcomeForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="description" class="col-form-label col-form-label-sm">Description</label>
            <textarea name="description" id="description" cols="30" rows="2" class="form-control form-control-sm"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="createLearningOutcomeForm" class="btn btn-sm btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="datatable table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($learningOutcomes as $learningOutcome)
      <tr>
        <td>{{ $learningOutcome->id }}</td>
        <td>{{ $learningOutcome->description }}</td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editlearningOutcomeModal{{ $learningOutcome->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Learning Outcome">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>

          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deletelearningOutcomeModal{{ $learningOutcome->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Learning Outcome">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>
      <div class="modal fade" id="editlearningOutcomeModal{{ $learningOutcome->id }}" tabindex="-1" aria-labelledby="editlearningOutcomeModal{{ $learningOutcome->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editlearningOutcomeModal{{ $learningOutcome->id }}Label">Edit Learning Outcome</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('learning-outcomes.update', $learningOutcome) }}" method="post" id="learningOutcomeUpdateForm{{ $learningOutcome->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="mb-3">
                  <label for="description" class="col-form-label col-form-label-sm">Description</label>
                  <textarea name="description" id="description" cols="30" rows="2" class="form-control form-control-sm">{{ $learningOutcome->description }}</textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="learningOutcomeUpdateForm{{ $learningOutcome->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deletelearningOutcomeModal{{ $learningOutcome->id }}" tabindex="-1" aria-labelledby="deletelearningOutcomeModal{{ $learningOutcome->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deletelearningOutcomeModal{{ $learningOutcome->id }}Label">Delete Learning Outcome</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('learning-outcomes.destroy', $learningOutcome) }}" method="post" id="deletelearningOutcomeForm{{ $learningOutcome->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete this learning outcome?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deletelearningOutcomeForm{{ $learningOutcome->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
