<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCategories()
    {
        return $this->repository->getAll();
    }

    public function getCategory($id)
    {
        return $this->repository->find($id);
    }

    public function createCategory($data)
    {
        return $this->repository->create($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->repository->delete($id);
    }
}
