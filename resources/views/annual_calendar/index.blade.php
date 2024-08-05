@extends('layouts.master')

@section('title')
    @lang('Dashboard')
@endsection

@section('content')
@if($getUserType==="staff")
@include('annual_calendar.employee_view')
@elseif($getUserType==="company")
@include('annual_calendar.company_view')
@endif
@endsection
