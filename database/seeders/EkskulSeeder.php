<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekskul;

class EkskulSeeder extends Seeder
{
    public function run()
    {
        $list = [
            'Sepak Bola', 'Bola Volly', 'Musik', 'Pencinta Alam (PA)', 'PMR',
            'Bola Basket', 'Pramuka', 'English Club', 'Pencak Silat', 'Teater', 'Taekwondo'
        ];

        foreach ($list as $nama) {
            Ekskul::firstOrCreate(['nama' => $nama]);
        }
    }
}
