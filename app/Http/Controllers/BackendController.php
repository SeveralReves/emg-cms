<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Option;
use App\Models\Menu;

class BackendController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function header()
    {
        // 'header' => [
        //     'logo' => [
        //         'url' => asset('images/Logo.png'),
        //         'alt' => 'logo'
        //     ],
        //     'menu' => [
        //         [
        //             'title' => 'Home',
        //             'url' => '#',
        //         ],
        //         [
        //             'title' => 'Services',
        //             'url' => '#',
        //         ],
        //         [
        //             'title' => 'About Us',
        //             'url' => '',
        //         ],
        //         [
        //             'title' => 'Contact Us',
        //             'url' => '',
        //         ],
        //     ],
        //     'button' => [
        //         'title' => 'Get a Quote',
        //         'url' => '#'
        //     ]
        // ]
        $query = option::where('type', 'header')->get();

        $options = [];
        foreach ($query as $key => $value) {
            switch ($value->key) {
                case 'menu':
                    break;
                
                case 'logo_url':
                    $options['logo']['url'] = $value->value;
                    break;
                    
                case 'logo_alt':
                    $options['logo']['alt'] = $value->value;
                    break;
                
                case 'button_url':
                    $options['button']['url'] = $value->value;
                    break;
                
                case 'button_title':
                    $options['button']['title'] = $value->value;
                    break;
                
                default:
                    break;
            }
        }
        $structure = [
            [
                'type' => 'image',
                'label' => 'Logo',
                'name' => 'logo',
                'rules' => 'required',
                'description' => '200x200px'
            ], 
            [
                'type' => 'button',
                'label' => 'Button',
                'name' => 'button',
                'rules' => 'required',
                'description' => ''
            ], 
            [
                'type' => 'text',
                'label' => 'Title',
                'name' => 'title',
                'description' => ''
            ], 
            [
                'type' => 'array',
                'label' => 'Menu',
                'name' => 'menu',
                'description' => '',
                'structure' => [
                    [
                        'type' => 'text',
                        'label' => 'Title',
                        'name' => 'title',
                        'description' => ''
                    ], 
                    [
                        'type' => 'text',
                        'label' => 'URL',
                        'name' => 'url',
                        'description' => ''
                    ], 
                ]
            ], 
        ];


        return Inertia::render('Header', compact('options', 'structure'));
    }
}
