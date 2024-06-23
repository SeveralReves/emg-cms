<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $quote = Quote::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quote submitted successfully',
            'data' => $quote,
        ], 201);
    }
}
