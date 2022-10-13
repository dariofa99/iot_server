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
        Schema::create('outputs_board', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string("output_name");
            $table->string("gpio");
            $table->boolean("status")->default(0);
            $table->foreignId('board_id')
            ->constrained('boards')
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
        Schema::dropIfExists('outputs_board');
    }
};
