<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BackendController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MenuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'title_page' => 'EMG Remodelling',
        'header' => [
            'logo' => [
                'url' => asset('images/Logo.png'),
                'alt' => 'logo'
            ],
            'menu' => [
                [
                    'title' => 'Home',
                    'url' => '#home',
                ],
                [
                    'title' => 'Features',
                    'url' => '#features',
                ],
                [
                    'title' => 'Services',
                    'url' => '#services',
                ],
                [
                    'title' => 'About Us',
                    'url' => '#about',
                ],
                [
                    'title' => 'Contact Us',
                    'url' => '#footer',
                ],
            ],
            'button' => [
                'title' => 'Get a Quote',
                'url' => '#quote'
            ]
        ],
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
});

Route::get('/dashboard', [BackendController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/header', [BackendController::class, 'header'])->middleware(['auth', 'verified'])->name('header');
Route::get('/quotes', [BackendController::class, 'quotes'])->middleware(['auth', 'verified'])->name('quotes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('menus', MenuController::class);


require __DIR__ . '/auth.php';
