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
            $table->bigInteger('adm_no');
            $table->bigInteger('qna_no');
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
