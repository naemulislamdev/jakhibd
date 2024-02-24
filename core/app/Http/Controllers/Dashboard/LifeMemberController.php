<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LifeMember;
use App\Models\WebmasterSection;
use Illuminate\Http\Request;

class LifeMemberController extends Controller
{
    public function lifeMemberIndex(){
        $lifeMembers = LifeMember::all();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.lifemember.lifemember',compact('lifeMembers','GeneralWebmasterSections'));

    }
    public function lifeMemberDestroy($id){
        $lifeMember = LifeMember::find($id);
        $lifeMember->delete();
        return back()->with('doneMessage', __('backend.deleteDone'));

    }
}
