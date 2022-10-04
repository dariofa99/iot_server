<?php

namespace App\Http\Controllers;

use \Facades\App\Facades\Mqtt;
use App\Models\Topic;
use \Facades\App\Facades\NewPush;
use App\Models\User;
use Illuminate\Http\Request;


class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  

        $topics = Topic::orderBy('created_at','asc')->get();
     

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
        $date =  date('Y-m-d H:i:s');
        $request['date'] =  $date ;

        
        $topic = Topic::create($request->all());
        
        Mqtt::topic('mgtic/'.$request->topic_name)->message([
          "topic"=> $request->topic_name ,
          "date"=> $date ,
          "value"=>$request->value
        ])->publish();



        NewPush::channel("MyChannel")
        ->message(["response"=>Topic::orderBy('created_at','desc')->get()])
        ->publish(); 
        return response()->json($topic);
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

    
}
