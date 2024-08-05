<?php

use App\Models\CiUsers;
use App\Models\CiUsersDetails;


if(!function_exists("getStaffRelatedToDepartment"))
{
    function getStaffRelatedToDepartment($departmentIds)
    {
        if($departmentIds)
        {

            $staffEmailFromDepartment = [];
            foreach($departmentIds as $id)
            {
                
                $userIds = CiUsersDetails::where("department_id",$id)->pluck('user_id');
                $emails = CiUsers::whereIn('user_id', $userIds)->pluck('email')->toArray();
                
                $staffEmailFromDepartment = array_merge($staffEmailFromDepartment,$emails);
                
                
            }
            $staffEmailFromDepartment = array_unique($staffEmailFromDepartment);
            return $staffEmailFromDepartment;
        }else
        {
            return null;
        }
     
}
}

if(!function_exists("getStaffRelatedToDesignation"))
{
    function getStaffRelatedToDesignation($designationIds)
    {
        if($designationIds)
        {

            $staffEmailFromDesignation = [];
            foreach($designationIds as $id)
            {
                
                $userIds = CiUsersDetails::where("designation_id",$id)->pluck('user_id');
                $emails = CiUsers::whereIn('user_id', $userIds)->pluck('email')->toArray();
                
                $staffEmailFromDesignation = array_merge($staffEmailFromDesignation,$emails);
                
                
            }
            $staffEmailFromDesignation = array_unique($staffEmailFromDesignation);
            return $staffEmailFromDesignation;
        }
        else
        {
            return null;
        }
        
    }
}

if(!function_exists("getStaffRelatedToSection"))
{
    function getStaffRelatedToSection($sectionIds)
    {
        if($sectionIds)
        {

            $staffEmailFromSection = [];
            foreach($sectionIds as $id)
            {
                
                $userIds = CiUsersDetails::where("section_id",$id)->pluck('user_id');
                $emails = CiUsers::whereIn('user_id', $userIds)->pluck('email')->toArray();
                
                $staffEmailFromSection = array_merge($staffEmailFromSection,$emails);
                
                
            }
            $staffEmailFromSection = array_unique($staffEmailFromSection);
            return $staffEmailFromSection;
        }
        else
        {
            return null;
        } 
     
    }
}