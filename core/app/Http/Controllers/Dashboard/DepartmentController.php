<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $data['departments'] = DepartmentRepository::query()->orderBy('serial', 'asc')->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.department.index',$data);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'serial' =>'nullable'
        ]);
        DepartmentRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Department is Created Successfully!');

    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:30',
            'serial' =>'nullable'
        ]);
        DepartmentRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Department is Updated Successfully!');

    }
    public function destroy($id){
        $department = DepartmentRepository::find($id);
        $department->delete();
        return back()->with('doneMessage', 'Department is Deleted Successfully!');
    }
}
