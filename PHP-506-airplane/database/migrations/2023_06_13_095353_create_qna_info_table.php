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
        Schema::create('qna_info', function (Blueprint $table) {
            $table->id('qna_no');
            $table->string('qna_title', 50);
            $table->string('qna_content', 4000);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('u_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qna_info');
    }
};
