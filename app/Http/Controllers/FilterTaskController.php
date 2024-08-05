<?php

namespace App\Http\Controllers;


use Others\BsData;
use Illuminate\Http\Request;
use App\Models\AnnualCalendar;
use App\Models\EmployeeTaskStatus;

class FilterTaskController extends Controller
{
//     public function index()
//     {
//         // $currentYear = getCurrentYear();
//         // // dd($currentYear);
//         // $currentMonth = getCurrentMonth();
//         // // dd($currentMonth);

//         // $taskDates = AnnualCalendar::pluck('from_date_bs','task_name');
//         // $taskDatesArray = $taskDates->toArray();
//         // $ind_date = [];
//         // foreach($taskDatesArray as $indTask)
//         // {
//         //     $ind_date[] = explode('-',$indTask);
//         // }
//         // $taskYear = [];
//         // $taskMonth = [];
//         // $filteredTask = [];
//         // foreach($ind_date as $split_date)
//         // {
//         //     $year[] = $split_date[0];
//         //     $month[] = $split_date[1];
//         // }
//         // if ($taskYear == $currentYear && $taskMonth == $currentMonth) {

//         //     $filteredTasks[$taskName] = $date;
//         // }


//      $currentYear = getCurrentYear();
//     $currentMonth = getCurrentMonth();


//     $taskDates = AnnualCalendar::pluck('from_date_bs', 'task_name');
//     $taskDatesArray = $taskDates->toArray();


//     $year = [];
//     $month = [];
//     $filteredTasks = [];

//     foreach ($taskDatesArray as $taskName => $date)
//     {

//         $splitDate = explode('-', $date);
//         $taskYear = $splitDate[0];
//         $taskMonth = $splitDate[1];


//         $year[] = $taskYear;
//         $month[] = $taskMonth;


//         if ($taskYear == $currentYear && $taskMonth == $currentMonth) {
//          $filteredTasks[$taskName] = $date;
//         }
//     }


//     return view('filterTask.index',compact("filteredTasks"));
// }
public function index(Request $request)
{
    $userId = getUserId();
    $getUserTypes = getUserType();
    $currentYear = $request->input('year', getCurrentYear());
    $currentMonth = $request->input('month', getCurrentMonth());
    $selectedDate = $request->input('date', 'all');

    $totalDays = getTotalDays($currentYear, $currentMonth);
    $taskDatesArray = [];

    if ($getUserTypes === "company") {
        $taskDates = AnnualCalendar::leftJoin('employee_task_status', 'annual_calendars.id', '=', 'employee_task_status.task_id')
            ->select('annual_calendars.from_date_bs','annual_calendars.to_date_bs','annual_calendars.id','annual_calendars.task_name', 'employee_task_status.is_pending', 'employee_task_status.is_approved')
            ->get()
            ->toArray();
    } elseif ($getUserTypes === "staff") {
        $taskDates = AnnualCalendar::leftJoin('employee_task_status', 'annual_calendars.id', '=', 'employee_task_status.task_id')
            ->whereRaw("FIND_IN_SET(?, employee) > 0", [$userId])
            ->select('annual_calendars.from_date_bs','annual_calendars.to_date_bs','annual_calendars.id', 'annual_calendars.task_name', 'employee_task_status.is_pending', 'employee_task_status.is_approved')
            ->get()
            ->toArray();
    }
    dd($taskDates);

    $filteredTasks = [];
    $taskDate = [];
    // dd($taskDates);

    if ($selectedDate == 'all') {
        foreach ($taskDates as $task) {
            $fromDateSplit = explode('-', $task['from_date_bs']);
            $taskYear = $fromDateSplit[0];
            $taskMonth = $fromDateSplit[1];
            $taskDay = $fromDateSplit[2];



    if ($taskYear == $currentYear && $taskMonth == $currentMonth) {
                    $taskId = $task['id'];
                    $fromDate = $task['from_date_bs'];
                    $toDate = $task['to_date_bs'];
                    $taskName = $task['task_name'];
                    $differenceInDates = differenceInDates($fromDate,$toDate);
                    $isPending = $task['is_pending'];
                    $isApproved = $task['is_approved'];

                $filteredTasks[$task['task_name']] = [
                    'fromDate' => $task['from_date_bs'],
                    'toDate' => $task['to_date_bs'],
                    'is_pending' => $task['is_pending'],
                    'is_approved' => $task['is_approved'],
                    'differenceInDates'=> $differenceInDates,
                    'taskId' => $taskId,
                ];
                $taskDate[$task['task_name']] = $taskDay;
            }
        }
    }



    return view('filterTask.index', [
        'filteredTasks' => $filteredTasks,
        'selectedYear' => $currentYear,
        'selectedMonth' => $currentMonth,
        'selectedDate' => $selectedDate,
        'totalDays' => $totalDays,
        'taskDate' => $taskDate,
    ]);

}




 public function gridView(Request $request)
    {
        $userId = getUserId();
        $getUserTypes = getUserType();
        $currentYear = $request->input('year', getCurrentYear());
        $currentMonth = $request->input('month', getCurrentMonth());
        // dd($currentYear);
        // dd($currentMonth);

        $totalDays = getTotalDays($currentYear, $currentMonth);

        if ($getUserTypes === "company") {

            $taskDates = AnnualCalendar::leftJoin('employee_task_status', 'annual_calendars.id', '=', 'employee_task_status.task_id')
                ->select('annual_calendars.from_date_bs','annual_calendars.description','annual_calendars.from_date','annual_calendars.to_date','annual_calendars.to_date_bs', 'annual_calendars.id','annual_calendars.task_name', 'employee_task_status.is_pending', 'employee_task_status.is_approved')
                ->get()
                ->toArray();
        } elseif ($getUserTypes === "staff") {

            $taskDates = AnnualCalendar::leftJoin('employee_task_status', 'annual_calendars.id', '=', 'employee_task_status.task_id')
                ->whereRaw("FIND_IN_SET(?, employee) > 0", [$userId])
                ->select('annual_calendars.from_date_bs'
                ,'annual_calendars.description'
                ,'annual_calendars.from_date'
                ,'annual_calendars.to_date'
                ,'annual_calendars.to_date_bs','annual_calendars.id','annual_calendars.task_name'
                , 'employee_task_status.is_pending',
                 'employee_task_status.is_approved')
                ->get()
                ->toArray();
        }


        $filteredTasks = [];
        // $taskDate = [];


        // dd($taskDates);



        return view('filterTask.newCalendarView', compact('totalDays',  'currentYear', 'currentMonth','taskDates'));
    }

    public function getAllTask($userId)
    {
        $tasks = getTaskByUserId($userId);

    }
}


