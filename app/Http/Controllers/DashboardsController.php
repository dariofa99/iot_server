<?php

namespace App\Http\Controllers;

use App\Models\Dashboard as MyDash;
use App\Models\Dashboard;
use \Facades\App\Facades\Mqtt;
use App\Models\Topic;
use \Facades\App\Facades\NewPush;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{

    private $dashboardService;
    public function __construct(DashboardService $dashboardService)
  {
    $this->dashboardService = $dashboardService;
    
  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $topics = MyDash::orderBy('created_at', 'asc')->get();


        return response()->json($topics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['token'] = \Str::random(20);
        $request['user_id'] = 1;
        $dashboard = Dashboard::create($request->all());
        return response()->json($dashboard,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dashboard = $this->dashboardService->getData($id);
        return response()->json($dashboard,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return response()->json("mqtt");
    }

    public function destroyAll()
    {
        $topics = DB::table('topics')->delete();
        NewPush::channel("MyChannelDelete")
            ->message(["response" => Topic::orderBy('created_at', 'desc')->get()])
            ->publish();
        return response()->json($topics, 200);
    }
}
