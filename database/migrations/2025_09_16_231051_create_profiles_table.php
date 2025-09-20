<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 1.1 One to One (Bir-bir İlişkisi)
    *Bir tablodaki bir satırın başka bir tablodaki bir satıra bağlanması durumudur. Örneğin, bir kullanıcının yalnızca bir profili olabilir.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            //User_id kime ağit olduğunu gösterir.
            $table->unsignedBigInteger('user_id');
            $table->string('bio')->nullable();//Kullanıcı Hakkında kısa bilgi
            $table->string('avatar')->nullable();//profil resmi.
            $table->timestamps();
            //Kullanıcı Sİlinirse profilide Silinsin.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
