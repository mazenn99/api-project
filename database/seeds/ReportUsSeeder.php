<?php

use Illuminate\Database\Seeder;

class ReportUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Report_us::class , 50)->create();
    }
}
