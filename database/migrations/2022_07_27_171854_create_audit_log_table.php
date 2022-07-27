<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('audit_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('description');
            $table->uuid('userId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('participantId')->nullable();
            $table->foreign('participantId')->references('id')->on('participants')->onDelete('cascade');
            $table->uuid('blogId')->nullable();
            $table->foreign('blogId')->references('id')->on('content')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_log');
    }
}
