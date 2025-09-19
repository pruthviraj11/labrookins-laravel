<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository
{
    public function getAll()
    {
        return OrderDetail::orderBy('date_and_time', 'desc')->get();
    }

    public function find($id)
    {
        return OrderDetail::findOrFail($id);
    }

    public function delete($id)
    {
        return OrderDetail::destroy($id);
    }
}

