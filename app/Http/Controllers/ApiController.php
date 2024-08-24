<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Menu;

class ApiController extends Controller
{
    public function updateHeader(Request $request)
    {
        $datas = $request->all();
        foreach ($datas as $key => $value) {
            switch ($key) {
                case 'logo':
                    $val = json_decode($value);
                    if ($val && property_exists($val, 'url') && property_exists($val, 'alt')) {
                        // Obtener la cadena base64 de la imagen
                        $imageData = $val->url;
                        // Extraer el tipo MIME
                        preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches);
                        if($matches){
                            $imageType = $matches[1]; // jpeg, png, gif, etc.

                            // Decodificar la cadena base64
                            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
    
                            // Generar un nombre único para la imagen  
                            $imageName = time() . '.' . $imageType;
    
                            // Ruta donde se guardará la imagen
                            $imagePath = public_path('images') . '/' . $imageName;
    
                            // Guardar la imagen en el servidor
                            file_put_contents($imagePath, $imageData);
    
                            // Crear la URL para la imagen
                            $imageURL = url('images/' . $imageName);
    
                            // Guardar la URL en la base de datos
                            Option::updateOrCreate(['key' => 'logo_url'], ['value' => $imageURL]);
                        }
                        Option::updateOrCreate(['key' => 'logo_alt'], ['value' => $val->alt]);
                    }
                    break;
                case 'button':
                    $val = json_decode($value);
                    if ($val && property_exists($val, 'url') && property_exists($val, 'title')) {
                        // Obtener la cadena base64 de la imagen

                        Option::updateOrCreate(['key' => 'button_url'], ['value' => $val->url]);
                        Option::updateOrCreate(['key' => 'button_title'], ['value' => $val->title]);
                    }
                    break;
                    case 'menu':
                        // Obtener todos los IDs de los menús existentes con 'menu' igual a 'header'
                        $existingIds = Menu::where('menu', 'header')->pluck('id')->toArray();
                    
                        foreach ($value as $k => $m) {
                            Menu::updateOrCreate(['id' => $m['id'] ?? ''], ['menu' => 'header', 'order' => $k, 'title' => $m['title'], 'url' => $m['url']]);
                            
                            // Eliminar menú si el ID no está presente en el arreglo
                            if (isset($m['id']) && in_array($m['id'], $existingIds)) {
                                unset($existingIds[array_search($m['id'], $existingIds)]);
                            }
                        }
                    
                        // Eliminar menús que no están presentes en el arreglo y tienen 'menu' igual a 'header'
                        Menu::where('menu', 'header')->whereIn('id', $existingIds)->delete();
                    
                        break;
                default:
                    # code...
                    break;
            }
        }

        // return Inertia::render('Quotes', compact('quotes'));
        return response()->json([
            'success' => true,
            'message' => 'Update submitted successfully',
        ], 201);
    }
}
