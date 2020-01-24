<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //fixing a sqlite bug ->nullable()
      Schema::table('contacts', function (Blueprint $table) {
          $table->unsignedBigInteger('company_id')->nullable();
          $table->foreign('company_id')
                    ->references('id')->on('companies');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('contacts', function (Blueprint $table) {
        $table->dropForeign('contacts_company_id_foreign');
        $table->dropColumn('company_id');
      });
    }
}
