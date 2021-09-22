<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name'=>'agus',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'budi',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'deni',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'riko',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ])->each(fn($student)=>DB::table('students')->insert($student)); 
    }
}
