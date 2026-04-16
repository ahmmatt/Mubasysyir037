<?php
namespace App\Services;

use App\Models\Product;
use Exception;

class ProductService 
{
    public function getAllProducts() 
    {
        try {
            return Product::all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function storeProduct($data) 
    {
        try {
            return Product::create($data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateProduct($id, $data) 
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($data);
            return $product;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteProduct($id) 
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>