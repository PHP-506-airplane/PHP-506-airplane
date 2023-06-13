<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id('u_no');
            $table->string('u_email', 50)->unique();
            $table->string('u_pw', 20);
            $table->char('u_gender', 1);
            $table->string('u_name', 30);
            $table->date('u_birth');
            $table->integer('qa_no');
            $table->string('qa_answer', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_info');
    }
};
