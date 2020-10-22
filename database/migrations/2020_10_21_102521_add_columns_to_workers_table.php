<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->integer('public_flag')->default(0);
            $table->string('nickname');
            $table->integer('price_lunch')->nullable();
            $table->integer('price_dinner')->nullable();
            $table->decimal('amature_career', 4, 1)->nullable();
            $table->decimal('pro_career', 4, 1)->nullable();
            $table->string('portrait_filename')->nullable();
            $table->string('comment',2047)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn('public_flag');
            $table->dropColumn('nickname');
            $table->dropColumn('price_lunch');
            $table->dropColumn('price_dinner');
            $table->dropColumn('amature_career', 4, 1);
            $table->dropColumn('pro_career', 4, 1);
            $table->dropColumn('portrait_filename');
            $table->dropColumn('comment',2047);
        });
    }
}
