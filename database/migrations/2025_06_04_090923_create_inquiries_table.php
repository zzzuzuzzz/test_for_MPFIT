<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('count')->default(1);
            $table->text('comment')->nullable();
            $table->enum('status', ['new', 'processed', 'rejected'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
