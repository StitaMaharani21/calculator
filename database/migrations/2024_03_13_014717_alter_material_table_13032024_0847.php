<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMaterialTable130320240847 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //ini kalau mislanya mau set dua kolom unik
    //bisa input partnum A name A atau Partnum A name B
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->unique(['partnum'], 'materials_1_unique');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropUnique('materials_1_unique');
        });
    }
}
