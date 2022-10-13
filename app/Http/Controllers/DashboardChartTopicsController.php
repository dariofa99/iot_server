<?php

namespace App\Http\Controllers;

use App\Models\Dashboard as MyDash;
use App\Models\DashboardChart;
use App\Models\DashboardChartTopic;
use App\Services\DashboardService;
use Illuminate\Http\Request;


class DashboardChartTopicsController extends Controller
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
       
        return response()->json(["error"=>"Value is not numeric"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    public function syncTopic(Request $request)
    {
        if($request->sync=="insert"){
            $dashboard_topic = DashboardChartTopic::create($request->all());
        }elseif($request->sync=="delete"){
            $dashboard_topic = DashboardChartTopic::find($request->id);
            $dashboard_topic->delete();
        }elseif($request->sync=="update"){
            $dashboard_topic = DashboardChartTopic::find($request->id);
            $dashboard_topic->fill($request->except(['sync']));
            $dashboard_topic->save();
        }
       

        return response()->json($dashboard_topic, 200);
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
        $dashboard = DashboardChart::find($id);
        $dashboard->fill($request->all());
        $dashboard->save();
        return response()->json($request->all(),200);
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

   

    
}
