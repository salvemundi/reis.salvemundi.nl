<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Roles;


class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstName')->nullable();;
            $table->string('insertion')->nullable();
            $table->string('lastName')->nullable();;
            $table->date('birthday')->nullable();
            $table->string('email')->unique();
            $table->string('phoneNumber')->nullable();
            $table->string('medicalIssues')->nullable();
            $table->string('specials')->nullable();
            $table->boolean('checkedIn')->default(0);
            $table->tinyInteger('role')->unsigned()->default(Roles::participant);
            $table->softDeletes();
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
        Schema::dropIfExists('participants');
    }
}
