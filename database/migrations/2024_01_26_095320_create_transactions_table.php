<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->json('cart'); // Storing cart data as JSON
            $table->decimal('total', 10, 2); // Assuming total is a decimal with 10 digits and 2 decimals
            $table->decimal('discount', 10, 2); // Assuming discount is a decimal with 10 digits and 2 decimals
            $table->decimal('money_given', 10, 2); // Assuming money_given is a decimal with 10 digits and 2 decimals
            $table->decimal('change', 10, 2); // Assuming change is a decimal with 10 digits and 2 decimals
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
