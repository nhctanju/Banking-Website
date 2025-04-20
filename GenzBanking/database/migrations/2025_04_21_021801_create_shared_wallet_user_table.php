<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedWalletUserTable extends Migration
{
    public function up()
    
    {  if (!Schema::hasTable('shared_wallet_user')) {
            Schema::create('shared_wallet_user', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('shared_wallet_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();

                $table->foreign('shared_wallet_id')->references('id')->on('shared_wallets')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
            }    
    }

    public function down()
    {
        Schema::dropIfExists('shared_wallet_user');
    }
}
