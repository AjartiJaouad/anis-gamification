<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('streak_last_counted_on')->nullable()->after('streak_days');
            $table->date('last_daily_bonus_date')->nullable()->after('streak_last_counted_on');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['streak_last_counted_on', 'last_daily_bonus_date']);
        });
    }
};
