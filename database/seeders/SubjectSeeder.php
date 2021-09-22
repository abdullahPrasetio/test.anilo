<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
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
                'name'=>'Algoritma',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Pemrograman Dasar',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Basis data',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Matematika dasar',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Teknik Digital',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ])->each(fn($subject)=>DB::table('subjects')->insert($subject)); 
    }
}
