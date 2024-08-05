<?php

use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\CustomUserController;
use App\Http\Controllers\FilterTaskController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\TaskApprovalController;
use App\Http\Controllers\AnnualCalendarController;
use App\Http\Controllers\EmployeeTaskStatusController;

// Route::get('/',[AnnualAdminCalendar::class,'index'])->name("annualAdminCalendar.index");

//layout routes

//authentication 
Route::get('/login',[CustomUserController::class,'index'])->name("login");
Route::post('/logout',[CustomUserController::class,'logout'])->name("logout");

Route::get('/',[AnnualCalendarController::class,'index'])->name("layout.index");

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/annualCalender',[AnnualCalendarController::class,'index'])->name('annualCalendar.index');
});
//annual calendar routes
Route::get('/annualCalendar/create',[AnnualCalendarController::class,'create'])->name('annualCalendar.create');
Route::get('/annualCalendar/{id}/edit',[AnnualCalendarController::class,'edit'])->name('annualCalendar.edit');
Route::post('/annualCalendar/store',[AnnualCalendarController::class,'store'])->name('annualCalendar.store');
Route::put('/annualCalendar/{id}/update',[AnnualCalendarController::class,'update'])->name('annualCalendar.update');
Route::delete('/annualCalendar/{id}/delete',[AnnualCalendarController::class,'destroy'])->name('annualCalendar.destroy');
// Route::get("/annualCalendar/filter",[AnnualCalendarController::class,'filter'])->name("annualCalendar.filter");

//filter task

// Route::get("/filterTask",[FilterTaskController::class,'index'])->name("filterTask.index");

Route::get("/filterTask",[FilterTaskController::class,'index'])->name("filterTask.index");
Route::get("/filterTaskGrid",[FilterTaskController::class,'gridView'])->name("filterTask.gridView");

//TASK APPROVAL

Route::get("/taskStatus",[EmployeeTaskStatusController::class,'index'])->name("taskStatus.index");
Route::post("/taskStatus/sendData",[EmployeeTaskStatusController::class,'postStatus'])->name("taskStatus.postStatus");
Route::post('/taskStatus/{task_id}/{emp_id}/approveData', [EmployeeTaskStatusController::class, 'approveTask'])->name('taskStatus.approve');

// Route::get("/getStatus",[EmployeeTaskStatusController::class,'getStat'])->name("taskStatus.getStat");

//getting all the task from the user !
Route::Get('/filterTask/getAllTask/{id}',[FilterTaskController::class,'getAllTask'])->name('filterTask.getAllTask');

//Route to get the task into the modal of the grid layout 
// Route::get("")

Route::get("/testCalendar",[TestController::class,'testCalendar'])->name("test.calendar");