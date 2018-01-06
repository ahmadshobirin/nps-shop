<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_kategori_produk')->insert([
            'name' => 'pulsa',
        ]);

        DB::table('m_kategori_produk')->insert([
            'name' => 'sabun',
        ]);
    }
}
