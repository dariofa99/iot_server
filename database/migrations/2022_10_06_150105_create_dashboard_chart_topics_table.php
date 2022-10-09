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
        Schema::create('dashboard_chart_topics', function (Blueprint $table) {
            $table->id();
            $table->string("color");
            $table->foreignId('dashboard_chart_id')
            ->constrained('dashboard_charts')
            ->onUpdate('cascade')
            ->onDelete('cascade'); 
            $table->foreignId('topic_id')
            ->constrained('topics')
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
        Schema::dropIfExists('dashboard_chart_topics');
    }
};
