<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlanosSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $planos = [
            [
                'nome' => 'Free',
                'mensalidade' => 0.00,
                'created_at' => date('Y-m-d h:i:s'),
            ],
            [
                'nome' => 'Basic',
                'mensalidade' => 100.00,
                'created_at' => date('Y-m-d h:i:s'),
            ],
            [
                'nome' => 'Plus',
                'mensalidade' => 187.00,
                'created_at' => date('Y-m-d h:i:s'),
            ],
        ];
        DB::table('planos')->insert($planos);
    }
}
