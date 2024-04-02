@extends('layouts.admin')

@section('main')
<h1 class="h4 mb-4">{{ $qualification->title }} Monitoring</h1>

<button class="mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createChartModal">
  Create Chart
</button>

<div class="modal fade" id="createChartModal" tabindex="-1" aria-labelledby="createChartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="createChartModalLabel">Create Monitoring Chart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('qualifications.charts.store', $qualification) }}" method="post" id="createInstructorForm">
          {{ csrf_field() }}

          <div class="mb-3">
            <label for="instructor" class="col-form-label col-form-label-sm">
              Instructor
            </label>
            <select name="instructor" id="instructor" class="form-select form-select-sm">
              <option value="" disabled selected>Select Instructor</option>
              @foreach ($instructors as $instructor)
              <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="start_date" class="col-form-label col-form-label-sm">Training start date</label>
            <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
          </div>

          <div class="mb-3">
            <label for="end_date" class="col-form-label col-form-label-sm">Training end date</label>
            <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
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
  <table class="datatable table table-striped table-bordered">
    <thead>
      <tr>
        <th>Trainer</th>
        <th>Qualification</th>
        <th>Training Start Date</th>
        <th>Training End Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($charts as $chart)
      <tr>
        <td>{{ $chart->instructor->user->name }}</td>
        <td>
          <a href="{{ route('charts.show', $chart) }}" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-title="View Monitoring Chart">
            {{ $chart->qualification->title }}
          </a>
        </td>
        <td>{{ $chart->start_date }}</td>
        <td>{{ $chart->end_date }}</td>
        <td>
          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#editChartModal{{ $chart->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Edit Chart">
              <i class="fa fa-solid fa-edit text-success"></i>
            </span>
          </button>

          <button style="all: unset" data-bs-toggle="modal" data-bs-target="#deleteChartModal{{ $chart->id }}">
            <span data-bs-toggle="tooltip" data-bs-title="Delete Chart">
              <i class="fa fa-solid fa-trash text-danger"></i>
            </span>
          </button>
        </td>
      </tr>

      <div class="modal fade" id="editChartModal{{ $chart->id }}" tabindex="-1" aria-labelledby="editChartModal{{ $chart->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="editChartModal{{ $chart->id }}Label">Edit Monitoring Chart</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('charts.update', $chart) }}" method="post" id="chartUpdateForm{{ $chart->id }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="chartUpdateForm{{ $chart->id }}" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteChartModal{{ $chart->id }}" tabindex="-1" aria-labelledby="deleteChartModal{{ $chart->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6" id="deleteChartModal{{ $chart->id }}Label">Delete Monitoring Chart</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('charts.destroy', $chart) }}" method="post" id="deleteChartForm{{ $chart->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="mb-0">
                  Are you sure you want to delete this monitoring chart?
                </p>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="deleteChartForm{{ $chart->id }}" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
