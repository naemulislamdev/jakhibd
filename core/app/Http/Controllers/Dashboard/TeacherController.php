<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\WebmasterSection;
use App\Repositories\TeacherRepository;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        $data['teachers'] = TeacherRepository::getAll();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.teacher.index',$data);
    }
    public function create(){
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.teacher.create',$data);
    }
    public function store(TeacherRequest $request){
        TeacherRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Teacher is created successfully!');
    }
    public function show($id){
        $data['teacher'] = TeacherRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.teacher.show',$data);

    }
    public function edit($id){
        $data['teacher'] = TeacherRepository::find($id);
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        return view('dashboard.teacher.edit',$data);

    }
    public function update(TeacherRequest $request, $id){
        TeacherRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Teacher is updated successfully!');
    }
    public function destroy($id){
        $student = TeacherRepository::find($id);
        $student->delete();
        return back()->with('doneMessage', 'Teacher is deleted successfully!');
    }

    public function status(Request $request, $id){
        $student = TeacherRepository::find($id);
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
