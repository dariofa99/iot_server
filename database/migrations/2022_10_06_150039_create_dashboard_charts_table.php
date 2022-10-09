<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_charts', function (Blueprint $table) {
            $table->id();
            $table->string("cols");
            $table->foreignId('chart_id')
            ->constrained('charts')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
            $table->foreignId('dashboard_id')
            ->constrained('dashboards')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboard_charts');
    }
};
