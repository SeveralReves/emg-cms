<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Option;
use App\Models\Menu;
use App\Models\Quote;

class FrontendController extends Controller
{
    public function home()
    {
        $query = Option::where('type', 'header')->get();

        $header = [
            'menu' => Menu::where('menu', 'header')->get(),
            'button' => [
                'title' => 'Get a Quote',
                'url' => '#quote'
            ]
        ];
        foreach ($query as $key => $value) {
            switch ($value->key) {
                case 'menu':
                    break;

                case 'logo_url':
                    $header['logo']['url'] = $value->value;
                    break;

                case 'logo_alt':
                    $header['logo']['alt'] = $value->value;
                    break;

                case 'button_url':
                    $header['button']['url'] = $value->value;
                    break;

                case 'button_title':
                    $header['button']['title'] = $value->value;
                    break;

                default:
                    break;
            }
        }
        
        return Inertia::render('Home', [
            'title_page' => 'EMG Remodelling',
            'header' => $header,
            'footer' => [
                'logo' => [
                    'url' => asset('images/Logo.png'),
                    'alt' => 'logo'
                ],
                'copyright' => 'Copyright ©2024 - All Rights Reserved.',
                'description' => 'At Fidel Build, we are here to manage every aspect of your home construction or service process.',
                'contact' => [
                    'title' => 'Contact',
                    'mail' => [
                        'title' => 'mail@mail.com',
                        'icon' => [
                            'url' => asset('images/icons/fi_mail.png'),
                            'alt' => ''
                        ],
                    ],
                    'phone' => [
                        'title' => '123 432 3232',
                        'icon' => [
                            'url' => asset('images/icons/fi_phone-call.png'),
                            'alt' => ''
                        ],
                    ],
                    'address' => [
                        'title' => '6065 Roswell Rd. Suite #405 Sandy Springs, GA 30328',
                        'icon' => [
                            'url' => asset('images/icons/fi_map-pin.png'),
                            'alt' => ''
                        ],
                    ],
                ],
                'links' => [
                    'title' => 'Quick Links',
                    'list' => [
                        [
                            'title' => 'Home',
                            'url' => '#',
                        ],
                        [
                            'title' => 'Services',
                            'url' => '#',
                        ],
                        [
                            'title' => 'About Us',
                            'url' => '',
                        ],
                        [
                            'title' => 'Contact Us',
                            'url' => '',
                        ],
                    ],
                ],
                'rrss' => [
                    [
                        'url' => '#',
                        'icon' => [
                            'url' => asset('images/icons/facebook.png'),
                            'alt' => 'facebook'
                        ]
                    ],
                    [
                        'url' => '#',
                        'icon' => [
                            'url' => asset('images/icons/instagram.png'),
                            'alt' => 'instagram'
                        ]
                    ],
                    [
                        'url' => '#',
                        'icon' => [
                            'url' => asset('images/icons/tiktok.png'),
                            'alt' => 'tiktok'
                        ]
                    ],
                ],
            ]
        ]);
    }
}
