<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone',12);
            
            $table->integer('public_flag')->default(0);
            $table->string('nickname');
            $table->integer('price_lunch')->nullable();
            $table->integer('price_dinner')->nullable();
            $table->decimal('amature_career', 4, 1)->nullable();
            $table->decimal('pro_career', 4, 1)->nullable();
            $table->string('portrait_filename')->nullable();
            $table->string('comment',2047)->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
