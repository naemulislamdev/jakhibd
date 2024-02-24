<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Department::class;
    }

    public static function storeByRequest(Request $request)
    {
       self::create([
            'name' => $request->name,
            'serial' => $request->serial,
            'is_active' => true
       ]);
    }
    public static function updateByRequest(Request $request, $id)
    {
        $department = self::query()->where('id', $id)->first();
        $department->update([
            'name' => $request->name,
            'serial' => $request->serial,
            'is_active' => $request->status
       ]);
    }
}
