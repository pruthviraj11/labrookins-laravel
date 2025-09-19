<?php

namespace App\Repositories;

use App\Models\Devotional;

class DevotionalRepository
{
    public function getAll()
    {
        return Devotional::all();
    }

    public function find($id)
    {
        return Devotional::find($id);
    }

    public function create(array $data)
    {
        return Devotional::create($data);
    }

    public function update($id, array $data)
    {
        return Devotional::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Devotional::where('id', $id)->delete();
    }
}
