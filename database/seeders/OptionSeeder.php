<?php

// database/seeders/OptionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    public function run()
    {
        Option::create([
            'key' => 'site_title',
            'value' => 'EMG Remodelling',
            'type' => 'global'
        ]);

        Option::create([
            'key' => 'favicon',
            'value' => '/images/Logo.png',
            'type' => 'global'
        ]);

        Option::create([
            'key' => 'header_pixel',
            'value' => '<script>/* Pixel Code */</script>',
            'type' => 'header'
        ]);

        Option::create([
            'key' => 'footer_pixel',
            'value' => '<script>/* Pixel Code */</script>',
            'type' => 'footer'
        ]);
        
        Option::create([
            'key' => 'menu',
            'value' => 'menu_ppal',
            'type' => 'header'
        ]);

        Option::create([
            'key' => 'logo_url',
            'value' => asset('images/Logo.png'),
            'type' => 'header'
        ]);

        Option::create([
            'key' => 'logo_alt',
            'value' => 'alt',
            'type' => 'header'
        ]);
        Option::create([
            'key' => 'button_url',
            'value' => '#',
            'type' => 'header'
        ]);

        Option::create([
            'key' => 'button_title',
            'value' => 'Get a quote',
            'type' => 'header'
        ]);
    }
}
