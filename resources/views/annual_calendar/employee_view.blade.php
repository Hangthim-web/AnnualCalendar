@extends('layouts.master')

@section('title')
    @lang('Dashboard')
@endsection

<style>
.description-column {
    max-width: 200px !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    background-color: #232323;
}

 .description-column {
    max-width: 200px !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

</style>


@section('content')
    <div class="card mt-3">
        @include('errors.error')

        @php
        $userRole = "annualCalendarAdmin"
        @endphp

      <div class="card-header d-flex gap-3 justify-content-start align-items-center">
    <div>
        <h5 class="card-title mt-2">Task</h5>
    </div>
    <form action="{{ route('annualCalendar.index') }}" method="GET" class="d-flex align-items-center gap-3 ms-3">
        <div class="form-group mb-0">
            <div class="d-flex align-items-center gap-2">
                <label for="filter_year" class="form-label mb-0 pr-1">Year</label>
                <select name="year" id="filter_year" class="form-select">
                    <option value="" disabled {{ empty($selectedYear) ? 'selected' : '' }}>Choose Year</option>
                    <option value="all" {{ $selectedYear === 'all' ? 'selected' : '' }}>All</option>
                    @for($i = 2079; $i <= getCurrentYear() + 1; $i++)
                        <option value="{{ $i }}" {{ $i == $selectedYear ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="d-flex align-items-center gap-2">
                <label for="filter_month" class="form-label mb-0">Month</label>
                <select name="month" id="filter_month" class="form-select ml-5">
                    <option value="" disabled>Choose Month</option>
                    <option value="all" {{ $selectedMonth === 'all' ? 'selected' : '' }}>All</option>
                    @foreach(getNepaliMonths() as $key => $month)
                        <option value="{{ $key }}" {{ $key == $selectedMonth ? 'selected' : '' }}>{{ $month['name'] }}</option>

                    @endforeach
                </select>
            </div>
        </div>   
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-sm" title="Filter Task">
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </div>
            </button>
        </div>
     
    </form>
    <form action="{{ route('annualCalendar.index') }}" method="GET" class="d-flex align-items-center justify-content-center  gap-2 ms-auto me-5">
        <div class="ms-auto d-flex justify-content-center align-items-center align-content-center gap-5">
        <div class="form-group mb-0">
            <div class="d-flex align-items-center gap-3">
                <label for="filterStatus" class="form-label mb-0">Status</label>
                <select name="status" id="filterStatus" class="form-select @error('status') is-invalid @enderror">
                    <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Choose Status</option>
                    <option value="all">All</option>
                    @foreach (statusArray() as $key => $status)
                        <option value="{{ $key }}" {{ old('status') === $key ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-center ml-2">
            <button type="submit" class="btn btn-primary btn-sm" title="Filter Status">
                <div class="d-flex gap-1 justify-content-center align-items-center">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </div>
            </button>
        </div> 
 </form>
    @if(in_array($userRole="annualCalendarAdmin",getUserPermission()))
        <div class="ms-auto">
            <a href="{{ route('annualCalendar.create') }}" class="btn btn-success btn-sm" title="Create Task">
                <i class="uil-plus"></i>
            </a>
        </div>
    @endif
    </div>
</div>



        

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">Task</th>
                            <th scope="col" class="description-column">Description</th>
                            <th scope="col">From Date(BS)</th>
                            <th scope="col">To Date(BS)</th>
                            {{-- <th scope="col">Department</th>
                            <th scope="col">Desgination</th>
                            <th scope="col">Section</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Result</th>
                            <th scope="col">Monitor</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
              
                        @forelse ($annualCalendars as $annualCalendar)
                            @php
                                $id = $annualCalendar->id;
                          
                            
                                
                                $taskId = \App\Models\EmployeeTaskStatus::where("task_id", $id)->first();
                             
                                
                                $pending_status = $taskId ? $taskId->is_pending : null;
                                $approved_status = $taskId ? $taskId->is_approved : null;
                            
                        
                                
                                $currentDate = date('Y-m-d');
                  
                                $to_date = $annualCalendar->to_date;
                              
                             
                                $result = differenceInDates($currentDate, $to_date);
                            
                                $employeeCollection = \App\Models\Employee::whereIn('user_id', explode(',', $annualCalendar->employee))->get();
                                $monitorCollection = \App\Models\Employee::whereIn('user_id', explode(',', $annualCalendar->monitor))->get();
                                $supervisorCollection = \App\Models\Employee::whereIn('user_id', explode(',', $annualCalendar->supervisior))->get();
                                $departmentCollection = \App\Models\Department::whereIn('department_id', explode(',', $annualCalendar->department))->get();
                                $designationCollection = \App\Models\Designation::whereIn('designation_id', explode(',', $annualCalendar->designation))->get();
                                $sectionCollection = \App\Models\Section::whereIn('section_id', explode(',', $annualCalendar->section))->get();
                                // dd($annualCalendar->is_approved);
                                if ($annualCalendar->is_pending=== '1' || $pending_status == '1') {
                                    $status = "pending";
                                } elseif ($annualCalendar->is_approved==1 || $approved_status == '1') {
                                    $status = "approved";
                                } elseif ($result <= 0) {
                                    $status = "incomplete";
                                } else {
                                    $status = "ongoing";
                                }
                          
                            @endphp
                            <tr data-status="{{$status}}">
                                <td>{{ $annualCalendar->task_name }}</td>
                                <td class="description-column">{!! formattedDescription($annualCalendar->description,$annualCalendar->id) !!}</td>
                                <td>{{ $annualCalendar->from_date_bs }}</td>
                                <td>{{ $annualCalendar->to_date_bs }}</td>
                                <td>
                                    
                                         @if ($status === 'pending')
                                            Pending
                                        @elseif ($status === 'approved')
                                            Approved
                                        @elseif ($status === 'incomplete')
                                            Incomplete
                                        @else
                                            Ongoing
                                        @endif
                                                                    
                                </td>
                                <td>
                                    {{ $result }}
                                </td>
                                <td>
                                    @foreach($monitorCollection as $monitor)
                                        {{ $monitor->first_name }} {{ $monitor->middle_name }} {{ $monitor->last_name }} <br/>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($supervisorCollection as $supervisior)
                                        {{ $supervisior->first_name }} {{ $supervisior->middle_name }} {{ $supervisior->last_name }} <br/>
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#view-modal-{{ $annualCalendar->id }}" title="View Task"><i class="fas fa-eye"></i></button>
                                    @if(in_array($userRole,getUserPermission()))
                                    <a href="{{ route('annualCalendar.edit', ['id' => encodeData($annualCalendar->id)]) }}" class="btn btn-primary btn-sm" title="Edit Task"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $annualCalendar->id }}" title="Delete Task"><i class="fas fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="phraseViewModal{{$annualCalendar->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                                                @if (   $annualCalendar->description)
                                                                    <p class="card-text">
                                                                        {!! $annualCalendar->description !!}
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

                            {{-- View Modal --}}
                            <div class="modal fade" id="view-modal-{{ $annualCalendar->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $annualCalendar->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $annualCalendar->id }}">Task Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            @if ($annualCalendar->task_name)
                                                                <h6 class="card-title">Task Name: </h6>
                                                                {{ $annualCalendar->task_name }}
                                                            @endif
                                                             @if ($annualCalendar->description)
                                                                <h6 class="card-title">Description: </h6>
                                                                {{ $annualCalendar->description }}
                                                            @endif
                                                            @if ($annualCalendar->from_date)
                                                                <h6 class="card-title">From Date: </h6>
                                                                {{ $annualCalendar->from_date }}
                                                            @endif
                                                            @if ($annualCalendar->to_date)
                                                                <h6 class="card-title">To Date: </h6>
                                                                {{ $annualCalendar->to_date }}
                                                            @endif
                                                            @if ($annualCalendar->from_date_bs)
                                                                <h6 class="card-title">From Date (BS): </h6>
                                                                {{ $annualCalendar->from_date_bs }}
                                                            @endif
                                                            @if ($annualCalendar->to_date_bs)
                                                                <h6 class="card-title">To Date (BS): </h6>
                                                                {{ $annualCalendar->to_date_bs }}
                                                            @endif
                                                            <h6 class="card-title">Designation Name: </h6>
                                                            @foreach($designationCollection as $designation)
                                                                {{ $designation->designation_name }} <br />
                                                            @endforeach
                                                            <h6 class="card-title">Section Name: </h6>
                                                            @foreach($sectionCollection as $section)
                                                                {{ $section->section_name }} <br />
                                                            @endforeach
                                                            <h6 class="card-title">Department Name: </h6>
                                                            @foreach($departmentCollection as $department)
                                                                {{ $department->department_name }} <br />
                                                            @endforeach
                                                            <h6 class="card-title">Employee Name: </h6>
                                                            @foreach($employeeCollection as $employee)
                                                                {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} <br />
                                                            @endforeach
                                                            <h6 class="card-title">Monitor Name: </h6>
                                                            @foreach($monitorCollection as $monitor)
                                                                {{ $monitor->first_name }} {{ $monitor->middle_name }} {{ $monitor->last_name }} <br />
                                                            @endforeach
                                                            <h6 class="card-title">Supervisor Name: </h6>
                                                            @foreach($supervisorCollection as $supervisior)
                                                                {{ $supervisior->first_name }} {{ $supervisior->middle_name }} {{ $supervisior->last_name }} <br />
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Task File</h6>
                                                            <a href="{{ asset('storage/uploads/'.$annualCalendar->task_file) }}" target="_blank">{{ $annualCalendar->task_file }}</a>
                                                            <br/>
                                                            <iframe src="{{ asset('storage/uploads/'.$annualCalendar->task_file) }}" frameborder="0" width="100%" height="400px"></iframe>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="delete-modal-{{ $annualCalendar->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $annualCalendar->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $annualCalendar->id }}">Delete Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this task?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('annualCalendar.destroy', ['id'=>encodeData($annualCalendar->id)]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!!  $annualCalendars->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endsection

{{-- @section("script")
<script>
$(document).ready(function() {
    $('#filterStatus').on('change', function() {
        var selectedStatus = $(this).val();
        $('tbody tr').each(function() {
            var rowStatus = $(this).data('status');
            console.log("selected status",selectedStatus);
            console.log("row status", rowStatus)
            if (selectedStatus === 'all' || rowStatus === selectedStatus) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>

@endsection --}}
