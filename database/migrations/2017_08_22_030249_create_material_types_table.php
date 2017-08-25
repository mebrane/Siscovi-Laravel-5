<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('materials',function(Blueprint $table){
           $table->integer('type_id')->unsigned();
           $table->foreign('type_id')
               ->references('id')
               ->on('material_types')
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
        Schema::table('materials',function (Blueprint $table){
            $table->dropForeign('materials_type_id_foreign');
        });

        Schema::dropIfExists('material_types');
    }
}
