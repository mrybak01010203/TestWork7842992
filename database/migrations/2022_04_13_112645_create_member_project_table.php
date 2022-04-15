<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_projects', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('member_id');
             $table->unsignedBigInteger('project_id');
             $table->foreign('member_id')->references('id')->on('members')
                    ->onDelete('cascade');
             $table->foreign('project_id')->references('id')->on('projects')
                    ->onDelete('cascade');
             $table->date('datestart');
             $table->string('role',100);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_projects');
    }
}
