<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateRangeController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $clients = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
                FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId")
                    ->whereBetween('order_date', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $clients = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
                FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId")
                    ->get();
            }
            return datatables()->of($clients)->make(true);
        }
        return view('daterange');
    }
}