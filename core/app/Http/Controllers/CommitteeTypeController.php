<?php

namespace App\Http\Controllers;

use App\Models\CommitteeType;
use App\Models\WebmasterSection;
use Illuminate\Http\Request;

class CommitteeTypeController extends Controller
{
    public function index(){
        $data['committeeTypes'] = CommitteeType::get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.committee_type.index', $data);
    }
    public function store(Request $request){
        $request->validate([
            'name'=> 'required|string|max:30',
        ]);
        CommitteeType::create([
            'name' => $request->name,
            'is_active' => true
        ]);
        return back()->with('doneMessage', __('backend.addDone'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=> 'required|string|max:30',
            'status' => 'required'
        ]);
        $findCommitteeType = CommitteeType::find($id);
        $findCommitteeType->update([
            'name' => $request->name,
            'is_active' => $request->status
        ]);
        return back()->with('doneMessage', __('backend.saveDone'));
    }
    public function destroy($id){
        $findCommitteeType = CommitteeType::find($id);
        $findCommitteeType->delete();
        return back()->with('doneMessage', __('backend.deleteDone'));

    }
}
