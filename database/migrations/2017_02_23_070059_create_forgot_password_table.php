<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForgotPasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('forgot_password'))
        {
            Schema::create('forgot_password', function(Blueprint $table)
            {
                $table->increments('id')->comment('Generating primary key');
                
                $table->bigInteger('users_id')->unsigned();
                // $table->index('users_id');
                // $table->foreign('users_id')
                //     ->references('id')->on('users')
                //     ->onDelete('cascade');

                $table->string('forgot_token');
                $table->enum('users_type', ['1', '2', '3'])->default('1')->comment('1=>front-user, 2=> admin-user, 3=>unknown');
                $table->enum('is_active', ['1', '2'])->default('1')->comment('1=>active, 2=>deactive');

                $table->timestamps();
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
        if(Schema::hasTable('forgot_password'))
        {
            Schema::drop('forgot_password');
        }
    }
}
