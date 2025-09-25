<?php

namespace App\Helpers;

class GeoHelper
{
    /**
     * Calculate the distance between two points using the Haversine formula
     *
     * @param float $lat1 Latitude of first point (in decimal degrees)
     * @param float $lon1 Longitude of first point (in decimal degrees)
     * @param float $lat2 Latitude of second point (in decimal degrees)
     * @param float $lon2 Longitude of second point (in decimal degrees)
     * @param string $unit Unit of distance ('km' for kilometers, 'mi' for miles, 'm' for meters)
     * @return float Distance between the two points
     */
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km')
    {
        // Earth's radius in different units
        $earthRadius = [
            'km' => 6371,    // kilometers
            'mi' => 3959,    // miles
            'm' => 6371000  // meters
        ];

        // Validate unit
        if (!isset($earthRadius[$unit])) {
            throw new \InvalidArgumentException("Invalid unit. Use 'km', 'mi', or 'm'");
        }

        // Convert degrees to radians
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        // Calculate differences
        $latDiff = $lat2Rad - $lat1Rad;
        $lonDiff = $lon2Rad - $lon1Rad;

        // Haversine formula
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($lat1Rad) * cos($lat2Rad) *
            sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calculate distance
        $distance = $earthRadius[$unit] * $c;

        return $distance;
    }
}
