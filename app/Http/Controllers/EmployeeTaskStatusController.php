<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\AnnualCalendar;
use App\Models\EmployeeTaskStatus;

class EmployeeTaskStatusController extends Controller
{

    public function index(){
         $userId = getUserId();
                         $where = " FIND_IN_SET($userId,annual_calendars.supervisior) > 0 OR  FIND_IN_SET($userId,annual_calendars.monitor) > 0";
                     $annualCal =    EmployeeTaskStatus::select('annual_calendars.*','employee_task_status.employee_id','employee_task_status.is_approved','employee_task_status.is_pending')
                     ->leftJoin('annual_calendars','employee_task_status.task_id','=','annual_calendars.id')
                     ->whereRaw($where)
                     ->get();
                     return view("approveTask.index", compact('annualCal'));
    }

//  public function index()
// {

//     $is_monitor = false;
//     $is_supervisor = false;

//     $userId = getUserId();


//     // $checkSupervisor = AnnualCalendar::where('supervisior', $userId)->exists();
//     // $checkMonitor = AnnualCalendar::where('monitor', $userId)->exists();
//     // if($checkSupervisor)
//     // {
//     //     $is_supervisor = true;
//     // }
//     //  if($checkMonitor)
//     // {
//     //     $is_monitor = true;
//     // }

//     // $mon_taskId = "";


//     // if($is_monitor || $is_supervisor)
//     // {
//     //        $mon_taskId = AnnualCalendar::whereIn(function ($query) use ($userId) {
//     //     $query->whereIn('monitor', $userId)
//     //           ->orWhereIn('supervisior', $userId);
//     // })->pluck('id');
//     // }
//     // dd($mon_taskId);
//                 $where = " FIND_IN_SET($getUserId,supervisior) > 0 OR  FIND_IN_SET($getUserId,monitor) > 0";

// AnnualCalendar::whereRaw($where)->

//     // Fetch task IDs associated with the user
//     $taskIds = EmployeeTaskStatus::where('employee_id', $userId)
//                                  ->pluck('task_id')
//                                  ->toArray();

//     // Fetch the calendar tasks based on task IDs
//     $calendarTasks = AnnualCalendar::whereIn('id', $taskIds)->get();

//     // Map task names with their IDs
//     $taskNames = $calendarTasks->pluck('task_name', 'id')->toArray();
//     $monitors = $calendarTasks->pluck('monitor', 'id')->toArray();



//     // dd($monitors);
//     $supervisors = $calendarTasks->pluck('supervisor', 'id')->toArray();

//     // Fetch pending and approved status for each task
//     $pendingStat = EmployeeTaskStatus::whereIn('task_id', $taskIds)
//                                      ->where('employee_id', $userId)
//                                      ->pluck('is_pending', 'task_id')->toArray();
//     $approvedStat = EmployeeTaskStatus::whereIn('task_id', $taskIds)
//                                      ->where('employee_id', $userId)
//                                      ->pluck('is_approved', 'task_id')->toArray();

//     // Fetch employee details
//     $employee = Employee::where('user_id', $userId)->first(['first_name', 'middle_name', 'last_name']);
//     $empName = $employee ? trim("{$employee->first_name} {$employee->middle_name} {$employee->last_name}") : 'Unknown';

//     $filteredTaskIds = [];
//     $filteredTaskNames = [];
//     $filteredEmpNames = [];
//     $filteredMonitors = [];
//     $filteredSupervisors = [];

//     foreach ($taskNames as $id => $name) {
//         if (isset($pendingStat[$id]) && $pendingStat[$id] == "1") {
//             $filteredTaskIds[] = $id;
//             $filteredTaskNames[] = $name;
//             $filteredEmpNames[] = $empName;

//             $filteredMonitors[] = isset($monitors[$id]) ? $monitors[$id] : 'No Monitor Assigned';
//             $filteredSupervisors[] = isset($supervisors[$id]) ? $supervisors[$id] : 'No Supervisor Assigned';
//         }
//     }

//     return view("approveTask.index", [
//         'filteredTaskIds' => $filteredTaskIds,
//         'filteredTaskNames' => $filteredTaskNames,
//         'empNames' => $filteredEmpNames,
//         'monitors' => $filteredMonitors,
//         'supervisors' => $filteredSupervisors
//     ]);
// }


 public function postStatus(Request $request)
{
    $userId = getUserId();
    $taskNames = $request->input('t_name');
    $task_description = $request->input('taskDescription');

    dd($request->all());
    // $task = AnnualCalendar::where('task_name', $taskNames)->first();


    // if (!$task) {
    //     return redirect()->route('filterTask.index')->with('error', 'Task not found.');
    // }

    $task_id = $request->task_id;
    $task = AnnualCalendar::where("id",$task_id)->first();
    $monitors  = explode(',',$task->monitor);
    $supervisors = explode(',',$task->supervisior);
    $both = array_unique(array_merge($monitors,$supervisors));


    $sm_email = [];
    foreach($both as $s_person)
    {
        $empId = Employee::where('user_id',$s_person)->first();
        $empEmail = $empId?->email;
        $sm_email[] = $empEmail;
    }
 
    $all_employees = explode(',', $task->employee);
  

    if (in_array($userId, $all_employees)) {
        EmployeeTaskStatus::updateOrCreate([
            'task_id' => $task_id,
            'employee_id' => $userId,
            'task_description' => $task_description,
        ], [
            'is_checked' => $request->check_status,
            'is_pending' => $request->pend_status,
            'is_approved' => '0',
        ]);
    } else {
        return redirect()->route('filterTask.index')->with('error', 'You are not authorized to perform this action for this task.');
    }

    return redirect()->route('filterTask.index')->with('success', 'You have successfully submitted your task. Please wait patiently for your approval!');
}


// public function approveTask(Request $request)
// {
//     $userId = getUserId();
//     $taskIds = $request->input('taskIds', []);
//     $taskNames = $request->input('taskNames', []);
//     $empNames = $request->input('empNames', []);

//     if (count($taskIds) === count($taskNames) && count($taskNames) === count($empNames)) {
//         foreach ($taskIds as $index => $taskId) {
//             $taskName = $taskNames[$index];
//             $empName = $empNames[$index];


//             EmployeeTaskStatus::where('task_id', $taskId)
//                 ->where('employee_id', $userId)
//                 ->update([
//                     'is_approved' => '1',
//                     'is_pending' => '0',
//                 ]);
//         }
//     }

//     return redirect()->route('taskStatus.index')->with('success', 'Tasks approved successfully.');
// }

public function approveTask(Request $request,$id,$emp_id)
{
     $employeeId = Employee::where("user_id",$emp_id)->first();
     $empEmail = $employeeId->email;
     $message = ' ';
     dd($empEmail);



     EmployeeTaskStatus::where("task_id",$id)->where("employee_id",$emp_id)->update([
        'is_approved' => '1',
        'is_pending' => '0',
     ]);

     return redirect()->route("taskStatus.index")->with("success",'Task Approved Successfully');

}





}
