{{-- @include('includes.bootstrapcdn') --}}


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

   .content {
            display: none;
        }


        .dropdown-class,
        .desig_dropdown-class,
        .branch_dropdown-class,
        .employee_dropdown-class,
        .section_dropdown-class {
            cursor: pointer;
            position: relative;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .select-container {
            position: relative;
        }

        .dropdown-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            /* So the click passes through to the input */
        }

        .check-content,
        .desig_check-content,
        .branch_check-content,
        .employee_check-content,
        .section_check-content {
            display: none;
            /* Initially hide the dropdown content */
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* Ensure it's above other content */
            overflow-y: auto;
            /* Add scrollbar when content exceeds height */
            max-height: 200px;
            /* Adjust the maximum height as needed */
        }

        .check-content ul,
        .desig_check-content ul,
        .branch_check-content ul,
        .employee_check-content ul,
        .section_check-content ul {
            list-style: none;
            margin: 0;
            padding: 10px;
        }

        .check-content ul li,
        .desig_check-content ul li,
        .branch_check-content ul li,
        .employee_check-content ul li,
        .section_check-content ul li {
            padding: 5px 0;
        }

        /* .pluginStyle .form-label select 
        {
            padding: 100px
            border-radius: 50% !important;
        }
         */
        
textarea 
    {
        resize:none;
    }
  
</style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5 class="card-title">Add New Task</h5>
            <a href="{{route('annualCalendar.index')}}" class="btn btn-danger btn-sm" title="Close"><i
                    class="dripicons-cross"></i></a>
        </div>
        <div class="card-body">
          {{-- @include('errors.error')  --}}
            <form action="{{ route('annualCalendar.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="task_name">Task</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('task_name') is-invalid @enderror" id="task_name" name="task_name" value={{old("task_name")}}>
                            @error("task_name")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          
                        </div>
                </div>
                                <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="description" class="form-label">Task Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old("description") }}</textarea>

                            @error('description')
                                <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    </div>

                   <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="from_date">From Date(A.D)</label>
                            <span class="text-danger"> *</span>
                            <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" value={{old("from_date")}} >
                            @error("from_date")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          </div>
                </div>
                <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="from_date_bs">From Date (B.S)</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('from_date_bs') is-invalid @enderror nepalipicker"  id="from_date_bs" name="from_date_bs" 
                                value="{{ old('from_date_bs') }}"  data-single="1" readonly>
                            @error('from_date_bs')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                 <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="to_date">To Date(A.D)</label>
                            <span class="text-danger"> *</span>
                            <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" value={{old('to_date')}} >
                            @error("to_date")
                            <strong class="text text-danger"><span>{{ $message }}</span></strong>
                            @enderror
                           
                          </div>
                </div>
                  
                
                    <div class="col-md-6 col-xl-4 mt-3">
                        <div class="form-group">
                            <label for="to_date_bs">To Date(B.S)</label>
                            <span class="text-danger"> *</span>
                            <input type="text" class="form-control @error('to_date_bs') is-invalid @enderror nepalipicker" id="to_date_bs"
                                name="to_date_bs" data-single='1' value="{{old("to_date_bs")}}" readonly>
                            @error('to_date_bs')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            {{-- <span class="text-danger"> *</span> --}}
                            <label for="department" class="form-label">Department <span class="text text-danger"> *</span></label> <br/>
                                <select name="department[]" id="selectDepartment" class=" @error('department') is-invalid @enderror" multiple>
                                    <option value="" disabled {{ old('department') === null ? 'selected' : '' }}>Choose Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}" {{ old('department') == $department->department_id ? 'selected' : '' }}>{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                    <span id="departmentError" class="text-danger" style="display: none;">Please select at least one department.</span>
                                @error('department')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            <label for="section">Section</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="section[]" id="selectedSection" class=" @error("section") is-invalid @enderror" multiple >
                            <option value="" disabled {{old("section")===null?'selected':''}} >Choose Section</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->section_id }}" {{ old("section")==$section->section_id?'selected':'' }} >{{ $section->section_name }}</option>
                            @endforeach
                           </select>
                              @error('section')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                                @enderror
                        </div>
                    </div>

                    
                           <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            <label for="designation">Designation</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="designation[]" id="selectedDesignation" class="rounded @error("designation") is-invalid @enderror" multiple >
                            <option value="" disabled {{old("designation")===null?'selected':''}} >Choose Designation</option>
                            @foreach($designations as $designation)
                            <option value="{{ $designation->designation_id }}" {{ old("designation")==$designation->designation_id?'selected':'' }} >{{ $designation->designation_name }}</option>
                            @endforeach
                           </select>
                             @error('designation')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                            @enderror
                        </div>
                    </div>
                    


                   
                    
                      <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            <label for="employee">Employee</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="employee[]" id="selectedEmployee" class=" @error("employee") is-invalid @enderror" multiple >
                            <option value="" disabled {{old("employee")===null?'selected':''}} >Choose Employee</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ old("employee")==$employee->user_id?'selected':'' }} >{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                            @error('employee')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                                @enderror
                        </div>
                    </div>
                        <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            <label for="monitor">Monitor</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="monitor[]" id="selectedMonitor" class=" @error("monitor") is-invalid @enderror" multiple >
                            <option value="" disabled {{old("monitor")===null?'selected':''}} >Choose Monitor</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ old("employee")==$employee->user_id?'selected':'' }} >{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                              @error('monitor')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                                @enderror
                        </div>
                    </div>
                        <div class="col-md-6 col-xl-4 mt-3 ">
                        <div class="form-group">
                            <label for="supervisior">Supervisior</label> <br/>
                            {{-- <span class="text-danger"> *</span> --}}
                           <select name="supervisior[]" id="selectedSupervisior" class=" @error("supervisior") is-invalid @enderror" multiple >
                            <option value="" disabled {{old("supervisior")===null?'selected':''}} >Choose Supervisior</option>
                            @foreach(getEmployees() as $employee)
                            <option value="{{ $employee->user_id }}" {{ old("employee")==$employee->user_id?'selected':'' }} >{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}</option>
                            @endforeach
                           </select>
                              @error('supervisior')
                                <strong>
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                </strong>
                                @enderror
                        </div>
                    </div>

                    {{-- <div>
                        <button type="button" id="checking">Check desig list </button>
                    </div> --}}
                      
                    
                    
                    

                
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
        $(document).ready(function() {

            // $("#selectDepartment").filterMultiSelect();



            $('.nepalipicker').nepaliDatePicker();

            VirtualSelect.init({
                ele: 'select',
                maxWidth : '400px',
                additionalClasses : 'borderRadius',
 
            });


            $('#from_date').on('change', function(event) {
                // console.log("start date was called ! ")
                let inputDate = $("#from_date").val();
                let splitted = inputDate.split("-", 3);
                let dateYear = {
                    'year': splitted[0],
                    'month': splitted[1],
                    'day': splitted[2]
                };
                let nepaliDate = NepaliFunctions.AD2BS(dateYear);
                let finalNepaliDate = nepaliDate.year + '-' + nepaliDate.month + '-' + nepaliDate.day;
                document.getElementById('from_date_bs').value = finalNepaliDate;


            });
            $('#from_date_bs').on('change', function(event) {

                changedNepaliDate(event, 'from_date_bs', 'from_date');
            });










            $('#to_date').on('change', function(event) {
                let inputDate = $('#to_date').val();
                let splitted = inputDate.split('-', 3);
                let dateYear = {
                    'year': splitted[0],
                    'month': splitted[1],
                    'day': splitted[2]
                };
                let nepaliDate = NepaliFunctions.AD2BS(dateYear);
                let finalNepaliDate = nepaliDate.year + '-' + nepaliDate.month + "-" + nepaliDate.day;
                document.getElementById('to_date_bs').value = finalNepaliDate;

            });
            $("#to_date_bs").on("change", function(event) {
                changedNepaliDate(event, 'to_date_bs', 'to_date');
            })

            function delay(time) {
                return new Promise(resolve => setTimeout(resolve, time));

            }
            async function changedNepaliDate(x, id, toid) {

                await delay(500);
                let inputDate = $('#' + id).val();
                let splitted = inputDate.split("-", 3);
                let dateYear = {
                    'year': splitted[0],
                    'month': splitted[1],
                    'day': splitted[2]
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
