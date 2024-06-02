@extends('layouts.app')
@section('contents')

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #14202e;
            color: #fff;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            padding: 5px;
        }

        .card-body {
            padding: 50px;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: right;
        }

        .btn-action {
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            transition: background-color 0.3s;
        }

        .btn-action:hover {
            background-color: #0056b3;
        }

        .card-text {
            text-align: left;
        }

        .status-active {
            color: #28a745;
        }

        .status-inactive {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="font-bold text-2xl ml-3">Attendance Records</h2>
            </div>
            <div class="col-md-4">
                <div class="form-inline">
                    <label for="statusFilter" class="mr-2">Filter by Status:</label>
                    <select class="form-control" id="statusFilter">
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <div class="row" id="attendanceCards">
            @foreach ($attendances as $attendance)
            <div class="col-md-4 mb-4 attendance-card" data-status="{{ $attendance->status }}">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-center">{{ $attendance->full_name }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Department:</strong> {{ $attendance->department }}</p>
                        <p class="card-text"><strong>Position:</strong> {{ $attendance->position }}</p>
                        <p class="card-text"><strong>Status:</strong> <span class="{{ $attendance->status == 'active' ? 'status-active' : 'status-inactive' }}">{{ ucfirst($attendance->status) }}</span></p>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-action btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-action btn-sm">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#statusFilter').change(function() {
                var selectedStatus = $(this).val();
                if (selectedStatus === '') {
                    $('.attendance-card').show();
                } else {
                    $('.attendance-card').hide();
                    $('.attendance-card[data-status="' + selectedStatus + '"]').show();
                }
            });
        });
    </script>
</body>

</html>
@endsection
