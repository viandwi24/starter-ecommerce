<?php

namespace Database\Seeders;

use App\Models\ExternalShop;
use Illuminate\Database\Seeder;

class ExternalShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExternalShop::create([
            'name' => 'Tokopedia',
            'link' => 'https://www.tokopedia.com/@tokoku',
        ]);
        ExternalShop::create([
            'name' => 'Bukalapak',
            'link' => 'https://www.bukalapak.com/@tokoku',
        ]);
        ExternalShop::create([
            'name' => 'Blibli',
            'link' => 'https://www.blibli.com/@tokoku',
        ]);
        ExternalShop::create([
            'name' => 'Shopee',
            'link' => 'https://shopee.co.id/@tokoku',
        ]);
    }
}
