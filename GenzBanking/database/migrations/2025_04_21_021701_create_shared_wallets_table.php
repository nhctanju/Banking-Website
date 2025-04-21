<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedWalletTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('shared_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shared_wallet_id');
            $table->unsignedBigInteger('user_id'); // The user who contributed or spent
            $table->decimal('amount', 16, 2);
            $table->string('type'); // e.g., 'contribution', 'expense'
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('shared_wallet_id')
                  ->references('id')
                  ->on('shared_wallets')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shared_wallet_transactions');
    }
}
