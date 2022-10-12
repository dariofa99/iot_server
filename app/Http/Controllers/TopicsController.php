<?php

namespace App\Http\Controllers;

use \Facades\App\Facades\Mqtt;
use App\Models\Topic;
use \Facades\App\Facades\NewPush;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;
use App\Models\DashboardChartTopic;
use App\Models\TopicValue;
use App\Services\DashboardService;
use Illuminate\Database\Eloquent\Builder;

class TopicsController extends Controller
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


        $topics = Topic::orderBy('created_at', 'asc')->get();


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
 //
        $date =  date('Y-m-d H:i:s');
        $dashboard = Dashboard::where('token', request()->token)->first();
        if ($dashboard) {
            $dashboard_topics = DashboardChartTopic::with('topic')
                ->whereHas('dashboard_chart', function (Builder $query) use ($dashboard) {
                    $query->where('dashboard_id', $dashboard->id);
                })
                ->orderBy('created_at', 'asc')                
               ->get();
              foreach ($dashboard_topics as $key => $dashboard_t) {                
                if ($request[$dashboard_t->topic->topic_name]) {                   
                    $topic = TopicValue::create([
                        'dashboard_chart_topic_id' => $dashboard_t->id,
                        'value' => intval($request[$dashboard_t->topic->topic_name]),
                        'date' => $date
                    ]);
                    Mqtt::topic($dashboard_t->topic->topic_name)->message([
                        "topic" => $dashboard_t->topic->topic_name,
                        "date" => $date,
                        "value" => $topic->value
                    ])->publish();
                }
            }

            $dashboard = $this->dashboardService->getData($dashboard->id);

         

            if(NewPush::isRedisReady()){
                NewPush::channel("MyChannel")
                ->message(["response" => $dashboard])
                ->publish();
            }
           
            return response()->json($dashboard, 200);
        }







        /* 
        if(is_array($request->topic_name)){
            if(is_array($request->value)){
                foreach ($request->topic_name as $key => $topic) {
                    $topic = Topic::create([
                        'topic_name'=>$topic,
                        'value'=>$request->value[$key],
                        "date" => $date
                    ]);
                    Mqtt::topic($request->topic_name)->message([
                        "topic" => $topic,
                        "date" => $date,
                        "value" => $request->value[$key]
                    ])->publish();
                }
                NewPush::channel("MyChannel")
                ->message([
                    "response" => Topic::orderBy('created_at', 'desc')->get(),
                    "topic" => $topic])
                ->publish();
                return response()->json($topic);
            }else{
                return response()->json(["error"=>"Value is not array"]);
            }
        }else{
            if (!is_array($request->value) and !is_array($request->topic_name) and $request->value != "nan" and $request->value != "") {
                $request["value"] = intval($request->value);
                $topic = Topic::create($request->all());
                Mqtt::topic($request->topic_name)->message([
                    "topic" => $request->topic_name,
                    "date" => $date,
                    "value" => $request->value
                ])->publish();
                NewPush::channel("MyChannel")
                    ->message([
                        "response" => Topic::orderBy('created_at', 'desc')->get(),
                        "topic" => $topic])
                    ->publish();
                return response()->json($topic);
            }else{
                return response()->json(["error"=>"Topic name or Value is not array"]);
            }
        } */


        return response()->json(["error" => "Value is not numeric"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function subscribe()
    {
        //return response()->json("hrlep", 200);
       /*  DashboardChartTopic::create([
            'color'=>"#ksjdjdj",
            'dashboard_chart_id'=>9,'topic_id'=>2
        ]); */
        $topics = Mqtt::subscribe(function($topic){
            echo "Hola".$topic;
            DashboardChartTopic::create([
                'color'=>"#ksjdjdj",
                'dashboard_chart_id'=>9,'topic_id'=>2
            ]);
        });
        
        /* $topics->mqtt->subscribe("mgtic/luz", function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 0);
        $this->mqtt->loop(true); */

        return response()->json($topics, 200);
    }

    public function topic($pin,$status)
    {

        return response()->json([$pin => $status]);
    }

    public function topic($pin,$status)
    {
        
        return response()->json([$pin => $status]);
    }
}
