<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'descricao' => 'Tomar Banho',
            'status' => 0,
            'user_id' => 1,
            'data_criacao' => now(),
            'data_execucao' => now()
        ]);

        DB::table('tasks')->insert([
            'descricao' => 'Lavar o carro',
            'status' => 1,
            'user_id' => 1,
            'data_criacao' => now(),
            'data_execucao' => now()
        ]);
    }
}
