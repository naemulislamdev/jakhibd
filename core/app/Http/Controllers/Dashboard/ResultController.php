<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WebmasterSection;
use App\Repositories\DepartmentRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function create()
    {
        $data['GeneralWebmasterSections'] = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $data['departments'] = DepartmentRepository::query()->where('is_active', true)->get();
        return view('dashboard.result.create', $data);
    }
    public function getStudents($id)
    {
        $students = StudentRepository::query()->where('is_active', true)->where('department_id', $id)->orderby('roll', 'asc')->get();
        // dd($students);
        $html = '';
        foreach ($students as $key => $student) {
            $image = 'assets/default/no-img.jpg';
            if ($student->image) {
                $image = $student->image;
            }
            $html .= '<tr>
            <td>1</td>
            <td>
            <img src=' . "$image" . ' style="width: 50px; height:60px;">
            </td>
            <td>' . $student->name . '</td>
            <td>' . $student->roll . '</td>
            <td><input type="text" name="mark[]" class="form-control" placeholder="Enter mark"></td>
            </tr>';
        }
        return $html;
    }
}
