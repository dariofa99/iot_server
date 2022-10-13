<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table("users")
        ->insert(
            [
                "name"=>"MGTIC",
                "email"=>"mgtic@gmail.com",
                "password"=>bcrypt("admin")

                    ]);
                  

        DB::table("charts")
        ->insert(["chart_type"=>"line"]);
        DB::table("charts")
        ->insert(["chart_type"=>"bar"]);
        DB::table("charts")
        ->insert(["chart_type"=>"gauge"]);
       

        DB::table("dashboards")
        ->insert(["dashboard_name"=>"My first dashboard","user_id"=>1]);

        DB::table("dashboard_charts")
        ->insert(["cols"=>"6","dashboard_id"=>"1","chart_id"=>"1"]);

        DB::table("topics")
        ->insert(["topic_name"=>"mgtic/temperatura"]);
        DB::table("topics")
        ->insert(["topic_name"=>"mgtic/humedad"]);
        DB::table("topics")
        ->insert(["topic_name"=>"mgtic/cpu"]);

        DB::table("dashboard_chart_topics")
        ->insert(["color"=>"#000000","dashboard_chart_id"=>"1","topic_id"=>"1"]);
        DB::table("dashboard_chart_topics")
        ->insert(["color"=>"#000000","dashboard_chart_id"=>"1","topic_id"=>"2"]);

        DB::table("boards")
        ->insert(["board_name"=>"esp32","user_id"=>1]);
        
        DB::table("outputs_board")
        ->insert(["output_name"=>"Led-2",'gpio'=>2,'status'=>0,'board_id'=>1]);

    }
}
