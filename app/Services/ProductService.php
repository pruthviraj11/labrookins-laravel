<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Str;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store(array $data)
    {
        $data['encrypted_id'] = Str::uuid()->toString();
        return $this->repo->create($data);
    }

    public function update($encrypted_id, array $data)
    {
        $product = $this->repo->findByEncryptedId($encrypted_id);
        return $this->repo->update($product, $data);
    }

    public function delete($encrypted_id)
    {
        $product = $this->repo->findByEncryptedId($encrypted_id);
        return $this->repo->delete($product);
    }

    public function find($encrypted_id)
    {
        return $this->repo->findByEncryptedId($encrypted_id);
    }
}
