<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CovidProof;
use App\Enums\Roles;
use App\Enums\StudentYear;

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
            $table->increments('id');
            $table->string('firstName');
            $table->string('insertion')->nullable();
            $table->string('lastName');
            $table->date('birthday');
            $table->string('email')->unique();
            $table->string('phoneNumber');
            $table->string('firstNameParent')->nullable();
            $table->string('lastNameParent')->nullable();
            $table->string('addressParent')->nullable();
            $table->string('medicalIssues')->nullable();
            $table->string('specials')->nullable();
            $table->string('phoneNumberParent')->nullable();
            $table->boolean('checkedIn');
            $table->tinyInteger('studentYear')->unsigned()->default(StudentYear::firstYear);
            $table->tinyInteger('covidTest')->unsigned()->default(CovidProof::none);
            $table->tinyInteger('role')->unsigned()->default(Roles::child);;
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
