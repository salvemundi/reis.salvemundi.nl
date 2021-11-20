<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CovidProof;
use App\Enums\Roles;
use App\Enums\StudentYear;

class UpdateParticipantsTableNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function ($table) {
            $table->date('birthday')->nullable()->change();
            $table->string('phoneNumber')->nullable()->change();
            $table->boolean('checkedIn')->nullable()->change();
            $table->dropColumn('covidTest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
