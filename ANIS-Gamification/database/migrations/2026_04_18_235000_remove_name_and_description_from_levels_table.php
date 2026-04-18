<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('levels')) {
            Schema::table('levels', function (Blueprint $table) {
                if (Schema::hasColumn('levels', 'name')) {
                    $table->dropColumn('name');
                }
                if (Schema::hasColumn('levels', 'description')) {
                    $table->dropColumn('description');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('levels')) {
            Schema::table('levels', function (Blueprint $table) {
                if (! Schema::hasColumn('levels', 'name')) {
                    $table->string('name')->after('id');
                }
                if (! Schema::hasColumn('levels', 'description')) {
                    $table->text('description')->nullable()->after('name');
                }
            });
        }
    }
};
