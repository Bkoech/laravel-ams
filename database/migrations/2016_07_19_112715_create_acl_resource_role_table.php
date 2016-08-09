<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclResourceRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_resource_role', function (Blueprint $table) {
            $table->integer('acl_resource_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('acl_resource_id')->references('id')->on('acl_resources')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_resource_role');
    }
}
