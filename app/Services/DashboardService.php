<?php

namespace App\Services;

use App\Interfaces\DashboardInterface;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Support\Collection;

class DashboardService implements DashboardInterface
{
    public function findLocationByColumn(string $column, string|int $value, array $columns = ['*']): Location
    {
        $location = Location::where($column, $value)->first($columns);

        if (!$location) {
            throw new \Exception('Location not found', 404);
        }

        return $location;
    }
    
    public function findOrganizationByColumn(string $column, string|int $value, array $columns = ['*']): Organization
    {
        $organization = Organization::where($column, $value)->first($columns);

        if (!$organization) {
            throw new \Exception('Organization not found', 404);
        }

        return $organization;
    }

    public function getLocationsForDashboard(int $id): Array
    {
        $top5 = Location::where('organization_id', $id)
            ->orderBy('total_score', 'DESC')
            ->limit(5)
            ->get([
                'id',
                'organization_id',
                'title',
                'address',
                'total_score',
                'color'
            ]);

        $bottom5 = Location::where('organization_id', $id)
            ->orderBy('total_score')
            ->limit(5)
            ->get([
                'id',
                'organization_id',
                'title',
                'address',
                'total_score',
                'color'
            ]);

        return [
            'top5' => $top5,
            'bottom5' => $bottom5
        ];
    }
    
    public function getLocationsForCalculate(int $id): Collection
    {
        $locations = Location::where('organization_id', $id)
            ->get([
                'id',
                'reviews_rating',
                'total_reviews',
                'last_month_reviews'
            ]);

        return $this->prepareLocationsForCalculate($locations);
    }

    public function prepareLocationsForCalculate($locations)
    {
        $reviewsRating = $locations->pluck('reviews_rating')->toArray();
        $totalReviews = $locations->pluck('total_reviews')->toArray();
        $lastMonthReviews = $locations->pluck('last_month_reviews')->toArray();

        $data = collect();

        foreach ($locations as $location) {
            $scores = $this->calculateScores([
                'reviews_rating_percentile' => [
                    'value' => $location->reviews_rating,
                    'total' => $reviewsRating
                ],
                'total_reviews_percentile' => [
                    'value' => $location->total_reviews,
                    'total' => $totalReviews
                ],
                'last_month_reviews_percentile' => [
                    'value' => $location->last_month_reviews,
                    'total' => $lastMonthReviews
                ]
            ]);

            $data->push([
                'id' => $location->id,
                'scores' => $scores
            ]);
        }

        return $data;
    }

    public function calculateScores(array $reviews)
    {
        $data = collect();
        $avgScore = collect();
        
        foreach ($reviews as $key => $review) {
            $score = $this->calculatePercentile($review['value'], $review['total']);
  
            $data->put($key, $score);
            $avgScore->push($this->normalize($score));
        }

        $totalScore = (int) $avgScore->avg();

        $data->put('total_score', $totalScore);
        $data->put('color', $this->setColor($totalScore));

        return $data;
    }

    public function calculatePercentile(int|float $value, array $total)
    {
        $totalCount = count($total);
        
        if (!$totalCount) {
            return 0;
        }

        if (array_sum($total) == 0 && $value == 0) {
            return 0;
        }

        if (!in_array($value, $total)) {
            $total[] = $value;
            $totalCount = count($total);
        }
        
        sort($total);

        $index = array_search($value, $total) + 1;
        $percentile = $index / $totalCount * 100;
        
        return round($percentile, 2);
    }

    public function normalize(
        $value,
        $oldMin = 0,
        $oldMax = 100,
        $newMin = 0,
        $newMax = 1000
    )
    {
        if ($oldMin === $oldMax) {
            return $newMin;
        }

        if ($value > $oldMax) {
            return $newMax;
        }

        if ($value < $oldMin) {
            return $newMin;
        }

        return (
            (($value - $oldMin) * ($newMax - $newMin)) /
            ($oldMax - $oldMin) + $newMin
        );
    }

    public function setColor($totalScore): string
    {
        switch ($totalScore) {
            case $totalScore <= 81:
                $color = '#c20606';
                break;
            case $totalScore <= 114:
                $color = '#c93f04';
                break;
            case $totalScore <= 196:
                $color = '#e3591e';
                break;
            case $totalScore <= 277:
                $color = '#e37d1e';
                break;
            case $totalScore <= 358:
                $color = '#e3ab3b';
                break;
            case $totalScore <= 440:
                $color = '#ebd300';
                break;
            case $totalScore <= 521:
                $color = '#c9b926';
                break;
            case $totalScore <= 602:
                $color = '#90c924';
                break;
            case $totalScore <= 684:
                $color = '#15b354';
                break;
            case $totalScore > 684:
                $color = '#42f5bf';
                break;
        }

        return $color;
    }
}
