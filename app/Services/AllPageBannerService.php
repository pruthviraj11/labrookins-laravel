<?php

namespace App\Services;

use App\Repositories\AllPageBannerRepository;

class AllPageBannerService


{
    protected $allpagebannerRepository;

    public function __construct(AllPageBannerRepository $allpagebannerRepository)
    {
        $this->allpagebannerRepository = $allpagebannerRepository;
    }
    public function create($allPageBannerData)
    {
        $allPageBanner = $this->allpagebannerRepository->create($allPageBannerData);
        return $allPageBanner;
    }

    public function getAllallPageBanners()
    {
        $allPageBanners = $this->allpagebannerRepository->getAll();
        return $allPageBanners;
    }
    public function getAllPageBanner($id)
    {
        $allPageBanner = $this->allpagebannerRepository->find($id);
        return $allPageBanner;
    }
    public function deleteAllPageBanner($id)
    {
        $deleted = $this->allpagebannerRepository->delete($id);
        return $deleted;
    }
    public function updateAllpageBanner($id, $allPageBannerData)
    {
        $updated = $this->allpagebannerRepository->update($id, $allPageBannerData);
        return $updated;
    }
}
