<?php

namespace App\Repositories;

use App\Models\Banner;

class HomeBannerRepository
{
    public function getAll()
    {
        return Banner::where('is_page', 0)->get();
    }

    public function find($id)
    {
        return Banner::where('is_page', 0)->findOrFail($id);
    }

    public function create(array $data)
    {
        return Banner::create($data);
    }

    public function update($id, array $data)
    {
        $banner = Banner::where('is_page', 0)->findOrFail($id);
        return $banner->update($data);
    }

    public function delete($id)
    {
        return Banner::where('is_page', 0)->where('id', $id)->delete();
    }
}
