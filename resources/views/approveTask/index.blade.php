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
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Task Description</th>
                        <th>Employee Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 0;
                 
                    @endphp
                   
                    @foreach($annualCal as $key => $tasks)
                    
                        @php
                            $t_id = $tasks->id;
                            $t_id_stat = \App\Models\EmployeeTaskStatus::where("task_id",$tasks->id)->first();
                            $task_desc = $t_id_stat->task_description;
                            $t_emp_id = $tasks->employee_id;

                        @endphp
                        {{-- @dd($task_desc); --}}

                        {{-- @dd($tasks=->) --}}
                    
                        @if($tasks->is_approved != '1')
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $tasks->task_name }}</td>
                            <td>{!! formattedDescription($task_desc,$tasks->id) !!}</td>
                            <td>{!! getFullName($tasks->employee_id) !!}</td>

                            @if($tasks->is_pending == '1')
                            <td>
                                <form action="{{ route('taskStatus.approve', ['task_id' => $t_id, 'emp_id' => $t_emp_id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                            </td>
                            @endif
                        </tr>

                        @endif
                            <div class="modal fade" id="phraseViewModal{{$tasks->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">
                                                    Description
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                @if (   $task_desc)
                                                                    <p class="card-text">
                                                                        {!! $task_desc !!}
                                                                    </p>
                                                                @endif 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> 
                                        </div><!-- /.modal-content -->
                                    </div>
                                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
