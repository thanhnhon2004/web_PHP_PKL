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
        Schema::table('orders', function (Blueprint $table) {
            // Thêm cột thanh toán nếu chưa tồn tại
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending')->after('status');
            }
            
            if (!Schema::hasColumn('orders', 'transaction_no')) {
                $table->string('transaction_no')->nullable()->after('payment_status');
            }
            
            if (!Schema::hasColumn('orders', 'transaction_date')) {
                $table->string('transaction_date')->nullable()->after('transaction_no');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
            
            if (Schema::hasColumn('orders', 'transaction_no')) {
                $table->dropColumn('transaction_no');
            }
            
            if (Schema::hasColumn('orders', 'transaction_date')) {
                $table->dropColumn('transaction_date');
            }
        });
    }
};
