<?php

namespace App\Repositories;

use App\Models\AboutUs;

class AboutUsRepository
{
    public function getFirst()
    {
        return AboutUs::first();
    }

    public function create(array $data)
    {
        return AboutUs::create($data);
    }

    public function update(AboutUs $aboutUs, array $data)
    {
        $aboutUs->update($data);
        return $aboutUs;
    }
}
