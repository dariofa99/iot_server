<?php
namespace App\Repositories;

use App\Models\Dashboard;
use App\Services\DashboardService;



class DashboardRepository extends BaseRepository implements DashboardService{
   
    public function __construct(Dashboard $user)
    {
        parent::__construct($user);
    }

    public function getData($id) : Array {

       $dashboard = Dashboard::with('charts.chart_topics.topic','charts.chart_topics.topic_values','charts.chart')
        ->orderBy('created_at', 'asc')
        ->where('id',$id)->first();

        return $dashboard->toArray();;
    }

}




