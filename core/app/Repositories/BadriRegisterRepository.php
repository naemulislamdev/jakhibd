<?php

namespace App\Repositories;

use App\Http\Requests\badriRegisterRequest;
use App\Models\BadriRegister;
use Illuminate\Http\Request;

class BadriRegisterRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return BadriRegister::class;
    }

    public static function storeByRequest(Request $request)
    {
        self::create([
            'badri_type_id' => $request->badri_type_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'register_date' => $request->register_date,
            'rosit_no' => $request->rosit_no,
            'address' => $request->address,
            'is_active' => true
        ]);
    }
    public static function updateByRequest(badriRegisterRequest $request, $badriRegiste)
    {
        $badriRegiste = self::query()->where('id', $badriRegiste)->first();
        $dataUpdate = self::update($badriRegiste, [
            'badri_type_id' => $request->badri_type_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'register_date' => $request->register_date,
            'rosit_no' => $request->rosit_no,
            'address' => $request->address,
        ]);
        return $dataUpdate;
    }
}
