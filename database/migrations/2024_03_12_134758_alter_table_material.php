<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterTableMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE materials MODIFY partnum VARCHAR(25)');
        DB::statement('ALTER TABLE materials MODIFY `name` VARCHAR(25)');
        DB::statement('ALTER TABLE materials MODIFY um VARCHAR(5)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE materials MODIFY partnum VARCHAR(255)');
        DB::statement('ALTER TABLE materials MODIFY `name` VARCHAR(255)');
        DB::statement('ALTER TABLE materials MODIFY um VARCHAR(255)');
    }
}
