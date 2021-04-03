<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientePlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planos = [];
        for($cont = 0; $cont < 18; $cont++){
            $planos[$cont] = [
                'cliente_id' => $cont+1,
                'plano_id' => 1,
                'created_at' => date('Y-m-d h:i:s'),
            ];
        };
        DB::table('cliente_plano')->insert($planos);
    }
}
