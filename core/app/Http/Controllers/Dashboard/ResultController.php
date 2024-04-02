<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Subject;
use App\Models\Result;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use App\Repositories\ResultRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function index()
    {
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['results'] = Result::select('department_id', 'subject_id', 'exam_type')->distinct()->get();
        $data['totalStudents'] = Result::select('department_id', 'subject_id')->distinct()->count();
        return view('dashboard.result.index', $data);
    }
    public function create()
    {
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        return view('dashboard.result.create', $data);
    }
    public function getStudents($id)
    {
        $students = StudentRepository::query()->where('is_active', true)->where('department_id', $id)->orderby('roll', 'asc')->get();
        $html = '';
        foreach ($students as $key => $student) {
            $image = 'assets/default/no-img.jpg';
            if ($student->image) {
                $image = $student->image;
            }
            $increment = $key + 1;
            $html .= '
            <tr>
            <input type="hidden" name="student_id[]" value="' . $student->id . '">
            <input type="hidden" name="roll[]" value="' . $student->roll . '">

            <td>' . $increment . '</td>
            <td>
            <img src=' . "$image" . ' style="width: 50px; height:60px;">
            </td>
            <td>' . $student->name . '</td>
            <td>' . $student->roll . '</td>
            <td><input type="number" name="mark[]" class="form-control" placeholder="Enter mark"></td>
            </tr>';
        }
        return $html;
    }
    public function getSubjects($id)
    {
        $subjects = SubjectRepository::query()->where('department_id', $id)->where('is_active', true)->get();
        $html = '<option selected disabled>বিষয় নির্বাচন করুন</option>';
        foreach ($subjects as $subject) {
            $html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
        }
        return $html;
        // return response()->json(['success' => true]);
    }
    public function store(ResultRequest $request)
    {

        if (!empty($request->student_id)) {
            $checkResult = Result::where([
                ['department_id', $request->department_id],
                ['subject_id', $request->subject_id],
                ['exam_type', $request->exam_type],
                ['year', $request->exam_year],
            ])->first();
            if ($checkResult) {
                return back()->with('errorMessage', 'This subject result already uploaded!');
            } else {
                $students = $request->student_id;
                foreach ($students as $key => $student) {
                    Result::create([
                        'department_id' => $request->department_id,
                        'subject_id' => $request->subject_id,
                        'student_id' => $student,
                        'roll' => $request->roll[$key],
                        'mark' => $request->mark[$key],
                        'exam_type' => $request->exam_type,
                        'year' => $request->exam_year,
                    ]);
                }
                return back()->with('doneMessage', 'Successfully added this result!');
            }
        } else {
            return back()->with('errorMessage', 'Student are missing!');
        }
    }
    public function edit($department, $subject, $examType)
    {
        $data['results'] = Result::where('department_id', $department)->where('subject_id', $subject)->where('exam_type', $examType)->get();
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.result.edit', $data);
    }
    public function update(ResultRequest $request)
    {
        if (!empty($request->mark)) {
            $resultIds = $request->result_id;
            foreach ($resultIds as $key => $id) {
                $result_id = Result::where('id', $id)->first();
                $result_id->update([
                    'mark' => $request->mark[$key]
                ]);
            }
            return back()->with('doneMessage', 'Successfully updated this result!');
        } else {
            return back()->with('errorMessage', 'Student are missing!');
        }
    }
    public function destroy($department, $subject, $examType)
    {
        $data['results'] = Result::where('department_id', $department)->where('subject_id', $subject)->where('exam_type', $examType)->get();
        foreach ($data['results'] as $result) {
            $data = Result::find($result->id);
            $data->delete();
        }
        return back()->with('doneMessage', 'Successfully deleted this result!');
    }
    public function studentResultSearchPage()
    {
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        $data['years'] = Result::select('year')->distinct()->get();
        $data['examTypes'] = Result::select('exam_type')->distinct()->get();
        return view('dashboard.result.search', $data);
    }
    public function studentResultSearch(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'year' => 'required',
            'exam_type' => 'required',
            'roll' => 'required',
        ]);
        $datas = Result::with('student')->where('department_id', $request->department)
            ->where('year', $request->year)
            ->where('exam_type', $request->exam_type)
            ->where('roll', $request->roll)->get();
        $total_marks = Result::with('student')->where('department_id', $request->department)
            ->where('year', $request->year)
            ->where('exam_type', $request->exam_type)
            ->where('roll', $request->roll)->sum('mark');
        // return $datas;
        // return $datas->first()->student->name;
        if ($datas->count()) {
            $data['results'] = $datas;
            $data['total_marks'] = $total_marks;
            $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
            return view('dashboard.result.search_result', $data);
        } else {
            return back()->with('errorMessage', 'Data Not Found!');
        }
    }
}
