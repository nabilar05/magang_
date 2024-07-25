<?php
namespace App\Http\Controllers;

use App\Models\tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketsController extends Controller
{
    public function index()
    {
        $index = tickets::all();
        return response()->json([
            'status' => true,
            'message' => 'Data telah ditampilkan',
            'data' => $index,
        ]);
    }

    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'company' => 'required|exists:clients,id',
                'contact_person' => 'required|string|max:50',
                'product' => 'required|exists:products,id',
                'version_program' => 'required|string|max:255',
                'module' => 'required|exists:modules,id',
                'category' => 'required|in:category1,category2,category3',
                'urgent_level' => 'required|in:level1,level2,level3',
                'database_name' => 'nullable|string|max:255',
                'date' => 'required|date',
                'problem' => 'nullable|string|max:1000',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan validasi untuk gambar
                'assign_to' => 'required|exists:users,id',
                'assign_to_supervisor' => 'required|exists:users,id',
                'estimation_complation_date' => 'nullable|date',
                'is_done_in_version' => 'nullable|string|max:10',
                'program_version' => 'nullable|string|max:10',
                'technical_note' => 'nullable|string|max:1000',
                'is_done' => 'nullable|boolean',
            ]);

            // Tangani pengunggahan file
            if ($request->hasFile('attachment')) {
                $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
            }

            $ticket = tickets::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Data telah ditambahkan',
                'data' => $ticket
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show(Request $request, $id)
    {
        $index = tickets::find($id);
        if ($index) {
            return response()->json([
                'status' => true,
                'message' => 'Data ID telah ditampilkan',
                'data' => $index,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ID anda salah',
                'data' => null,
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'company' => 'required|exists:clients,id',
                'contact_person' => 'required|string|max:50',
                'product' => 'required|exists:products,id',
                'version_program' => 'required|string|max:255',
                'module' => 'required|exists:modules,id',
                'category' => 'required|in:category1,category2,category3',
                'urgent_level' => 'required|in:level1,level2,level3',
                'database_name' => 'nullable|string|max:255',
                'date' => 'nullable|date',
                'problem' => 'nullable|string|max:1000',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Aturan validasi untuk gambar
                'assign_to' => 'required|exists:users,id',
                'assign_to_supervisor' => 'required|exists:users,id',
                'estimation_complation_date' => 'nullable|date',
                'is_done_in_version' => 'nullable|string|max:10',
                'program_version' => 'nullable|string|max:10',
                'technical_note' => 'nullable|string|max:1000',
                'is_done' => 'nullable|boolean',
            ]);

            $index = tickets::find($id);

            if ($index) {
                // Tangani pengunggahan file
                if ($request->hasFile('attachment')) {
                    // Hapus attachment lama jika ada
                    if ($index->attachment) {
                        Storage::disk('public')->delete($index->attachment);
                    }
                    $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
                }

                $index->update($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Data telah diupdate',
                    'data' => $index,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ID anda salah',
                    'data' => null,
                ], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Update gagal (Periksa kembali data anda)',
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
