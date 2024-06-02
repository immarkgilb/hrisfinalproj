@extends('layouts.user')
@section('contents')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Attendance Record</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="{{ $attendance->full_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" class="form-control" value="{{ $attendance->department }}" required>
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" class="form-control" value="{{ $attendance->position }}" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $attendance->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $attendance->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
