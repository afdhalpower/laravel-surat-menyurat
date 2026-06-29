<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('configs')->insert([
            ['code' => 'institution_logo', 'value' => ''],
            ['code' => 'institution_city', 'value' => 'Kota Anda'],
        ]);
    }

    public function down()
    {
        DB::table('configs')->whereIn('code', ['institution_logo', 'institution_city'])->delete();
    }
};
