<?php

use Illuminate\Database\Migrations\Migration;

// This migration is intentionally empty.
// The users table is fully defined in 0001_01_01_000000_create_users_table.php
// with pseudo, email, password, is_anonymous, xp_total, streak_days columns.
// A previous version of this file tried to rename a 'name' column that never existed,
// which caused a fatal migration error.
return new class extends Migration
{
    public function up(): void {}
    public function down(): void {}
};
