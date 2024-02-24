<?php

namespace App\Repositories;

use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return SubDepartment::class;
    }

    public static function storeByRequest(Request $request)
    {
       self::create([
            'name' => $request->name,
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
            'department_id' => $request->department_id,
            'serial' => $request->serial,
            'is_active' => $request->status
       ]);
    }
}
