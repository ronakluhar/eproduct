<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin'))
        {
            Schema::create('admin', function(Blueprint $table)
            {
                $table->bigIncrements('id')->comment('Generating primary key');
                $table->string('first_name', 100)->nullable();
                $table->string('last_name', 100)->nullable();
                $table->enum('gender', ['1','2','3'])->default('1')->comment('1 => male,2 => female,3 => others');
                $table->string('email')->unique();
                $table->string('password', 60)->nullable();
                $table->string('phone', 30)->nullable()->unique();
                $table->rememberToken();
                $table->timestamps();
                $table->enum('deleted',['1','2','3'])->default('1')->comment('1=>active, 2=>inactive, 3=>deleted');
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
        if(Schema::hasTable('admin'))
        {
            Schema::drop('admin');
        }
    }
}
