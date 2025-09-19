<?php

namespace App\Services;

use App\Repositories\HomeBannerRepository;

class HomeBannerService
{
    protected $homeBannerRepo;

    public function __construct(HomeBannerRepository $homeBannerRepo)
    {
        $this->homeBannerRepo = $homeBannerRepo;
    }

    public function create($data)
    {
        return $this->homeBannerRepo->create($data);
    }

    public function getAllHomeBanners()
    {
        return $this->homeBannerRepo->getAll();
    }

    public function getHomeBanner($id)
    {
        return $this->homeBannerRepo->find($id);
    }

    public function updateHomeBanner($id, $data)
    {
        return $this->homeBannerRepo->update($id, $data);
    }

    public function deleteHomeBanner($id)
    {
        return $this->homeBannerRepo->delete($id);
    }
}
