@extends('layouts.master')

@section('title')
    @lang('Dashboard')
@endsection

@section('content')

<div class="card">
    @include('errors.error')

    <div class="card-header">
        <h1 class="card-title">Task Approval</h1>
    </div>

 

    <div class="card-body">
        <form action="{{ route('taskStatus.approve') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Employee Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($filteredTaskIds as $index => $taskId)
                            @php
                                $taskName = $filteredTaskNames[$index];
                                $empName = $empNames[$index] ?? 'Unknown'; // Use the employee name from the array
                            @endphp
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $taskName }}</td>
                                <td>{{ $empName }}</td>
                                <td>
                                    <input type="hidden" name="taskIds[]" value="{{ $taskId }}">
                                    <input type="hidden" name="taskNames[]" v@extends('layouts.master')

@section('title')
    @lang('Dashboard')
@endsection

@section('content')

<div class="card">
    @include('errors.error')

    <div class="card-header">
        <h1 class="card-title">Task Approval</h1>
    </div>

    <div class="card-body">
        <form action="{{ route('taskStatus.approve') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Employee Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($filteredTaskIds as $index => $taskId)
                            @php
                                $taskName = $filteredTaskNames[$index];
                                $empName = $empNames[$index] ?? 'Unknown'; // Use the employee name from the array
                                $isMonitor = $monitors[$index] == getUserId(); // Check if the current user is a monitor
                                $isSupervisor = $supervisors[$index] == getUserId(); // Check if the current user is a supervisor
                            @endphp
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>{{ $taskName }}</td>
                                <td>{{ $empName }}</td>
                                <td>
                                    <input type="hidden" name="taskIds[]" value="{{ $taskId }}">
                                    <input type="hidden" name="taskNames[]" value="{{ $taskName }}">
                                    <input type="hidden" name="empNames[]" value="{{ $empName }}">
                                            
                                    @if($isMonitor || $isSupervisor)
                                        <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                    @else
                                        <span class="text-muted">No action available</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@endsection
alue="{{ $taskName }}">
                                    <input type="hidden" name="empNames[]" value="{{ $empName }}">
                                            
                                        @if($monitors && $supervisors)
                                        <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                        @else
                                        <span class="text-muted">No action available</span>
                                        @endif
                                 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@endsection
