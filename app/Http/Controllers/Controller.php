<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Competition;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function statusUpdate(Request $request){

        if($request['table_name'] == 'competitions'){
            DB::table($request['table_name'])->update(['status'=>'inactive']);
        }

        $updateInput = DB::table($request['table_name'])->where('id', $request['id'])->first();
        $updateInput->status = ($request['type'] == 'unassign') ? 'inactive' : 'active';
        DB::table($request['table_name'])->where('id', $request['id'])->update((array) $updateInput);
    }
}
