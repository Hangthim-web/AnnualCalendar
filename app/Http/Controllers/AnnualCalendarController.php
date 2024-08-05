<?php

namespace App\Http\Controllers;

use App\Models\CiUsers;
use App\Models\Section;
use App\Models\Employee;
use App\Mail\SmtpMailable;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

use App\Models\AnnualCalendar;
use App\Models\CiUsersDetails;
use App\Models\EmployeeTaskStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskAddedMail;


class AnnualCalendarController extends Controller
{
public function index(Request $request)
{
    $getUserId = getUserId();

    $selectedYear = $request->input('year', getCurrentYear());
    $selectedMonth = $request->input('month');
    $statusFilter = $request->input('status');

    $getUserType = getUserType();
    $userIdDetails = CiUsersDetails::where("user_id", $getUserId)->first();
    $empStatusId = EmployeeTaskStatus::where("employee_id", $getUserId)->first();

    $query = AnnualCalendar::query();

        if ($statusFilter && $statusFilter == 'pending') {
        $query->join('employee_task_status', 'annual_calendars.id', '=', 'employee_task_status.task_id')
            //   ->select('employee_task_status.is_pending','employee_task_status.is_approved','annual_calendars.task_name','annual_calendars.from_date','annual_calendars.to_date','annual_calendars.description','annual_calendars.from_date_bs','annual_calendars.to_date_bs')
              ->where('employee_task_status.is_pending','1');
        }
   

    if ($getUserType === "company") {
        // No specific filtering for company type
    } elseif ($getUserType === 'staff') {
        $userDepartment = ($userIdDetails->department_id ? $userIdDetails->department_id : 0);
        $userSection = ($userIdDetails->section_id ? $userIdDetails->section_id : 0);
        $userDesignation = ($userIdDetails->designation_id ? $userIdDetails->designation_id : 0);

        $where = "(
            (designation IS NULL OR designation = '') AND
            (section IS NULL OR section = '') AND
            (employee IS NULL OR employee = '') AND
            FIND_IN_SET($userDepartment, department) > 0
        ) OR (
            (designation IS NULL OR designation = '') AND
            (employee IS NULL OR employee = '') AND
            FIND_IN_SET($userSection, section) > 0 AND
            FIND_IN_SET($userDepartment, department) > 0
        ) OR (
            (employee IS NULL OR employee = '') AND
            FIND_IN_SET($userSection, section) > 0 AND
            FIND_IN_SET($userDepartment, department) > 0 AND
            FIND_IN_SET($userDesignation, designation) > 0
        ) OR (
            FIND_IN_SET($userIdDetails->user_id, employee) > 0
        )";

        $query->whereRaw($where);
    }

    // Apply the status filter if specified
   

    if ($selectedYear && $selectedYear !== 'all') {
        $query->whereYear('from_date_bs', $selectedYear);
    }

    if ($selectedMonth && $selectedMonth !== 'all') {
        $query->whereMonth('from_date_bs', $selectedMonth);
    }

  

    $annualCalendars = $query->paginate(10);

    return view('annual_calendar.index', [
        'annualCalendars' => $annualCalendars,
        'selectedYear' => $selectedYear,
        'selectedMonth' => $selectedMonth,
        'getUserType' => $getUserType,
        'getUserId' => $getUserId,
        'statusFilter' => $statusFilter,
    ]);
}





// public function filter(Request $request)
// {
//     $selectedYear = $request->year;
//     $selectedMonth = $request->month;
//     $taskDates = AnnualCalendar::pluck('from_date_bs');
//     $taskDatesArray = $taskDates->toArray();
//     $yearArray = [];
//     $monthArray = [];
//     foreach($taskDatesArray as $thisDates)
//     {
//         $yearArray = $thisDates[0];
//         $monthArray = $thisDates[1];
//     }


//     return view('annual_calendar.index',compact('filteredTask'));
// }
        public function create()
    {
        $designations = Designation::all();
        $sections = Section::all();
        $departments = Department::all();
        $employees = Employee::all();
        return view('annual_calendar.create',compact('designations','departments','sections','employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'from_date_bs' => 'required',
            'to_date_bs' => 'required',
            'department' => 'required|array|min:1',
            'designation' => 'nullable|array',
            'section' => 'nullable',
            'employee' => 'nullable',
            'monitor' => 'nullable',
            'supervisior' => 'nullable',
            'description' => 'nullable',
        ]);
        if($request->isMethod('POST'))
        {
            $task = new AnnualCalendar;
            $task->task_name = $request->task_name;
            $task->from_date = $request->from_date;
            $task->to_date = $request->to_date;
            $task->from_date_bs = $request->from_date_bs;
            $task->to_date_bs = $request->to_date_bs;
            $task->department = implode(",",$request->input('department',[]));
            $task->designation = implode(",",$request->input('designation',[]));
            $task->section = implode(",",$request->input('section',[]));
            $task->employee = implode(",",$request->input('employee',[]));
             $task->monitor = implode(",",$request->input('monitor',[]));
            $task->supervisior = implode(",",$request->input('supervisior',[]));
            $task->description = $request->description;


        }
        $employeeIds = explode(",",$task->employee);
        $departmentIds = explode(",",$task->department);

        $designationIds = explode(",",$task->designation);
        $sectionIds = explode(",",$task->section);
        $departmentStaffs = getStaffRelatedToDepartment($departmentIds);
        $designationStaffs = getStaffRelatedToDesignation($designationIds);
        $sectionStaffs = getStaffRelatedToSection($sectionIds);
        $employeeEmail = [];
            foreach($employeeIds as $employeeId)
        {
            $empId = CiUsers::where('user_id',$employeeId)->first();
            if($empId)
            {
                $empEmail = $empId->email;

                $employeeEmail[] = $empEmail;
            }else
            {
                null;
            }
        }

        // dd($st)

        $mergedUniqueArrayOfEmails = array_unique(array_merge($departmentStaffs,$designationStaffs,$sectionStaffs));
        // dd($mergedUniqueArrayOfEmails);
        // $this->sendEmail($mergedUniqueArrayOfEmails,$message="This is the message for email");

        $datas = [
            "task_name"=>$request->task_name,
            "from_date_bs"=>$request->from_date_bs,
            "to_date_bs"=>$request->to_date_bs,
            "description"=>$request->description,
        ];

        $mail = Mail::to($mergedUniqueArrayOfEmails)->send(new TaskAddedMail($datas));



        //functions for getting all the users from the department,sections and designation
        if($task->save()){

            $task->save();
            return redirect()->route('annualCalendar.index')->with('success','Task Added Successfully !');
        }




    }
      public function edit($encodedId)
    {
        $id = decodeData($encodedId);
        $tasks = AnnualCalendar::where("id",$id)->first();
        $designations = Designation::all();
        $sections = Section::all();
        $departments = Department::all();
        $employees = Employee::all();
        return view('annual_calendar.edit',compact('tasks','designations','sections','departments','employees'));
    }
    public function update($id,Request $request)
    {
         $request->validate([
            'task_name' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'from_date_bs' => 'required',
            'to_date_bs' => 'required',
            'department' => 'required|array|min:1',
            'designation' => 'nullable',
            'section' => 'nullable',
            'employee' => 'nullable',
            'monitor' => 'nullable',
            'supervisior' => 'nullable',
            'description' => 'nullable|max:500'
        ]);

        $task = AnnualCalendar::where("id",$id)->first();

            $task->task_name = $request->task_name;
            $task->from_date = $request->from_date;
            $task->to_date = $request->to_date;
            $task->from_date_bs = $request->from_date_bs;
            $task->to_date_bs = $request->to_date_bs;
             $task->department = implode(",",$request->input('department',[]));
            $task->designation = implode(",",$request->input('designation',[]));
            $task->section = implode(",",$request->input('section',[]));
            $task->employee = implode(",",$request->input('employee',[]));
             $task->monitor = implode(",",$request->input('monitor',[]));
            $task->supervisior = implode(",",$request->input('supervisior',[]));
                $task->description = $request->description;



        $task->save();
        return redirect()->route("annualCalendar.index")->with('success','Task Updated Successfully! ');
    }

    public function destroy($encodedId)
    {
        $id = decodeData($encodedId);
        $task = AnnualCalendar::where("id",$id)->first();
        $task->delete();
        return back()->with("success","Task Deleted Successfully ! ");

    }

    // public function sendEmail()
    // {
    //     // Assume $recipient is obtained from the request or other logic
    //     $recipient = 'recipient@example.com';

    //     Mail::to($recipient)->send(new SmtpMailable());

    //     return 'Email sent!';
    // }

    //  public function sendEmail($email,$message)
    // {


    //     $smtpdetails = getSMTPDetails();
    //     // Dynamic SMTP configuration
    //    $userId = getUserId();


    //            setSmtpConfig($smtpdetails);


    //     // Sending email
    //     // $data = ['message' => 'This is a test email.'];
    //     // Mail::send('emails.test', $data, function ($message) {
    //     //     $message->to('recipient@example.com', 'Recipient Name')
    //     //             ->subject('Test Email');
    //     // });

    //     // return 'Email sent successfully!';

    //     $mail = Mail::to($emails)->send(new UnblockRequestMail($deposit, $filename));


    // }


}

