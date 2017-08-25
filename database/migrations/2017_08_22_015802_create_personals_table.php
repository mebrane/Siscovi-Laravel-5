<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('lastName');

            $table->char('DNI',8)->unique();
            $table->date('birthDate');
            $table->date('contractDate');
            $table->decimal('salary',10,2);
            $table->char('gender',1);

            $table->string('address')->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',50)->unique()->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
}
