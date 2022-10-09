<?php

namespace App\Http\Controllers;

use App\Models\Dashboard as MyDash;
use App\Models\Chart;
use App\Services\DashboardService;
use Illuminate\Http\Request;


class ChartsController extends Controller
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


        $charts = Chart::orderBy('created_at', 'asc')->get();


        return response()->json($charts);
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
        
        return response()->json([],200);
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
       
        return response()->json([], 200);
    }
}
