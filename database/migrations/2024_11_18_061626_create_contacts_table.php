<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 氏名
            $table->string('company')->nullable(); // 会社名（NULL 許容）
            $table->string('email'); // メールアドレス
            $table->text('message'); // 問い合わせ内容
            $table->timestamps();   
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
