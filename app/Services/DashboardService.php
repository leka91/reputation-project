<?php

namespace App\Services;

use App\Interfaces\DashboardInterface;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Support\Collection;

class DashboardService implements DashboardInterface
{
    public function findOrganizationByDomain(string $domain): Organization
    {
        $organization = Organization::where('domain', $domain)->first();

        if (!$organization) {
            throw new \Exception('Organization not found', 404);
        }

        return $organization;
    }
    
    public function getLocations(int $id): Collection
    {
        $locations = Location::where('organization_id', $id)
            ->get([
                'id',
                'title',
                'address',
                'reviews_rating',
                'total_reviews',
                'last_month_reviews'
            ]);

        return $this->prepareLocationsForDashboard($locations);
    }

    public function prepareLocationsForDashboard($locations)
    {
        $reviewsRating = $locations->pluck('reviews_rating')->toArray();
        $totalReviews = $locations->pluck('total_reviews')->toArray();
        $lastMonthReviews = $locations->pluck('last_month_reviews')->toArray();

        $data = collect();

        foreach ($locations as $location) {
            $totalScore = $this->calculateTotalScore([
                [
                    'value' => $location->reviews_rating,
                    'total' => $reviewsRating
                ],
                [
                    'value' => $location->total_reviews,
                    'total' => $totalReviews
                ],
                [
                    'value' => $location->last_month_reviews,
                    'total' => $lastMonthReviews
                ]
            ]);

            $data->push([
                'id' => $location->id,
                'title' => $location->title,
                'address' => $location->address,
                'total_score' => $totalScore
            ]);
        }

        return $data->sortByDesc('total_score');
    }

    public function calculateTotalScore(array $reviews)
    {
        $data = collect();
        
        foreach ($reviews as $review) {
            $score = $this->calculatePercentile($review['value'], $review['total']);
            $score = $this->normalize($score);

            $data->push($score);
        }

        return (int) $data->avg();
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
}
