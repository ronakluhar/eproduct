<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users'))
        {
            Schema::create('users', function(Blueprint $table)
            {
                $table->bigIncrements('id')->comment('Generating primary key');
                $table->string('first_name', 100)->nullable();
                $table->string('last_name', 100)->nullable();
                $table->enum('gender', ['1','2','3'])->default('1')->comment('1 => male,2 => female,3 => others');
                $table->string('username')->nullable();
                $table->string('email')->unique();
                $table->string('password', 60)->nullable();
                $table->string('phone', 30)->nullable()->unique();
                $table->string('verification_token')->nullable();
                $table->string('facebook_id')->nullable();;
                $table->text('facebook_token')->nullable();
                $table->string('google_id')->nullable();
                $table->text('google_token')->nullable();
                $table->string('twitter_id')->nullable();
                $table->text('twitter_token')->nullable();
                
                $table->bigInteger('profile_url')->unsigned()->nullable();
                $table->index('profile_url');
                $table->foreign('profile_url')
                        ->references('id')->on('image')
                        ->onDelete('SET NULL');
                
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
        Schema::drop('users');
    }
}
