<?php

namespace App\Services;

use App\Repositories\DevotionalRepository;

class DevotionalService
{
    protected $repository;

    public function __construct(DevotionalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllDevotionals()
    {
        return $this->repository->getAll();
    }

    public function getDevotional($id)
    {
        return $this->repository->find($id);
    }

    public function createDevotional(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateDevotional($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteDevotional($id)
    {
        return $this->repository->delete($id);
    }
}
