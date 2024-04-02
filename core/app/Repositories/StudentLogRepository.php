<?php

namespace App\Repositories;

use App\Models\StudentLog;
use Illuminate\Http\Request;

class StudentLogRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return StudentLog::class;
    }

    public static function storeByRequest($student, $totalMarks)
    {
        $create = self::create([
            'student_id' => $student->id,
            'department_id' => $student->department_id,
            'roll' => $student->roll,
            'total_marks' => $totalMarks,
            'year' => $student->session_year,
            'created_at' => now(),
        ]);
        return $create;
    }
}
