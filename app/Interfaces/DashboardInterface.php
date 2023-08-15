<?php

namespace App\Interfaces;

use App\Models\Location;
use App\Models\Organization;
use Illuminate\Support\Collection;

interface DashboardInterface
{
    public function getLocationsForCalculate(int $id): Collection;

    public function getLocationsForDashboard(int $id): Array;

    public function findOrganizationByColumn(string $column, string|int $value, array $columns = ['*']): Organization;

    public function findLocationByColumn(string $column, string|int $value, array $columns = ['*']): Location;
}
