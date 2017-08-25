<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('ubigeo',10)->unique();
            $table->timestamps();

            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
        });

        Schema::table('tracts',function(Blueprint $table){
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
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
        Schema::table('tracts',function(Blueprint $table){
           $table->dropForeign('tracts_district_id_foreign');
        });

        Schema::dropIfExists('districts');
    }
}
