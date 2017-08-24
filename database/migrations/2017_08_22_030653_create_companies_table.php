<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->char('RUC',13)->unique();
            $table->string('legalName');
            $table->string('address');

            $table->char('type',1)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('website')->nullable();

            $table->timestamps();
        });

        Schema::table('machines', function (Blueprint $table) {
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });

        Schema::table('contracts', function(Blueprint $table){
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                ->references('id')
                ->on('companies')
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

        Schema::table('contracts',function(Blueprint $table){
           $table->dropForeign('contracts_customer_id_foreign');
        });

        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign('machines_provider_id_foreign');

        });
        Schema::dropIfExists('companies');
    }
}
