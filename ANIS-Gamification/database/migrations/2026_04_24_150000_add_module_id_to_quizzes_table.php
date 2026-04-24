<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('module_id')
                ->nullable()
                ->after('id')
                ->constrained('modules')
                ->nullOnDelete();

            $table->unique('module_id');
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropUnique(['module_id']);
            $table->dropConstrainedForeignId('module_id');
        });
    }
};
