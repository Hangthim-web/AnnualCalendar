@include('includes.bootstrapcdn')

@extends('layouts.master')
@section('title')
@lang('Dashboard')
@endsection
@section('content')
<style>
   
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .return_payment_field, .post_payment_field
    {
        display:none;
    }
    textarea{
        resize:none;
    }
 
</style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5 class="card-title">Edit Task</h5>
            <a href="{{route('annualCalendar.index')}}" class="btn btn-danger btn-sm" title="Close"><i
                    class="dripicons-cross"> </i></a>
        </div>
        <div class="card-body">
          {{-- @include('errors.error')  --}}
            <form action="{{ route('annualCalendar.update',$tasks->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method("PUT")
                <div class="row">
                <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="task_name">Task</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('task_name') is-invalid @enderror" id="task_name" name="task_name" value={{old('task_name',$tasks->task_name)}} >
                            @error("task_name")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                        
                          
                        </div>
                </div>
                <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="description" class="form-label">Task Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description',$tasks->description)==null?'selected':'' }}</textarea>
                            {{-- <span class="text-danger"> </span> --}}
                            
                            @error("description")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          
                        </div>
                </div>
                   <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="from_date">From Date(A.D)</label>
                            <span class="text-danger"> *</span>
                            <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" value={{old("from_date",$tasks->from_date)}}>
                            @error("from_date")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          </div>
                </div>
                 <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="to_date">To Date(A.D)</label>
                            <span class="text-danger"> *</span>
                            <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" value={{old("to_date",$tasks->to_date)}}>
                            @error("to_date")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          </div>
                </div>
                  <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="from_date_bs">From Date (B.S)</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('from_date_bs') is-invalid @enderror nepalipicker"  id="from_date_bs" name="from_date_bs" readonly
                                value="{{ old('from_date_bs',$tasks->from_date_bs) }}"  data-single="1">
                            @error('from_date_bs')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="to_date_bs">To Date(B.S)</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('to_date_bs') is-invalid @enderror nepalipicker" id="to_date_bs" readonly
                                name="to_date_bs" data-single='1' value="{{old("to_date_bs",$tasks->to_date_bs)}}">
                            @error('to_date_bs')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-6 col-xl-4 mt-3">
                    <div class="form-group">
                        <label for="department">Department<span class=" text text-danger"> *</span></label> <br/>
                        
                        <select name="department[]" id="selectdDepartment" class=" @error('department') is-invalid @enderror" multiple>
                            <option value="" disabled {{ old('department') === null ? 'selected' : '' }}>Choose Department</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->department_id }}" {{ in_array($department->department_id, old('department', explode(',', $tasks->department))) ? 'selected' : '' }}>{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                          <span id="departmentError" class="text-danger" style="display: none;">Please select at least one department.</span>
                        @error('department')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="designation">Designation</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="designation[]" id="selectedDesignation" class=" @error("designation") is-invalid @enderror" multiple>
                            <option value="" disabled {{old("designation")===null?'selected':''}} >Choose Designation</option>
                            @foreach($designations as $designation)
                            <option value="{{ $designation->designation_id }}" {{ in_array($designation->designation_id, old('designatoin', explode(',', $tasks->designation))) ? 'selected' : '' }} >{{ $designation->designation_name }}</option>
                            @endforeach
                           </select>
                            @error('designation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="section">Section</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="section[]" id="selectedSection" class=" @error("section") is-invalid @enderror" multiple>
                            <option value="" disabled {{old("section")===null?'selected':''}} >Choose Section</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->section_id }}" {{ in_array($section->section_id, old('section', explode(',', $tasks->section))) ? 'selected' : '' }} >{{ $section->section_name }}</option>
                            @endforeach
                           </select>
                            @error('section')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="employee">Employee</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="employee[]" id="selectedEmployee" class=" @error("employee") is-invalid @enderror" multiple>
                            <option value="" disabled {{old("employee")===null?'selected':''}} >Choose Employee</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ in_array($employee->user_id, old('employee', explode(',', $tasks->employee))) ? 'selected' : '' }} >{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                            @error('employee')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="monitor">Monitor</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="monitor[]" id="selectedMonitor" class=" @error("monitor") is-invalid @enderror" multiple>
                            <option value="" disabled {{old("monitor")===null?'selected':''}} >Choose Monitor</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ in_array($employee->user_id, old('monitor', explode(',', $tasks->monitor))) ? 'selected' : '' }}  >{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                            @error('monitor')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="supervisior">Supervisior</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="supervisior[]" id="selectedSupervisior" class=" @error("supervisior") is-invalid @enderror" multiple>
                            <option value="" disabled {{old("supervisior")===null?'selected':''}} >Choose Supervisior</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ in_array($employee->user_id, old('supervisior', explode(',', $tasks->supervisior))) ? 'selected' : '' }}>{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                            @error('supervisior')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                      
                    
                    
                    <div>
                        {{-- <button id="checkButton" tpye="button">Check button </button> --}}
                    </div>
                

                
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            </form>
        

    </div>
    @section('script')
    <script>
        $(document).ready(function()
    {

          VirtualSelect.init({
                ele: 'select',
                maxWidth : '400px',
               
            
         

            });
       

        $('#checkButton').on("click",function()
    {
        console.log("this is the function ! ");
    })
        $('.nepalipicker').nepaliDatePicker();




    $('#from_date').on('change',function(event)
    {
        // console.log("start date was called ! ")
        let inputDate = $("#from_date").val();
        let splitted = inputDate.split("-",3);
        let dateYear = {
            'year' : splitted[0],
            'month' : splitted[1],
            'day'  : splitted[2]
        };
        let nepaliDate = NepaliFunctions.AD2BS(dateYear);
        let finalNepaliDate = nepaliDate.year + '-' + nepaliDate.month + '-' + nepaliDate.day;
        document.getElementById('from_date_bs').value = finalNepaliDate;


    });
    $('#from_date_bs').on('change',function(event)
    {
        
        changedNepaliDate(event,'from_date_bs','from_date');
    });










    $('#to_date').on('change',function(event)
    {
        let inputDate = $('#to_date').val();
        let splitted = inputDate.split('-',3);
        let dateYear = {
            'year' : splitted[0],
            'month' : splitted[1],
            'day' : splitted[2]
        };
        let nepaliDate = NepaliFunctions.AD2BS(dateYear);
        let finalNepaliDate = nepaliDate.year + '-' + nepaliDate.month + "-" + nepaliDate.day;
        document.getElementById('to_date_bs').value = finalNepaliDate;

    });
    $("#to_date_bs").on("change",function(event)
    {
        changedNepaliDate(event,'to_date_bs','to_date');
    })

    function delay(time)
    {
        return new Promise(resolve => setTimeout(resolve,time));

    }
    async function changedNepaliDate(x,id,toid)
    {
     
        await delay(500);
        let inputDate = $('#' + id).val();
        let splitted = inputDate.split("-",3);
        let dateYear = {
            'year':splitted[0],
            'month':splitted[1],
            'day':splitted[2]
        };
        let englishDate = NepaliFunctions.BS2AD(dateYear);

        let finalEnglishDate = englishDate.year + '-' + englishDate.month + '-' + englishDate.day;
        document.getElementById(toid).value = finalEnglishDate;
    }

     $('form').on('submit', function(event) {
    
            var departmentSelect = $('#selectDepartment');
            var departmentError = $('#departmentError');
            var isValid = false;

            if (departmentSelect.val() && departmentSelect.val().length > 0) {
                isValid = true;
                departmentError.hide(); 
            } else {
                isValid = false;
                departmentError.show();
            }

        
            if (!isValid) {
                event.preventDefault();
            }
    });

    });


   



   
    

    </script>
    @endsection
@endsection
