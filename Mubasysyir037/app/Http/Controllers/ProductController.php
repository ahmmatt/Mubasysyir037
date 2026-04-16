<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    protected $service;

    // Inject Service ke dalam Controller [cite: 376]
    public function __construct(ProductService $service) 
    {
        $this->service = $service;
    }

    // 1. Fungsi Tampilkan Data
    public function index() 
    {
        try {
            $data = $this->service->getAllProducts();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal mengambil data'], 500);
        }
    }

    // 2. Fungsi Tambah Data
    public function store(StoreProductRequest $request) 
    {
        try {
            $result = $this->service->storeProduct($request->validated()); // Input sudah divalidasi
            return response()->json(['status' => true, 'data' => $result]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal simpan data'], 500);
        }
    }

    // 3. Fungsi Ubah Data
    public function update(UpdateProductRequest $request, $id) 
    {
        try {
            $result = $this->service->updateProduct($id, $request->validated());
            return response()->json(['status' => true, 'data' => $result]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal ubah data'], 500);
        }
    }

    // 4. Fungsi Hapus Data
    public function destroy($id) 
    {
        try {
            $this->service->deleteProduct($id);
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal hapus data'], 500);
        }
    }
}
