<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class productsController extends Controller
{
    public function index()
    {
        $index= products::all();
        return response()->json([
            'status' => true,
            'message' => 'data telah ditampilkan',
              'data' => $index ], );

    }

   
    public function create(Request $request)
    {
        try {
            
            $data= $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
           
            $product =products::create($data);
            $product->name = $request->name;
            $product->save();
    
           
            return response()->json([
                'status' => true,
                'message' => 'Data telah diupdate',
                'data' => $product
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    

   
   
}