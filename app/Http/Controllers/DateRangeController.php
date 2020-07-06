<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DateRangeController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::connection('mysql2')::table('user')
                    ->whereBetween('order_date', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::connection('mysql2')::table('user')
                    ->get();
            }
            return datatables()->of($data)->make(true);
        }
        return view('daterange');
    }
}