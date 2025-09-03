<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            // Nullable foreign key to users table (member)
            $table->foreignId('member_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('reference');
            $table->string('purpose');
            $table->text('notes')->nullable();
            $table->timestamps();
            });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}