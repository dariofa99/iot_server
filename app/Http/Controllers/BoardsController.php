<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Dashboard as MyDash;
use App\Models\OutputBoard;
use \Facades\App\Facades\Mqtt;
use App\Models\Topic;
use \Facades\App\Facades\NewPush;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardsController extends Controller
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


        $topics = Board::orderBy('created_at', 'asc')->get();


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
    public function show($id)
    {
        $board = Board::with('outputs')->find($id);

        return response()->json($board,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function syncOutput(Request $request, $id)
    {
        //return response()->json($request->all(),200);
       $board = OutputBoard::find($id);
       $board->status = $request->status;
       $board->save();
       return response()->json($board,200);
    }

    public function getOutput($id)
    {
        //return response()->json($request->all(),200);
       $response = [];
       $board = Board::find($id);
       foreach ($board->outputs as $key => $out) {
        $response[$out->gpio] = strval($out->status);
       }
       return response()->json($response,200);    
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
