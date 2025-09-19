<?php

namespace App\Services;

use App\Repositories\OrderDetailRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderDetailService
{
    protected $repo;

    public function __construct(OrderDetailRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->getAll();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}

