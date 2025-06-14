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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('non_member_id')->nullable()->constrained()->nullOnDelete();
            $table->string('member_code')->nullable();
            $table->foreignId('membership_plan_id')->constrained('membership_plans')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['cash', 'card', 'online']);
            $table->timestamp('payment_date')->useCurrent();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->string('order_id');
            $table->string('payment_type');
            $table->string('transaction_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
