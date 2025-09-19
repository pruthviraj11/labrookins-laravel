<?php

namespace App\Repositories;

use App\Models\Banner;

class AllPageBannerRepository
{
    public function find($id)
    {
        return Banner::where('is_page', 1)->find($id);
    }


    public function create(array $data)
    {

        $allPageBanner = Banner::create($data);
        // dd($permissions);
        return $allPageBanner;
    }

    public function update($id, array $data)
    {
        $allPageBanner = Banner::where('is_page', 1)->find($id);
        return Banner::where('id', $id)->where('is_page', 1)->update($data);
    }

    public function delete($id)
    {
        return Banner:: where('is_page', 1)->where('id', $id)->delete();
    }
    public function getAll()
    {
        return Banner::where('is_page', 1)->get();
    }
    public function allWithUsers()
    {
        return Banner::where('is_page', 1)->get();
    }
}
