<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('email_templates'))
        {
            Schema::create('email_templates', function(Blueprint $table)
            {
                $table->bigIncrements('id')->comment('Generating primary key');
                $table->string('templatename', 255)->nullable();
                $table->string('templatepseudoname', 255)->nullable();
                $table->string('subject', 255)->nullable();
                $table->text('body')->nullable();
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
        Schema::drop('email_templates');
    }
}
