<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // rename name → pseudonym
            $table->renameColumn('name', 'pseudonym');

            // email optional
            $table->string('email')->nullable()->change();

            // password optional
            $table->string('password')->nullable()->change();

            // add anonymous column
            $table->boolean('is_anonymous')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->renameColumn('pseudonym', 'name');
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();

            $table->dropColumn('is_anonymous');
        });
    }
};
