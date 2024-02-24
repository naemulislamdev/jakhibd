<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        $data['subjects'] = SubjectRepository::query()->orderBy('serial', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.subject.index',$data);

    }
    public function store(SubjectRequest $request){

        SubjectRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Subject is Created Successfully!');

    }
    public function update(SubjectRequest $request, $id){

        SubjectRepository::updateByRequest($request, $id);
        return back()->with('doneMessage', 'Subject is Updated Successfully!');

    }
    public function destroy($id){
        $subject = SubjectRepository::find($id);
        $subject->delete();
        return back()->with('doneMessage', 'Subject is Deleted Successfully!');
    }
}
