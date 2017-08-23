<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPersonalsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
//            $table->integer('personal_id')->unsigned();
//            $table->foreign('personal_id')
//                ->references('id')
//                ->on('personals')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //current_table | foreign_index | foreign
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_personal_id_foreign');
            //$table->dropColumn('personal_id');
        });
    }
}
