<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommitteeRequest;
use App\Models\Committee;
use App\Models\CommitteeType;
use App\Models\WebmasterSection;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PDF;

class CommitteeController extends Controller
{
    public function index($committeeTypeId)
    {
        $data['committees'] = Committee::where('committee_type_id', $committeeTypeId)->orderBy('serial', 'asc')->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['type'] = CommitteeType::find($committeeTypeId);
        return view('dashboard.committee.index', $data);
    }
    public function create()
    {
        $data['committeeTypes'] = CommitteeType::where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.committee.create', $data);
    }
    public function store(CommitteeRequest $request)
    {

        Committee::create([
            'committee_type_id' => $request->committee_type,
            'name' => $request->name,
            'title' => $request->title,
            'phone' => $request->phone,
            'address' => $request->address,
            'serial' => $request->serial,
            'is_active' => true
        ]);
        return back()->with('doneMessage', __('backend.addDone'));
    }
    public function edit($id)
    {

        $data['committee'] = Committee::find($id);
        $data['committeeTypes'] = CommitteeType::where('is_active', true)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.committee.edit', $data);
    }
    public function update(CommitteeRequest $request, $id)
    {

        $findCommittee = Committee::find($id);
        $findCommittee->update([
            'committee_type_id' => $request->committee_type,
            'name' => $request->name,
            'title' => $request->title,
            'phone' => $request->phone,
            'address' => $request->address,
            'serial' => $request->serial,
        ]);
        return back()->with('doneMessage', __('backend.saveDone'));
    }
    public function destroy($id)
    {
        $findCommittee = Committee::find($id);
        $findCommittee->delete();
        return back()->with('doneMessage', __('backend.deleteDone'));
    }
    public function status(Request $request, $id)
    {
        $committee = Committee::find($id);
        $isActive = 0;
        if ($request->status == 1) {
            $isActive = 1;
        }
        $committee->update([
            'is_active' => $isActive,
        ]);
        return back()->with('doneMessage', 'Status is updated successfully!');
    }
    // public function generatePDF($committeeTypeId){
    //      $committees = Committee::where('is_active', true)->where('committee_type_id', $committeeTypeId)->get();
    //      $type = CommitteeType::find($committeeTypeId);
    //      $dompdf = new Dompdf();
    //      $html = view('dashboard.committee.pdf',compact('committees','type'));
    //      $dompdf->loadHtml($html);
    //      $dompdf->setPaper('A4', 'portrait');
    //      $dompdf->render();
    //      return $dompdf->stream('document.pdf');
    // }
    public function generateMPDF($committeeTypeId)
    {
        // Initialize Dompdf
        $committees = Committee::where('is_active', true)->where('committee_type_id', $committeeTypeId)->get();
        //  dd($committees);
        $type = CommitteeType::find($committeeTypeId);
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'nikosh'
        ]);

        // Load HTML content
        $html = view('dashboard.committee.pdf', compact('committees', 'type'));
        $mpdf->WriteHTML($html);
        return $mpdf->Output();
    }
}
