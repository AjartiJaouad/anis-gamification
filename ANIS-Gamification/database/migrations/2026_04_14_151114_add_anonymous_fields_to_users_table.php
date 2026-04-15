<?php

use Illuminate\Database\Migrations\Migration;

// This migration is intentionally empty.
// A previous version tried to renameColumn('pseudo', 'pseudonym') and add is_anonymous,
// but both columns are already correctly defined in the base create_users_table migration.
// Running this would cause: duplicate column 'is_anonymous' + column 'pseudo' rename conflict.
return new class extends Migration
{
    public function up(): void {}
    public function down(): void {}
};
