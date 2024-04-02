<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\WebmasterSection;
use App\Models\Result;
use App\Repositories\DepartmentRepository;
use App\Repositories\StudentLogRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubDepartmentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $department_id = request()->department;
        $data['students'] = StudentRepository::query()->when($department_id, function ($query) use ($department_id) {
            $query->where('department_id', $department_id)->orderBy('roll', 'asc');
        })->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.index', $data);
    }
    public function create()
    {
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.create', $data);
    }
    public function store(StudentRequest $request)
    {
        StudentRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Student is created successfully!');
    }
    public function show($id)
    {
        $data['student'] = StudentRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.show', $data);
    }
    public function edit($id)
    {
        $data['student'] = StudentRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        return view('dashboard.students.edit', $data);
    }
    public function update(StudentRequest $request, $id)
    {
        StudentRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Student is updated successfully!');
    }
    public function destroy($id)
    {
        $student = StudentRepository::find($id);
        $student->delete();
        return back()->with('doneMessage', 'Student is deleted successfully!');
    }
    public function getSubDepartment($id)
    {
        // dd($id);
        //No need this function
        $html = '';
        $subDepartments = SubDepartmentRepository::query()->where('department_id', $id)->where('is_active', true)->get();
        foreach ($subDepartments as $subDepartment) {
            $html .= '<option value=' . "$subDepartment->id" . '>' . $subDepartment->name . '</option>';
        }
        return $html;
        // return response()->json(['success' => true]);
    }
    public function status(Request $request, $id)
    {
        $student = StudentRepository::find($id);
        $isActive = 0;
        if ($request->status == 1) {
            $isActive = 1;
        }
        $student->update([
            'is_active' => $isActive,
        ]);
        return back()->with('doneMessage', 'Status is updated successfully!');
    }
    //Student promote function
    public function studentPromote()
    {
        $department_id = request()->department;
        $data['students'] = StudentRepository::query()->when($department_id, function ($query) use ($department_id) {
            $query->where('department_id', $department_id)->where('is_active', true)->orderBy('roll', 'asc');
        })->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.promote', $data);
    }
    public function studentPromoteStore(Request $request)
    {
        // return $request->all();
        if ($request->student_id) {
            $studentsId = $request->student_id;
            foreach ($studentsId as $key => $studentId) {
                // return $request->session_year[$key];
                $student = StudentRepository::find($studentId);
                $totalMarks = Result::where('department_id', $student->department_id)->where('student_id', $student->id)->sum('mark');
                StudentLogRepository::storeByRequest($student, $totalMarks);
                $student->update([
                    'roll' => $request->next_roll[$key],
                    'department_id' => $request->department_id[$key],
                    'session_year' => $request->session_year[$key]
                ]);
            }
            return back()->with('doneMessage', 'Student promoted is successfully!');
        } else {
            return back()->with('errorMessage', 'Please select students!');
        }
    }

    public function getStudentLog(Request $request)
    {
        // return $request->all();
        $data['studentLogs'] = StudentLogRepository::query()
            ->where('department_id', $request->department)
            ->where('year', $request->year)->get();
        // return $data['studentLogs'];
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['years'] = StudentLogRepository::query()->select('year')->distinct()->get();
        return view('dashboard.students.student_log', $data);
    }
    public function studentLogShow($id)
    {
        $data['studentLog'] = StudentLogRepository::find($id);
        $departmentId = $data['studentLog']->department_id;
        $studentId = $data['studentLog']->student_id;
        // return $data['studentLogs'];
        // $data['totalMarks'] = Result::where('department_id', $departmentId)->where('student_id', $studentId)->sum('mark');
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // This query also get exam types
        $data['examTypes'] = Result::where('department_id', $departmentId)->where('student_id', $studentId)->select('exam_type')->distinct()->get();
        // return $data['examTypes'];


        // $datas = Result::with('student')->where('department_id', $request->department)
        //     ->where('year', $request->year)
        //     ->where('exam_type', $request->exam_type)
        //     ->where('roll', $request->roll)->get();
        // $total_marks = Result::with('student')->where('department_id', $request->department)
        //     ->where('year', $request->year)
        //     ->where('exam_type', $request->exam_type)
        //     ->where('roll', $request->roll)->sum('mark');
        return view('dashboard.students.log_show', $data);
    }
}
