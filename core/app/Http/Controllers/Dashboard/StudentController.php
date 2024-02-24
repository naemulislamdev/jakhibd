<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubDepartmentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $data['students'] = StudentRepository::getAll();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.index',$data);
    }
    public function create(){
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.create',$data);
    }
    public function store(StudentRequest $request){
        StudentRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Student is created successfully!');
    }
    public function show($id){
        $data['student'] = StudentRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.students.show',$data);

    }
    public function edit($id){
        $data['student'] = StudentRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        return view('dashboard.students.edit',$data);

    }
    public function update(StudentRequest $request, $id){
        StudentRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Student is updated successfully!');
    }
    public function destroy($id){
        $student = StudentRepository::find($id);
        $student->delete();
        return back()->with('doneMessage', 'Student is deleted successfully!');
    }
    public function getSubDepartment($id){
        // dd($id);
        $html = '';
        $subDepartments = SubDepartmentRepository::query()->where('department_id', $id)->where('is_active', true)->get();
        foreach($subDepartments as $subDepartment){
            $html .= '<option value='."$subDepartment->id".'>'.$subDepartment->name.'</option>';
        }
        return $html;
        // return response()->json(['success' => true]);
    }
    public function status(Request $request, $id){
        $student = StudentRepository::find($id);
        $isActive = 0;
        if($request->status == 1){
            $isActive = 1;
        }
        $student->update([
            'is_active' => $isActive,
        ]);
        return back()->with('doneMessage', 'Status is updated successfully!');
    }

}
