@extends('layouts.master')

@section('title')
    @lang('Dashboard')
@endsection

@section('content')

<style>
    textarea {
        resize: none;
    }
    .day-container {
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        background-color: #f8f9fa;
    }
    .day-header {
        background-color: #e9ecef;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .task-item {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    /* .no-task-item {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    } */
    .card-title {
        flex: 1;
        text-align: center;
    }
    .card-title:first-child {
        text-align: left;
    }
    .card-title:last-child {
        text-align: right;
    }
    .checkboxContainer {
        max-height: 10px;
    }
    #taskDescription {
        width: 300px;
        height: 300px;
        padding: 10px;
        border-radius: 6px;
        margin-top: 10px;
        margin-bottom: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        outline: none;
        border: none;
    }
    #charCount {
        font-size: 14px;
        color: #555;
        margin-top: 5px;
    }
    #taskDescription::placeholder {
        color: #aaa;
    }
    .task-container {
        position: relative;
    }
 .task_textarea {
    height: 250px;
    width: 250px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
    resize: none;
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
}

.task_textarea:focus {
    outline: none;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    background-color: #fff;
}

.task_textarea:hover {
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

    .char-count {
        position: absolute;
        right: 0;
        bottom: -10px;
        font-size: 12px;
    }
    .task-container
        {
/* 
            margin-top:20px; */
        }

        /* .bg-green{
            background-color: #D4EDDA;
        }
        .bg-yellow
        {
            background-color:#F7E9A0;
        } */
         .bg-web-primary
         {
            background-color: #7267ef;
         }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-input {
        position: relative;
        width: 20px;
        height: 20px;
        appearance: none;
        background-color: #d6d6d6;
        border: 2px solid #b0b0b0; 
        border-radius: 4px;
        cursor: pointer;
        outline: none;
 
    }



    

  
    .form-check-input:focus:checked::after { 
        content: '\2714';
        color: white;
        font-size: 14px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .task-name {
        color: white; 
        font-size: 16px; 
        font-weight: bold; 
    }
 .list-item
{
    border-radius:10px !important;
}
   .bg-web-secondary
   {
    background-color: #D6D6D6;
   }

 .check_button {
        background-color: #ffffff; 
        color: #232323;
        border: 2px solid #ffffff;
        border-radius: 8px; 
        padding: 4px 8px; 
        font-size: 16px;
        font-weight: bold; 
        cursor: pointer; 
        transition: background-color 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s; 
        outline: none; 
    }

    .check_button:hover {
        background-color: #f1f1f1 !important; 
        color: #6a1b9a !important; 
        border-color: #6a1b9a !important; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important; 
    }

    .check_button:active {
        background-color: #e0e0e0 !important; 
        color: #4a0072 !important; 
        border-color: #4a0072 !important;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2) !important; 
    }

    
    
</style>



<div class="card">
    @include('errors.error')
    <div class="card-body">
        <form method="GET" action="{{ route('filterTask.index') }}">
            <div class="row">
                <div class="col-md-3 col-xl-3">
                    <div class="form-group">
                        <label for="filter_year" class="form-label">Year</label>
                        <select name="year" id="filter_year" class="form-select">
                            <option value="" disabled>Choose Year</option>
                            @for($i = 2079; $i <= getCurrentYear() + 1; $i++)
                                <option value="{{ $i }}" @if($i == $selectedYear) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="form-group">
                        <label for="filter_month" class="form-label">Month</label>
                        <select name="month" id="filter_month" class="form-select">
                            <option value="">Choose Month</option>
                            @foreach(getNepaliMonths() as $key => $month)
                                <option value="{{ $key }}" @if($key == $selectedMonth) selected @endif>{{ $month['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="form-group">
                        <label for="filter_date" class="form-label">Date</label>
                        <select name="date" id="filter_date" class="form-select">
                            <option value="all" @if($selectedDate == 'all') selected @endif>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </div>
         
            </div>
          
        </form>
         
    </div>
 
</div>
    <div class="d-flex justify-content-end align-items-center  align-content-center float-right gap-2">
            <div>
                <a href="{{route("filterTask.gridView")}}" class='btn btn-success btn-sm'><i class="fas fa-th" style="margin-right:5px"></i>Grid</a>
            </div>
            <div>
                <a href="{{route('filterTask.index')}}" class='btn btn-success btn-sm'><i class="fas fa-list" style="margin-right:5px"></i>List</a>
            </div>
        </div>

<div class="card mt-3">
    @include('errors.error')
    <div class="card-header d-flex justify-content-between align-itemss-center">
        <h5 class="card-title mb-0">Task</h5>
        <div class="flex-grow-1 d-flex justify-content-center">
            <h5 class="card-title mb-0"><span class="text-bold">Year: </span>{{ $selectedYear }}</h5>
        </div>
        <h5 class="card-title mb-0"><span class="text-bold">Month: </span>{{ numberToDays($selectedMonth) }}</h5>
    </div>

    <div class="card-body">
        @foreach($totalDays as $totalDay)
        <div class="day-container">
            <div class="day-header">
                <h6>Day {{ $totalDay }} - {{ getDayofWeekFromNepaliDate($selectedYear.'-'.$selectedMonth.'-'.$totalDay) }}</h6>
            </div>
            <ul class="list-group">
                @php
                    $tasksExist = false;
                    $count = 0;
                @endphp

                @foreach($taskDate as $taskName => $taskDay)
         
                    @php
                        $count++;
                        // $taskStartDay = $filteredTasks[$taskName]['fromDate'];
                        $differenceInDay = $filteredTasks[$taskName]['differenceInDates'];
                        $endDay = $taskDay + $differenceInDay;
                            
                        $bgColorClass = 'bg-web-primary'; 

                        if ($filteredTasks[$taskName]['is_pending'] == 1) {
                            $bgColorClass = 'bg-warning'; 
                        } elseif ($filteredTasks[$taskName]['is_approved'] == 1) {
                            $bgColorClass = 'bg-success'; 
                        }
                                    
       
                    
                      
                    @endphp
           
       
                        @if($totalDay >= $taskDay && $totalDay <= $endDay)
                        <form action="{{ route('taskStatus.postStatus') }}" method="POST" class="list-item">
                            @csrf
                            <li class="list-group-item task-item mt-1 d-flex {{$bgColorClass}} align-items-center">
                                <div class="form-check">
                                    @if($filteredTasks[$taskName]['is_pending'] == 1)
                                    {{-- Hide only the checkbox if the task is pending --}}
                                    <label class="form-check-label ms-2" for="task_{{ $count }}">
                                    </label>
                                        <input class="form-check-input task_checkbox d-none" type="checkbox" id="task_{{ $count }}">
                                        <span class="task-name mb-2  text-w">Task: {{ $taskName }}</span>
                                        <input type="hidden" class="task-id" value="{{$filteredTasks[$taskName]['taskId']}}">
                                        {{-- <button class="btn btn-secondary btn-sm mt-1" disabled>Pending</button> --}}
                                    @elseif($filteredTasks[$taskName]['is_approved'] == 1)
                                        <label class="form-check-label ms-2" for="task_{{ $count }}">
                                        </label>
                                        <input class="form-check-input task_checkbox d-none" type="checkbox" id="task_{{ $count }}">
                                        <span class="task-name mb-2">Task: {{ $taskName }}</span>
                                        <input type="hidden" class="task-id" value="{{$filteredTasks[$taskName]['taskId']}}">
                                        {{-- <button class="btn btn-primary btn-sm check_button" disabled>Completed</button> --}}
                                        @else
                                        <div class='d-flex justify-content-start align-content-center gap-2 mt-2 float-left'>

                                            <input class="form-check-input task_checkbox" type="checkbox" id="task_{{ $count }}"> <br>
                                            <span class="task-name mb-2 text-white">{{ $taskName }}</span>
                                            <input type="hidden" class="task-id" value="{{$filteredTasks[$taskName]['taskId']}}">
                                        </div>
                                        <div class="d-flex justify-content-center align-items flex-column">
                                            <div class="task-container">
                                                <div>
                                                    <textarea name="taskDescription" id="taskDescription_{{ $count }}" placeholder="Enter Remarks" class="task_textarea d-none mt-2" maxlength='500'></textarea>
                                                </div>
                                                <div id="charCount_{{ $count }}" class="d-none char-count text-white">
                                                    0/500
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary btn-sm check_button d-none">Submit</button>
                                            </div>
                                        </div>
                                    @endif

                                    <input type="hidden" class="checkedTaskName" name="t_name">
                                    <input type="hidden" class="checkedTaskId" name="task_id">
                                    <input type="hidden" class="pendingStatus" name="pend_status" value="{{ $filteredTasks[$taskName]['is_pending'] }}">
                                    <input type="hidden" class="checkedIn" name="check_status" value="{{ $filteredTasks[$taskName]['is_approved'] }}">
                                </div>
                                @php
                                    $tasksExist = true;
                                @endphp
                            </li>
                        </form>
                    @endif
                @endforeach

                @if(!$tasksExist)
                    <li class="list-group-item no-task-item bg-web-secondary">Task does not exist!</li>
                @endif
            </ul>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#filter_year, #filter_month, #filter_date').on('change', function() {
            $(this).closest('form').submit();
        });

        $(document).on("change", '.task_checkbox', function() {
            const listItem = $(this).closest('li');
            const checkButton = listItem.find('.check_button');
            const taskName = listItem.find('.task-name').text().trim().replace('Task: ', '');
            const taskId = listItem.find('.task-id').val();
            const hiddenInputList = listItem.find(".checkedTaskName");
            const hiddenInputListTaskid = listItem.find(".checkedTaskId");
            const checkStat = listItem.find(".checkedIn");
            const taskDesc = listItem.find("[id^=taskDescription_]");
            const charCount = listItem.find("[id^=charCount_]");
            const maxChar = taskDesc.attr('maxlength'); 

            function updateCharCount() {
                var currDescLength = taskDesc.val().length; 
                charCount.text(currDescLength + '/' + maxChar);
            }

            if ($(this).is(':checked')) {
                checkButton.removeClass('d-none');
                taskDesc.removeClass('d-none');
                charCount.removeClass('d-none');
                hiddenInputList.val(taskName);
                hiddenInputListTaskid.val(taskId);
                checkStat.val('1');
                updateCharCount();
            } else {
                checkButton.addClass('d-none');
                taskDesc.addClass('d-none');
                charCount.addClass('d-none');
                hiddenInputList.val('');
                checkStat.val('0');
            }
          
            taskDesc.on('input', updateCharCount);
        });
        $(document).on('click', '.check_button', function() {
            const listItem = $(this).closest('li');
            const checkStat = listItem.find(".checkedIn");
            const pendingStat = listItem.find('.pendingStatus');

            checkStat.val('0');
            pendingStat.val('1');
            listItem.find('.check_button').addClass('d-none');

        });

      
        $(document).on('change', '.task_checkbox', function() {
            const listItem = $(this).closest('li');
            const pendingStatVal = listItem.find(".pendingStatus").val();
            console.log("Pending Status Value: ", pendingStatVal);

            const checkStatVal = listItem.find(".checkedIn").val();
            console.log("Check Status Value: ", checkStatVal);
        });

    });
</script>
@endsection
