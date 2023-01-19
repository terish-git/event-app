<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PublicEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEvents(Request $request)
    {
        try {
            $events = Event::with('owner')->orderBy('id', 'DESC')->paginate(5);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return view('public.event', compact('events'));
    }
    
    /**
     * Return filtered resource with paginated data
     *
     */
    function fetch_data(Request $request) 
    {
        if ($request->ajax()) {

            $search     = str_replace(" ", "%", $request->get('query'));
            $query      = Event::select('events.*');
                        if($request->get('query') != '') {
                            $query = $query->where('name', 'like', '%'.$search.'%')
                                    ->orWhereHas('owner', function($q) use ($search){
                                        $q->where('first_name', 'like', '%'.$search.'%');                                
                                    });
                        }
                        if(($request->get('start_date') != '' ) && ($request->get('end_date') != '') ) {
                            $query =  $query
                                    ->whereDate('start_date', '>=', $request->get('start_date'))
                                    ->whereDate('end_date', '<=', $request->get('end_date'));
                        }
            $events     = $query->paginate(5);
            return view('public.event-pagination-data', compact('events'))->render();
        }
    }

    /**
     * Return Event statistic reports
     *
     */
    function eventReport(Request $request) 
    {
        // $events = DB::table('users')
        //         ->selectRaw('sub_tt.id,AVG(sub_tt.user_event_count) as average_user_event_count')
        //         ->leftjoin('events', 'events.created_by', 'users.id')
        //         ->groupBy('users.id', 'first_name')
        //         ->get();

        //         // SELECT
        //         // sub_tt.id,
        //         // AVG(sub_tt.  ) as average_user_event_count
        //         // FROM ( SELECT users.id,
        //         // (SELECT count(*) FROM `events` WHERE created_by = users.id) as user_event_count
        //         // FROM users LEFT JOIN events ON users.id = events.created_by
        //         // GROUP BY users.id ORDER BY users.id) as sub_tt
        //         // GROUP BY sub_tt.id

        //     echo "<pre>"; print_r($events); exit;
        try {
            $users = User::all();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return view('public.event-report', compact('users'));
    }
}
