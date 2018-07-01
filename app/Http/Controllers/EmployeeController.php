<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('add-employee')->with('employees', Employee::all());
    }

    public function saveEmployee(Request $request)
    {
        if(empty($request->name) || empty($request->email) || empty($request->role) || empty($request->salary)) {
            return back()->with('warning', 'All fields are required.');
        }
        else if(!is_numeric($request->salary)) {
            return back()->with('warning', 'Salary must be numeric.');
        }
        else if(Employee::where('email', $request->email)->first()) {
            return back()->with('danger', 'Email already exists');
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->save();
        return back()->with('success', 'Employee added.');
    }

    public function updateEmployee($id) {
        return view('update-employee')->with('employee', Employee::where('id', $id)->first());
    }

    public function saveUpdatedEmployee(Request $request, $id) {
        if(empty($request->name) || empty($request->email) || empty($request->role) || empty($request->salary)) {
            return back()->with('warning', 'All fields are required.');
        }
        else if(!is_numeric($request->salary)) {
            return back()->with('warning', 'Salary must be numeric.');
        }
        $employee = Employee::where('email', $request->email)->first();
        if($employee && $employee->id != $id) {
            return back()->with('danger', 'Email already exists');
        }

        Employee::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'salary' => $request->salary
        ]);;
        /*$updateEmployee->name = $request->name;
        $updateEmployee->email = $request->email;
        $updateEmployee->role = $request->role;
        $updateEmployee->salary = $request->salary;
        $updateEmployee->save();*/
        return back()->with('success', 'Record updated.');
    }
}
