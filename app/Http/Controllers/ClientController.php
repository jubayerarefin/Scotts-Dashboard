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
        try {
            if ($request->ajax()) {
                $from_date      = $request->get('from_date');
                $to_date        = $request->get('to_date');
                $subscribed_box = $request->get('subscribed_box');
                if (($from_date != null && $to_date != null)) {
                    if ($subscribed_box) {
                        $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') >= '" . $from_date . "'  AND  DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') <= '" . $to_date . "'  ");
                    } else {
                        $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') >= '" . $from_date . "' AND o.SubscribedUntil IS NOT NULL AND DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') <= '" . $to_date . "'");
                    }
                } else {
                    $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId ORDER BY u.UserId ASC");
                }
                return Datatables::of($data)->make(true);
            }
            return view('client.index');
        } catch (\Exception $e) {
            \Log::error($e); // create a log for error occurrence at storage/log/laravel.log file
            return response()->json($e->getData(), $e->getStatusCode());
        }
    }
}
//
//else {
//     $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
//     FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') >= '" . $from_date . "' AND o.SubscribedUntil IS NOT NULL AND DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') <= '" . $to_date . "'");
//     }
// //
//
//
//
//
//
//
//
//
//
//
// if ($Email != "" && $from_date === "" && $to_date === "") {
//     $data .= " WHERE u.Email = '$Email' ORDER BY UserId ASC ";
// }

// if ($Email === "" && $from_date != "" && $to_date != "") {
//     $data .= " WHERE o.CreatedAt >= '$from_date' AND o.CreatedAt <= '$to_date' ";
// }

// if ($Email != "" && $from_date != "" && $to_date != "") {
//     $data .= " WHERE u.Email = '$Email' AND o.CreatedAt >= '$from_date' AND o.CreatedAt <= '$to_date' ";
// }

////     $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%m-%d-%Y' ) AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%m-%d-%Y') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%m-%d-%Y') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%m-%d-%Y' ) AS SubscribedUntil
// FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId")
//         ->whereDate('o.CreatedAt', '>=', $from_date)->whereDate('o.CreatedAt', '<=', $to_date);

// SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, o.LastJournalUpdateTimeUTC AS LastJournalUpdateTime, o.LastJournalUpdateTimeUTC AS LastJournalUpdateDate, u.CreatedAt AS CreatedAtUser, o.CreatedAt AS CreatedAtOrganization, o.SubscribedUntil AS SubscribedUntil FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE o.CreatedAt >= 05-01-2020 AND o.CreatedAt <= 06-01-2020


// } if (($from_date != null && $to_date != null) && $subscribedBox == false) {
