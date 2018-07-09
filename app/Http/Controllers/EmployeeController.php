<?php
namespace App\Http\Controllers;
use App\Employee;
use App\Skill;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::all();

        $n = sizeof($employees);
        
        for($i=0; $i<$n; $i++) {
            $emp_skills = $employees[$i]->skill;
            $skills = "";
            foreach ($emp_skills as $skill) {
                $skills .= trim($skill->skill).", ";
            }
            $employees[$i]->skills = ((sizeof($emp_skills)>0 ? substr($skills ,0, strlen($skills)-2) : ""));//$skills;
        }

        return view('add-employee')->with('employees', $employees);
    }

    public function saveEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:employees',
            'role' => 'required',
            'salary' => 'required|numeric',
            'skills' => 'required|string',
        ]);

        $skills = (explode(",",$request->skills));
        $skillArray = array();
        
        $n = sizeof($skills);
        
        for($i=0; $i<$n; $i++) {
            $skill = new Skill();
            if(strlen(trim($skills[$i]))>0) {
                $skill->skill = trim($skills[$i]);
                $skillArray[] = $skill;
            }
        }



        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->save();

        $employee->skill()->saveMany($skillArray);

        return back()->with('success', 'Employee added.');
    }

    public function updateEmployee($id) {
        $employees = Employee::where('id', $id)->first();

        $emp_skills = $employees->skill;
        $skills = "";
        foreach ($emp_skills as $skill) {
            $skills .= trim($skill->skill).", ";
        }
        $employees->skills = ((sizeof($emp_skills)>0 ? substr($skills ,0, strlen($skills)-2) : ""));//$skills;
        
        return view('update-employee')->with('employee', $employees);
    }

    public function saveUpdatedEmployee(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'role' => 'required',
            'salary' => 'required|numeric',
            'skills' => 'required|string',
        ]);

        $employee = Employee::find($id);//where('id', $id);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'salary' => $request->salary
        ]);;

        $skills = (explode(",", $request->skills));
        $skillArray = array();
        
        $n = sizeof($skills);
        
        for($i=0; $i<$n; $i++) {
            $skill = new Skill();
            if(strlen(trim($skills[$i]))>0) {
                $skill->skill = trim($skills[$i]);
                $skillArray[] = $skill;
            }
        }

        $employee->skill()->delete();
        $employee->skill()->saveMany($skillArray);

        return back()->with('success', 'Record updated.');
    }
}
