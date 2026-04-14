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
    Schema::table('users', function (Blueprint $table) {

        // rename name → pseudonym
        $table->renameColumn('name', 'pseudonym');

        // email optional
        $table->string('email')->nullable()->change();

        // password optional
        $table->string('password')->nullable()->change();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
