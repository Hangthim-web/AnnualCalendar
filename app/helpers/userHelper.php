<?php

use App\Models\CiUsers;
use App\Models\Employee;
// use Illuminate\Support\Facades\Hash;
use App\Models\AnnualCalendar;
use App\Models\EmployeeTaskStatus;
use App\Models\SystemModel;
use App\Models\RolesModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\NepaliCalendar;

if(!function_exists('getFullName'))
{
    function getFullName($empId)
    {

        $emp = Employee::where("user_id",$empId)->first();
         return trim($emp->first_name . ' ' . $emp->middle_name . ' ' . $emp->last_name);

    }
}

if( !function_exists('staff_role_resource') ){
    // get user role > links > all
        function staff_role_resource(){

            // get session


            // get userinfo and role
            $user_info = CiUsers::where('user_id',getUserId())->first();
            $role_user = RolesModel::where('role_id', $user_info->user_role_id)->first();
            if($user_info['user_type'] == 'staff'){
                $role_resources_ids = explode(',',$role_user['role_resources']);
            } else {
                $role_resources_ids = array(0,0);
            }
            return $role_resources_ids;
        }
    }

if(!function_exists('getSystemLogo'))
{
    function getSystemLogo()
    {
       $system =  SystemModel::where('setting_id', 1)->first();

       return ['logo'=>"/public/uploads/logo/".$system->logo
                ,'favicon'=>"/public/uploads/logo/favicon/".$system->favicon];
    }
}

if(!function_exists('getSMTPDetails'))
{
    function getSMTPDetails()
    {
      return [  'host' =>"abc.com",
            'port' => 25,
            'encryption' => "SSL",
            'username' =>"demo@demo.com",
            'password' => "demo@1234",
            'from' => [
                'address' =>"demo@demo.com",
                'name' => "DEMO",
            ],
        ];
    }
}


if(!function_exists("getUserType"))
{
    function getUserType()
    {
        $userId = getUserId();
        if(!$userId)
        {
            return null;
        }
        $user = CiUsers::where('user_id',$userId)->first();
        if($user)
        {
            return $user->user_type;
        }
        else
        {
            return null;
        }


    }
}


// if(!function_exists("getUserFullName"))
// {
//     function getUserFullName()
//     {
//         $first_name = Employee::pluck("first_name");
//         $middle_name = Employee::pluck("middle_name");
//         $last_name = Employee::pluck("last_name");


//         return $first_name . ' ' . $middle_name . ' ' .  $last_name;
//     }

// }

// if(!function_exists('getTaskName'))
// {
//     function getTaskName()
//     {

//     }
// }

if(!function_exists('getNepaliYear'))
{
    function getNepaliYear()
    {
        $months = array();
       for($i=1;$i<=12;$i++)
       {
        $months[]=
        NepaliCalendar::getInstance()->_get_nepali_month_in_nepali($i);
       }

       return $months;
    }
}
if(!function_exists('getUserId'))
{
    function getUserId()
    {
        $env_user_id = env('USER_ID');


    $sessionCookie = $_COOKIE['ci_session'] ?? null;
    if($sessionCookie!=""){

    $response = Http::withoutVerifying()->withCookies(['ci_session' => $sessionCookie], env('APP_DOMAIN'))
            ->get(env('APP_URL').'/api/get-sup-username');
    // $response = Http::get(env('APP_URL').'/api/get-sup-username');

    if ($response->successful()) {
        $data = $response->json();
        // $supUsername = $data['sup_username'];
        // dd(env('APP_URL').'/api/get-sup-username');
        // dd($data['data']['sup_user_id']);
        if($data['data']!=null){
            $user_id =$data['data']['sup_user_id'];

            return $user_id;
        }else{
            return $env_user_id;

        }

        // Or handle the data as needed
    } else {
        // Handle the error
        return $env_user_id;

        // abort(500, 'Error calling CodeIgniter function.');
    }
    }else{
        return $env_user_id;
    }


    }
}

if(!function_exists('getSystemSMTP'))
{
    function getSystemSMTP()
    {
        $env_user_id = env('USER_ID');


    $sessionCookie = $_COOKIE['ci_session'] ?? null;
    if($sessionCookie!=""){

    $response = Http::withoutVerifying()->withCookies(['ci_session' => $sessionCookie], env('APP_DOMAIN'))
            ->get(env('APP_URL').'/api/get-sup-username');
    // $response = Http::get(env('APP_URL').'/api/get-sup-username');

    if ($response->successful()) {
        $data = $response->json();
        // $supUsername = $data['sup_username'];
        // dd(env('APP_URL').'/api/get-sup-username');
        // dd($data['data']['sup_user_id']);
        if($data['data']!=null){
            $user_id =$data['data']['sup_user_id'];

            return $user_id;
        }else{
            return $env_user_id;

        }

        // Or handle the data as needed
    } else {
        // Handle the error
        return $env_user_id;

        // abort(500, 'Error calling CodeIgniter function.');
    }
    }else{
        return $env_user_id;
    }


    }
}

if(!function_exists('getCurrentYear')){
    function getCurrentYear(){
        $date = date('Y-m-d');
        $dates = getNepaliDate($date);
$dates =$dates['year'].'-'.$dates['month'].'-'.$dates['date'];
        $year = explode('-',$dates)[0];

        return $year;

    }
}

if(!function_exists('getDayofWeekFromNepaliDate')){
    function getDayofWeekFromNepaliDate($date){

      $date =  getEnglishDate($date);

    //   dd($date);

    return $date['day'];

    }
}

if(!function_exists('getnthDayofWeekFromNepaliDate')){
    function getnthDayofWeekFromNepaliDate($date){

      $date =  getEnglishDate($date);

    //   dd($date);

    return $date['num_day'];

    }
}



if (!function_exists('getNepaliMonths')) {
    function getNepaliMonths() {
        $months = [];
        $currentMonth = getCurrentMonth();

        for ($i = 1; $i <= 12; $i++) {
            $nepaliMonth = NepaliCalendar::getInstance()->_get_nepali_month_in_nepali($i);
            $months[$i] = [
                'name' => $nepaliMonth,
                'is_current' => $i == $currentMonth
            ];
        }

        return $months;
    }
}

if (!function_exists('getCurrentMonth')) {
    function getCurrentMonth() {
        $date = date('Y-m-d');
        $dates = getNepaliDate($date);
        $dates =$dates['year'].'-'.$dates['month'].'-'.$dates['date'];
        $month = explode('-', $dates)[1];

        return $month;
    }
}



if(!function_exists('getNepaliDate')){
    function getNepaliDate($date){
        $dates = NepaliCalendar::getInstance()->eng_to_nep($date);
        // $dates =$dates['year'].'-'.$dates['month'].'-'.$dates['date'];
        return $dates;

    }
}

if (!function_exists('formattedDescription')) {
    function formattedDescription($description, $id)
    {
        $cleanedDescription = strip_tags($description);
        if (strlen($cleanedDescription) < 50) {
            return $description;
        } else {
            return mb_strimwidth($description, 0, 50, '...') . "<a data-bs-toggle='modal' href='#phraseViewModal{$id}' class='desc-link'>Show More</a>";
        }
    }
}
if (!function_exists('formatRemarks')) {
    function formatRemarks($description, $id)
    {
        $cleanedDescription = strip_tags($description);
        if (strlen($cleanedDescription) < 50) {
            return $description;
        } else {
            return mb_strimwidth($description, 0, 50, '...') . "<a data-bs-toggle='modal' href='#phraseViewModal{$id}' class='desc-link'>Show More</a>";
        }
    }
}

if(!function_exists('getEnglishDate')){
    function getEnglishDate($date){
        $explodeddate = explode('-',$date);
        $dates = NepaliCalendar::getInstance()->nep_to_eng($explodeddate[0],$explodeddate[1],$explodeddate[2]);
        // $dates =$dates['year'].'-'.$dates['month'].'-'.$dates['date'];
        return $dates;

    }
}
if(!function_exists('getTotalDays'))
{
    function getTotalDays($year,$month)
    {
        $days = array();
        $dates = NepaliCalendar::getInstance()->gettotaldays($year,$month);

        for($i=1;$i<=$dates;$i++)
        {
            $days[$i]= $i;
        }
        // dd($days);
        return $days;


    }
}

if(!function_exists('numberToDays'))
{
    function numberToDays($month)
    {
        $n_month=false;
        switch ($month) {
            case 1:
                $n_month = "वैशाख";
                break;

            case 2:
                $n_month = "जेठ";
                break;

            case 3:
                $n_month = "असार";
                break;

            case 4:
                $n_month = "साउन";
                break;

            case 5:
                $n_month = "भदौ";
                break;

            case 6:
                $n_month = "असोज";
                break;

            case 7:
                $n_month = "कार्तिक";
                break;

            case 8:
                $n_month = "मंसिर";
                break;

            case 9:
                $n_month = "पुष";
                break;

            case 10:
                $n_month = "माघ";
                break;

            case 11:
                $n_month = "फागुन";
                break;

            case 12:
                $n_month = "चैत";
                break;
        }
        return $n_month;
    }
}

// if(!function_exists('getNepaliMonths'))
// {
//     function getNepaliMonths()
//     {
//         $months = array();
//        for($i=1;$i<=12;$i++)
//        {
//         $months[]=
//         NepaliCalendar::getInstance()->_get_nepali_month_in_nepali($i);
//        }

//        return $months;
//     }
// }

if(!function_exists('getCompanyId()'))
{
    // function getCompanyId()
    // {
    //     $user = "annualCalendarAdmin";
    //     if($user)
    //     {
    //         return $user->company_id;
    //     }
    // }
}

if (!function_exists('getEmployees')) {
    function getEmployees() {
        $employees = \App\Models\Employee::where('user_type', 'staff')->get();
        return $employees;
    }
}

if(!function_exists('encodeData'))
{
    function encodeData($id)
    {
        return Crypt::encrypt($id);
    }
}
if(!function_exists('decodeData'))
{
    function decodeData($id)
    {
        return Crypt::decrypt($id);
    }
}

if (!function_exists('getDateDifference')) {
    function getDateDifference($datetime1, $datetime2)
    {

        $idatetime1 = date_create($datetime1);
        $idatetime2 = date_create($datetime2);
        $interval = date_diff($idatetime1, $idatetime2);
        $no_of_days = $interval->format('%a') + 1;

        return $no_of_days;
    }
}

if (!function_exists('differenceInDates')) {
    function differenceInDates($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        $diff = floor($diff / (60 * 60 * 24));
        return $diff;
    }
}

if(!function_exists('getUserPermission'))
{
    function getUserPermission()
    {
        // dd(staff_role_resource());
        $permissions = staff_role_resource();
        $userArray = $permissions;

        // $userArray = array('annualCalendarAdmin',);
        return $userArray;
    }
}

if (!function_exists("getTaskByUserId")) {
    function getTaskByUserId($id) {
        $taskArray = [];
        $query = AnnualCalendar::query();
      $userEmp  = " FIND_IN_SET($id,employee) > 0";
        $tasks = $query->whereRaw($userEmp)->get();


        $taskArray = $tasks->toArray();
        dd($taskArray);


        // return $taskArray;
    }
}
if(!function_exists("getEmail"))
{
    function getEmail($emailId,$message)
    {
        if(isset($emailId) && !empty($emailId) || isset($message) && !empty($message))
        {
            return true;
        }
    }
}
if(!function_exists('statusArray'))
{
    function statusArray()
    {
        return array("approved"=>"approved","ongoing"=>"ongoing","incomplete"=>"incomplete","pending"=>"pending",);
    }
}
// if (!function_exists('filterTaskWithStatus')) {
//     function filterTaskWithStatus($statusFilter, $query)
//     {
//         if ($statusFilter === 'isPending') {
//             $query->where('employee_task_status.is_pending', 1);
//         } elseif ($statusFilter === 'isApproved') {
//             $query->where('employee_task_status.is_approved', 1);
//         }
//         return $query;
//     }
// }

