<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class ResultRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        //return User::class;
    }

    public static function storeByRequest(Request $request)
    {
       self::create([
            //
       ]);
    }
}
