<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use App\Repositories\SubDepartmentRepository;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    public function index(){
        $data['subDepartments'] = SubDepartmentRepository::query()->orderBy('serial', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.sub_department.index',$data);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'department_id' => 'required',
            'serial' =>'nullable'
        ]);
        SubDepartmentRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Sub Department is Created Successfully!');

    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:30',
            'department_id' => 'required',
            'serial' =>'nullable'
        ]);
        SubDepartmentRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Sub Department is Updated Successfully!');

    }
    public function destroy($id){
        $department = SubDepartmentRepository::find($id);
        $department->delete();
        return back()->with('doneMessage', 'Sub Department is Deleted Successfully!');
    }
}
