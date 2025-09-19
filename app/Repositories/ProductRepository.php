<?php
// app/Repositories/ProductRepository.php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
      // dd(Product::with('category')->latest()->get());
        return Product::with('category')->latest()->get();
    }

    public function findByEncryptedId($encrypted_id)
    {
      // dd($encrypted_id);
      $id = decrypt($encrypted_id);
        return Product::where('id', $id)->firstOrFail();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        return $product->update($data);
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }
}

