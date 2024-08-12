<?php

namespace App\Services\Cars;

use App\Models\Cars;
use Carbon\Carbon;

class StoreService
{
    /**
     * Create a new class instance.
     */
    public function store($data)
    {
        Cars::query()->create($data);
    }

    public function update($data, $cars)
    {
        $cars->update($data);
    }
}
