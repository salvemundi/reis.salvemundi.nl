<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->double('price',8,2)->default(0);
            $table->timestamps();
        });

        Schema::create('activity_participant', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('participant_id')->index();
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->uuid('activity_id')->index();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
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
        Schema::dropIfExists('activities');
        Schema::dropIfExists('activity_participant');
    }
};
