<?php

namespace App\Services;

use App\Repositories\AboutUsRepository;

class AboutUsService
{
    protected $repository;

    public function __construct(AboutUsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAboutUs()
    {
        return $this->repository->getFirst();
    }

    public function saveAboutUs(array $data)
    {
        $aboutUs = $this->repository->getFirst();

        if ($aboutUs) {
            return $this->repository->update($aboutUs, $data);
        }

        return $this->repository->create($data);
    }
}
