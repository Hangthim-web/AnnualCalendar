@extends('layouts.master')
@section('title')
    @lang('Dashboard')
@endsection

@section('content')
<style>
 .calView {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    /* gap: 0.25rem; */
    list-style: none;
    padding: 0;
    margin: 0; 
}

.calView li {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 150px; 
    max-height: auto; 
    /* border-radius: 10px;  */
    padding: 1rem;
    font-weight: 300;
    font-size: 0.8rem;
    box-sizing: border-box;
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, background-color 0.3s ease;
    margin: 0; 
}


.insideTheBox:hover {
    padding: 1rem; 
    background-color: #e0e0e085; 
    transform: scale(1.05);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.092); 
    z-index: 10;
    cursor:pointer;
    overflow-y:scroll;
    }
  
.insideTheBox {
    height: 150px; 

    overflow-y: auto;
    transition: padding 0.3s ease, background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}
.calView li.calHeader {
    height: auto; 
    max-height: none; 
    margin: 0; 
    /* border-radius: 10px;  */
    font-weight: 700; 
    font-size: 1rem; 
    background: rgba(255, 255, 255, 0.5);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3); 
    position: relative; 
    text-align: center; 
    transition: transform 0.3s ease, background-color 0.3s ease;
    display: flex; 
    justify-content: center;
    align-items: center; 
    box-sizing: border-box; 
}

    .calView li time {
        font-size: 2rem;
        margin: 0 0 0.1rem 0;
        font-weight: 500;
    }

    .calView li.today time {
        font-weight: 800;
        background: #ffffff70;
    }

    .task-item {
        border-radius:4px;
        /* border-left: 5px solid #000000; */
        margin-bottom: 0.25rem;
        padding: 0.25rem;
        /* background-color: #d4edda; */
        /* border-color: #00a527; */
    }
    .task-item::after
    {
         content: attr(data-start-date) " to " attr(data-end-date);
    }

    .no-task-item {
        border-radius: 4px;
        margin-bottom: 0.25rem;
        /* padding: 1000px; */
        padding: 1rem !important;
       background-color: #D6D6D6;
    }

    .checkboxContainer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .calView li.saturday .dayNumber {
       color:#db000be7 !important;
    }
    .calView li .dayNumber{
        font-size:16px;
    }
    .modal-dialog-right {
    position: fixed;
    top: 0;
    right: 0;
    width: 33.33%; 
    height: 100%;
    margin: 0;
    transform: translateX(100%); 
    transition: transform 0.3s ease-in-out; 
    z-index: 1050; 
}

.modal-dialog-right.show {
    transform: translateX(0); 
}
.modal-content {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.listInsideModal {
    position: relative;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    padding: 1rem;
    border-radius: 4px;
    height: auto !important;
    background-color: #f9f9f9;
    margin-bottom: 0.75rem;
    /* overflow: ; */
    transition: background-color 0.3s;
}
.listInsideModal input[type="checkbox"] {
    position: relative;
    z-index: 1; 
    cursor:pointer;
}


.listInsideModal::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1); 
    transition: left 0.3s ease-in-out; 
    z-index: 0;
}

.listInsideModal:hover::before {
    left: 0;
}

.listInsideModal:hover {
    background-color: #e9ecef; /* Background color change on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    cursor:pointer;

}

.listInsideModal .taskInModal {
    position: relative; 
    z-index: 1;
}
.taskInModal
{
    height:20px !important;
    margin-top:10px;
    margin-left:8px;
    font-size:16px;
    font-weight:bold;
}


.modal-body {
    display: flex;
    flex-direction: column;
    overflow-y:auto;
}


.modal-header, .modal-footer {
    background: #f1f1f1;
    border-bottom: 1px solid #ddd;
}

.task-container
{
    z-index:1000;
}
 .task_textarea {
    height: 250px  !important;
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
.check_button {
    display: inline-block; 
    visibility: visible; 
    opacity: 1; 
}
.visually-hidden {
    position: absolute;
    opacity: 0;
    pointer-events: none;
    display: none !important;
}
.statusButton
{
    margin-left:10px !important;
}
.nameFieldInModal
{
    margin-left:8px;
}
textarea
{
    resize:none;
}
.taskCountWrapper{
    z-index:9999;
}
.bg-web-primary
         {
            background-color: #7267ef;
         }

</style>

<div class="containerDiv">

    @php
    $o_names = array_keys($filteredTasks);
 
    $taskDesc = [];

    foreach($o_names as $names)
    {
        
        $tasks = \App\Models\AnnualCalendar::where("task_name",$names)->first();
        $taskDesc[$names] = $tasks->description;
     
    }

    @endphp




 
 {{-- @php
 $differenceInDates=[];
foreach($taskDates as $t_taskDate)
{
    $fromDate = $t_taskDate['from_date_bs'];
    $toDate = $t_taskDate['to_date_bs'];
    $diffDates = differenceInDates($fromDate,$toDate);
    $differenceInDates[] = $diffDates;
}

 @endphp --}}

 {{-- @dd($taskDate); --}}






    <div class="d-flex justify-content-start align-items-center gap-2">
        <div>
            <form action="{{ route('filterTask.gridView') }}" method="GET" class="row d-flex align-items-start justify-content-between">
                @csrf
                <div class="col-md-4 col-xl-4">
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label for="filter_year" class="form-label pr-1">Year</label>
                            <select name="year" id="filter_year" class="form-select">
                                <option value="" disabled {{ empty($currentYear) ? 'selected' : '' }}>Choose Year</option>
                                <option value="all" {{ $currentYear === 'all' ? 'selected' : '' }}>All</option>
                                @for($i = 2079; $i <= getCurrentYear() + 1; $i++)
                                    <option value="{{ $i }}" {{ $i == $currentYear ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                {{-- @dd($currentYear); --}}
                <div class="col-md-4 col-xl-4">
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label for="filter_month" class="form-label">Month</label>
                            <select name="month" id="filter_month" class="form-select ml-5">
                                <option value="" disabled>Choose Month</option>
                                <option value="all" {{ $currentMonth === 'all' ? 'selected' : '' }}>All</option>
                                @foreach(getNepaliMonths() as $key => $month)
                                    <option value="{{ $key }}" {{ $key == $currentMonth ? 'selected' : '' }}>{{ $month['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mt-1" title="Filter Task">
                        <div class="d-flex gap-1 justify-content-center align-items-center gap-2">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
        <div>
            <h1>{{ $currentYear }} {!! numberToDays($currentMonth) !!}</h1>
        </div>
    </div>

    <ul class="calView">
        <li class="calHeader">Sunday</li>
        <li class="calHeader">Monday</li>
        <li class="calHeader">Tuesday</li>
        <li class="calHeader">Wednesday</li>
        <li class="calHeader">Thursday</li>
        <li class="calHeader">Friday</li>
        <li class="calHeader">Saturday</li>

        @php
            $firstDayOfMonth = getnthDayofWeekFromNepaliDate($currentYear . '-' . $currentMonth . '-01');
            $totalDaysCount = count($totalDays);
            $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        @endphp

        @for ($i = 1; $i < $firstDayOfMonth; $i++)
            <li></li>
        @endfor




      

        @foreach($totalDays as $index => $totalDay)
            
            @php
                $currentDayOfWeek = $daysOfWeek[($index + $firstDayOfMonth-2) % 7];
                $isSaturday = ($currentDayOfWeek === 'saturday') ? 'saturday' : '';
                @endphp
            <li class="{{ $isSaturday }} insideTheBox" id="day_{{$totalDay}}" data-day="{{ $totalDay }}" data-bs-toggle='modal' data-bs-target="#list_{{$totalDay}}" >
                
                <time class="dayNumber">{{ $totalDay }}</time>
                @php
                    $tasksExist = false;
                    @endphp


@foreach($taskDate as $taskName => $taskDay)

    @php
        $differenceInDates = $filteredTasks[$taskName]['differenceInDates'];
        $endDate = $taskDay + $differenceInDates;
        $bgStatColor = "";
        $textColor = "";
        if($filteredTasks[$taskName]['is_pending']==1)
        {
            $bgStatColor = 'bg-warning';
        }
        elseif ($filteredTasks[$taskName]['is_approved']==1) {
        $bgStatColor = 'bg-success';
        }
        else {
               $bgStatColor = 'bg-web-primary';
               $textColor = "text-white";
        }

    @endphp

  @if($totalDay>=$taskDay && $totalDay <= $endDate)
            <div class="task-item {{$bgStatColor}} {{$textColor}}" data-start-date="{{$taskDay}}" data-end-date="{{$endDate}}" id="day_{{$totalDay}}" >
                <div class="d-flex justify-content-between align-items-center checkboxContainer">
                    <span class="task-name">{{ $taskName }}</span>
               
                </div>
           
            </div>
            @php
                $tasksExist = true;
            @endphp
        @endif

@endforeach


                @if(!$tasksExist)
                    <div class="no-task-item">No tasks for this day</div>
                @endif
            </li>


           {{-- @foreach($totalDays as $totalDay) --}}
    @php
    $count = 0;
    $taskExists = false;
    @endphp
    <div class="modal fade" id="list_{{$totalDay}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>

                        <h5 class="modal-title" id="modalLabel">Task Details</h5>
                        <p>Date : {{$currentYear}}/{{ $currentMonth }}/{{$totalDay}}</p>
                    </div>
                    <button type="button" class="close btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalContent_{{ $totalDay }}" class="modalContentBox mb-2">
                        <ul class="ulInModal">
                            @foreach($taskDate as $taskName => $taskDay)
                                @php
                                $count++;
                                 $differenceInDates = $filteredTasks[$taskName]['differenceInDates'];
                                 $endDate = $taskDay + $differenceInDates;
                                   $bgStatColorModal = "";
                                    $textColorModal = "";
                                    $bgStatColorModal = 'bg-web-primary';
                                    if($filteredTasks[$taskName]['is_pending']==1)
                                    {
                                        $bgStatColorModal = 'bg-warning';
                                    }
                                    elseif ($filteredTasks[$taskName]['is_approved']==1) {
                                    $bgStatColorModal = 'bg-success';
                                    }
                                    // else {
                                    //     $bgStatColorModal = 'bg-web-primary';
                                    //     $textColorModal = "text-white";
                                    // }
                                @endphp
                                
                                @if($totalDay>=$taskDay && $totalDay <= $endDate)
                                {{-- @if($taskDay == $totalDay) --}}
                                    @php
                                    $taskExists = true;
                                    $description = $taskDesc[$taskName] ?? 'No Description Available.';
                                    @endphp
                                    
                                    <div class="modalBodyContentWrapper">
                            <form action="{{ route('taskStatus.postStatus') }}" method="POST">
                                @csrf
                                <li class="listInsideModal m-2 {{ $bgStatColorModal }} {{ $textColorModal }}">
                                        <div class='d-flex flex-row'>
                                            <div>
                                            <div class="">
                                @if($filteredTasks[$taskName]['is_pending'] == 1)
                                            <input class="form-check-input task_checkbox d-none" type="checkbo  x" id="task_{{ $count }}">
                                            <span class="task-name mr-2">{{ $taskName }}</span>
                                            {{-- <button class="btn btn-secondary btn-sm mt-1 ml-2 statusButton" disabled>Pending</button> --}}
                                        @elseif($filteredTasks[$taskName]['is_approved'] == 1)
                                            <input class="form-check-input task_checkbox d-none" type="checkbox" id="task_{{ $count }}">
                                            <span class="task-name mr-2">{{ $taskName }}</span>
                                            {{-- <button class="btn btn-primary btn-sm statusButton" disabled>Completed</button> --}}
                                        @else
                                            <input class="form-check-input task_checkbox" type="checkbox" id="task_{{ $count }}">
                                            <span class="task-name mr-2 ml-2 nameFieldInModal">{{ $taskName }}</span>
                                            <br>
                                  @endif

                                    <input type="hidden" class="checkedTaskName" name="t_name">
                                    <input type="hidden" class="pendingStatus" name="pend_status" value="{{ $filteredTasks[$taskName]['is_pending'] }}">
                                    <input type="hidden" class="checkedIn" name="check_status" value="{{ $filteredTasks[$taskName]['is_approved'] }}">
                                </div>
                                           
                                        </div>
                                         {{-- <div class="d-flex justify-content-center align-items flex-column">
                                            <div class="task-container">
                                                <div>
                                                    <textarea name="taskDescription" id="taskDescription_{{ $count }}" placeholder="Enter Remarks" class="task_textarea d-none" maxlength='500'></textarea>
                                                </div>
                                                <div id="charCount_{{ $count }}" class="d-none char-count">
                                                    0/500
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary btn-sm check_button d-none">Submit</button>
                                            </div>
                                        </div> --}}
                                    </div>
                                            <div>
                                                <div class="card-body">
                                                   Description :  {{ $description }}
                                                </div>
                                            </div>
                                             <div class="d-flex justify-content-center align-items flex-column taskCountWrapper">
                                            <div class="task-container">
                                                <div>
                                                    <textarea name="taskDescription" id="taskDescription_{{ $count }}" placeholder="Enter Remarks" class="task_textarea d-none" maxlength='500'></textarea>
                                                </div>
                                                <div id="charCount_{{ $count }}" class="d-none char-count">
                                                    0/500
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary btn-sm check_button d-none">Submit</button>
                                            </div>
                                        </div>
                                    </li>
                                </form>
                                   </div>
                               @endif
                       
                            @endforeach
                            @if(!$taskExists)
                                <li class="listInsideModal">
                                    <div class='d-flex justify-content-start align-items-center align-content-center'>
                                        <p class="taskInModal">no records found!</p>
                                    </div>
                                </li>
                            @endif
            
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
@endforeach

        

        @for ($i = $totalDaysCount + $firstDayOfMonth - 1; $i % 7 !== 0; $i++)
            <li></li>
        @endfor
    </ul>
</div>
@endsection

@section('script')
<script>
      const filteredTasks = @json($filteredTasks);
$(document).ready(function() {
     $(document).on("change", '.task_checkbox', function() {
            const listItem = $(this).closest('li');
            const checkButton = listItem.find('.check_button');
            const taskName = listItem.find('.task-name').text().trim().replace('Task: ', '');
            const hiddenInputList = listItem.find(".checkedTaskName");
            const checkStat = listItem.find(".checkedIn");
            const taskDesc = listItem.find("[id^=taskDescription_]");
            const charCount = listItem.find("[id^=charCount_]");
            const maxChar = taskDesc.attr('maxlength'); 
            
            checkButton.on('click',function()
        {
            console.log("Hello world ! ");
        })

            function updateCharCount() {
                var currDescLength = taskDesc.val().length; 
                charCount.text(currDescLength + '/' + maxChar);
            }

            if ($(this).is(':checked')) {
                checkButton.removeClass('d-none');
                taskDesc.removeClass('d-none');
                charCount.removeClass('d-none');
                hiddenInputList.val(taskName);
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

        //for gridline view 
      
    
      
  
  
      
});




</script>
@endsection
