<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::where('is_deleted', 'no')->get();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        return Category::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Category::where('id', $id)->update(['is_deleted' => 'yes']);
    }
}
