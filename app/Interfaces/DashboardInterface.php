<?php

namespace App\Interfaces;

use App\Models\Organization;
use Illuminate\Support\Collection;

interface DashboardInterface
{
    public function getLocations(int $id): Collection;

    public function findOrganizationByDomain(string $domain): Organization;
}
