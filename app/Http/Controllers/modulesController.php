<?php

namespace App\Http\Controllers;


use App\Models\modules;
use Illuminate\Http\Request;

class ModulesController extends Controller
{

    public function index()
    {
        $index= modules::all();
    return response()->json([
        'status' => true,
        'message' => 'data telah ditampilkan',
          'data' => $index ], );
    }

   
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
           
            $module = new modules();
            $module->name = $request->name;
            $module->save();
    
           
            return response()->json(['message' => 'Data module berhasil ditambahkan'], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
           
            return response()->json([
                'status' => false,
                'message' => 'Data berhasil ditambahkan',
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