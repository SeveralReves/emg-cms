<?php
// app/Http/Controllers/OptionController.php
namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::all();
        return response()->json($options);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:options',
            'value' => 'required|string',
            'type' => 'nullable|in:global,header,footer',
        ]);

        $option = Option::create($validated);
        return response()->json($option, 201);
    }

    public function show($id)
    {
        $option = Option::findOrFail($id);
        return response()->json($option);
    }

    public function update(Request $request, $id)
    {
        $option = Option::findOrFail($id);

        $validated = $request->validate([
            'key' => 'required|string|unique:options,key,' . $id,
            'value' => 'required|string',
            'type' => 'nullable|in:global,header,footer',
        ]);

        $option->update($validated);
        return response()->json($option);
    }

    public function destroy($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();
        return response()->json(null, 204);
    }
}
