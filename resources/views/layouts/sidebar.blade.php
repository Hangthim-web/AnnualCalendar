{{-- @include('includes.bootstrapcdn') --}}
{{-- @extends('layouts.master') --}}

<div class="vertical-menu">
    <div class="navbar-brand-box">
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ $getSystemLogo['favicon'] }}" alt=""
                    height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ $getSystemLogo['logo'] }}" alt=""
                    height="40">
            </span>
        </a>
        <a href="{{ url('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ $getSystemLogo['favicon'] }}" alt=""
                    height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ $getSystemLogo['logo'] }}" alt=""
                    height="20">
            </span>
        </a>
    </div>
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="/" class="waves-effect">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @php
                $userRole = "annualCalendarAdmin";
                @endphp

                @if ($userRole === 'annualCalendarAdmin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-calendar-alt"></i>
                        <span>@lang('Calendar')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('annualCalendar.index') }}"> <i class="fas fa-calendar-day"></i>Task</a></li>
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-filter"></i>Annual Calendar
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('filterTask.index') }}"><i class="fas fa-list"></i> List View</a></li>
                                <li><a href="{{ route('filterTask.gridView') }}"><i class="fas fa-th"></i> Grid View</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('filterTask.gridView') }}"> <i class="fas fa-calendar-day"></i>Annual Calendar</a></li>
                        <li><a href="{{ route('taskStatus.index') }}"> <i class="fas fa-tasks"></i>Task Approval</a></li>
                        {{-- <li><a href="{{ route('test.calendar') }}"> <i class="fas fa-tasks"></i>Test Calendar</a></li> --}}
                    </ul>
                </li>
                @endif

                {{-- Other menu items can go here... --}}

                {{-- <li>
                    <a href="{{ route('logout') }}" class="waves-effect">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
