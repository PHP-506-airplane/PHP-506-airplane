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
            $table->string('qna_content', 50);
            $table->timestamps();
            $table->softDeletes();
            // TODO : user_onfo 테이블 u_no FK 추가
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
