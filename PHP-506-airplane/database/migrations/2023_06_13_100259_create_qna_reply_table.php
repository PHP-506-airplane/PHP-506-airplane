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
        Schema::create('qna_reply', function (Blueprint $table) {
            $table->id('reply_no');
            $table->string('reply_content', 1000);
            $table->timestamps();
            $table->softDeletes();
            // TODO : qna_info 테이블 qna_no PK & FK 추가
            // TODO : admin_info 테이블 adm_no FK 추가
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qna_reply');
    }
};
