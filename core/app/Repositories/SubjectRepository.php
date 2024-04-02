<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Subject::class;
    }

    public static function storeByRequest(Request $request)
    {
       self::create([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'serial' => $request->serial,
            'is_active' => true
       ]);
    }
    public static function updateByRequest(Request $request, $id)
    {
        $department = self::query()->where('id', $id)->first();
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'serial' => $request->serial,
            'is_active' => $request->status
       ]);
    }
}
