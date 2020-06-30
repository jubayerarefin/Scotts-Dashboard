<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
            FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId");
            // if ($Email != "" && $from_date === "" && $to_date === "") {
            //     $data .= " WHERE u.Email = '$Email' ORDER BY UserId ASC ";
            // }

            // if ($Email === "" && $from_date != "" && $to_date != "") {
            //     $data .= " WHERE o.CreatedAt >= '$from_date' AND o.CreatedAt <= '$to_date' ";
            // }

            // if ($Email != "" && $from_date != "" && $to_date != "") {
            //     $data .= " WHERE u.Email = '$Email' AND o.CreatedAt >= '$from_date' AND o.CreatedAt <= '$to_date' ";
            // }

            // $data = Client::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('client.index');

    }

}