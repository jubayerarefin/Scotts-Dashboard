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
                $subscribed_box = $request->get('subscribedBox') == "true" ? true : false;

                if (($from_date != null && $to_date != null)) {
                    if($subscribed_box == true){
                        // dd('Sub_All',$subscribed_box);
                        $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%Y-%m-%d') AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%Y-%m-%d') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%Y-%m-%d' ) AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') >= '" . $from_date . "' AND SubscribedUntil IS NOT NULL AND DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') <= '" . $to_date . "'");
                    } else {
                        // dd('No_Sub',$subscribed_box);
                        $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%Y-%m-%d') AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%Y-%m-%d') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%Y-%m-%d' ) AS SubscribedUntil
                        FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') >= '" . $from_date . "' AND DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') <= '" . $to_date . "'");
                    }
                } elseif($subscribed_box == true){
                    // dd('Sub',$subscribed_box);
                    $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%Y-%m-%d') AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%Y-%m-%d') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%Y-%m-%d' ) AS SubscribedUntil
                    FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId WHERE SubscribedUntil IS NOT NULL");
                } else {
                    // dd('All',$subscribed_box);
                    $data = DB::connection('mysql2')->select("SELECT u.UserId AS UserId, u.Email AS Email, u.FirstName AS FirstName, u.LastName AS LastName, o.OrganizationName AS OrganizationName, o.ScottsOrgId AS ScottsOrgId, TIME( o.LastJournalUpdateTimeUTC ) AS LastJournalUpdateTime, DATE_FORMAT(o.LastJournalUpdateTimeUTC, '%Y-%m-%d') AS LastJournalUpdateDate, DATE_FORMAT(u.CreatedAt, '%Y-%m-%d') AS CreatedAtUser, DATE_FORMAT(o.CreatedAt, '%Y-%m-%d') AS CreatedAtOrganization, DATE_FORMAT(o.SubscribedUntil, '%Y-%m-%d' ) AS SubscribedUntil
                    FROM user AS u INNER JOIN u_o_bridge uo ON u.UserId = uo.UserId INNER JOIN organization o ON o.OrganizationId = uo.OrganizationId");
                }
                
                return Datatables::of($data)->make(true);
            }

            return view('client.index');
        } catch (\Exception $e) {
            \Log::error($e->getMessage()); // create a log for error occurrence at storage/log/laravel.log file
            return response()->json($e->getMessage());
        }
    }
}