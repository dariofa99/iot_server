<?php

namespace App\Http\Controllers;

use App\Models\Dashboard as MyDash;
use App\Models\DashboardChart;
use App\Models\DashboardChartTopic;
use App\Services\DashboardService;
use Illuminate\Http\Request;


class DashboardChartsController extends Controller
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
      // return response()->json($request->all());
        $dasChart = DashboardChart::create($request->all());   
        if($request->has('topic_id')){
            foreach ($request->topic_id as $key => $topic) {
                $dashboard_topic = DashboardChartTopic::create([
                    "color"=>$request->topic_color[$key],
                    "topic_id"=>$topic,
                    "dashboard_chart_id"=>$dasChart->id
                ]);
            }
        }
      
        return response()->json($dasChart);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dashboard = DashboardChart::with('chart_topics.topic','chart')->find($id);
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
        $dasChart = DashboardChart::find($id);
        $dasChart->delete();
        return response()->json($dasChart);
    }

    public function destroyAll()
    {
       
        return response()->json([], 200);
    }

    
}
