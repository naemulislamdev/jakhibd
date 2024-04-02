<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\badriRegisterRequest;
use App\Models\BadriRegister;
use App\Models\LifeMember;
use App\Models\Topic;
use App\Models\WebmasterSection;
use App\Repositories\BadriRegisterRepository;
use Illuminate\Http\Request;

class LifeMemberController extends Controller
{
    public function lifeMemberIndex(){
        $lifeMembers = LifeMember::all();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.lifemember.lifemember',compact('lifeMembers','GeneralWebmasterSections'));

    }
    public function lifeMemberShow($id){
        $lifeMember = LifeMember::find($id);
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.lifemember.show',compact('lifeMember','GeneralWebmasterSections'));
    }
    public function lifeMemberDestroy($id){
        $lifeMember = LifeMember::find($id);
        $lifeMember->delete();
        return back()->with('doneMessage', __('backend.deleteDone'));
    }
    // badri register function bellow
    public function badriRegisterIndex($id){
        $badriRegisters = BadriRegister::where('badri_type_id', $id)->get();
        $badritype = Topic::where('id', $id)->first();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.badri.index',compact('badriRegisters','GeneralWebmasterSections','badritype'));
    }
    public function badriCreate(){
        $badriRegisterTypes = Topic::where('webmaster_id',12)->where('status',1)->get();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.badri.create',compact('badriRegisterTypes','GeneralWebmasterSections'));
    }
    public function badriStore(badriRegisterRequest $request){
        BadriRegisterRepository::storeByRequest($request);
        return back()->with('doneMessage', 'Badri Register is Created Successfully!');
    }
    public function badriRegisterEdit($id){
        $badriRegisterTypes = Topic::where('webmaster_id',12)->where('status',1)->get();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $badriRegist = BadriRegisterRepository::query()->where('id',$id)->first();
        return view('dashboard.badri.edit',compact('badriRegisterTypes','GeneralWebmasterSections','badriRegist'));
    }
    public function badriRegisterUpdate(badriRegisterRequest $request, $badriRegiste){
        BadriRegisterRepository::updateByRequest($request, $badriRegiste);
        return back()->with('doneMessage', 'Badri Register is Updated Successfully!');
    }
    public function badriRegisterDestroy($id){
        $badriRegister = BadriRegisterRepository::find($id);
        $badriRegister->delete();
        return back()->with('doneMessage', 'Badri Register is Deleted Successfully!');
    }
    public function badriRegisterStatus(Request $request, $id)
    {
        $badriRegister = BadriRegisterRepository::find($id);
        $isActive = 0;
        if ($request->status == 1) {
            $isActive = 1;
        }
        $badriRegister->update([
            'is_active' => $isActive,
        ]);
        return back()->with('doneMessage', 'Status is updated successfully!');
    }
}
