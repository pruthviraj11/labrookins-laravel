<?php

namespace App\Repositories;

use App\Models\Itinerary;

class ItineraryRepository
{
    public function all()
    {
        return Itinerary::query();
    }

    public function find($id)
    {
        return Itinerary::findOrFail($id);
    }

    public function create(array $data)
    {
        return Itinerary::create($data);
    }

    public function update($id, array $data)
    {
        $itinerary = $this->find($id);
        $itinerary->update($data);
        return $itinerary;
    }

    public function delete($id)
    {
        $itinerary = $this->find($id);
        return $itinerary->delete();
    }
}
