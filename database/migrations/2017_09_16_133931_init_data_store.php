<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDataStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailysummary', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_of_amount');
            $table->integer('department_id');
            $table->integer('total_amount')->default(0);
            $table->text('remark');
            $table->timestamps();
            $table->index('date_of_amount');
            $table->index('department_id');
        });

        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->char('department_code', 6);
            $table->char('department_name');
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sale_code', 6);
            $table->char('name');
            $table->timestamps();
        });

        Schema::create('sellrecord', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sell_amount');
            $table->integer('sales_id');
            $table->integer('department_id');
            $table->date('endday_at');
            $table->timestamps();
            $table->index('department_id');
            $table->index('sales_id');
            $table->index('endday_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sellrecord');
        Schema::drop('sales');
        Schema::drop('department');
        Schema::drop('dailysummary');
    }
}
