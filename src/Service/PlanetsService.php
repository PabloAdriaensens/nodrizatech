<?php

namespace App\Service;

class PlanetsService
{
    /**
     * @param $planet
     * @param $planetId
     * @return array
     */
    public function getPlanets($planet, $planetId): array
    {
        $planetFormatted = [];
        if (isset($planet, $planetId) && !empty($planet) && is_int($planetId)) {
            $planetFormatted['id'] = $planetId;
            $planetFormatted['name'] = $planet['name'];
            $planetFormatted['rotation_period'] = (int)$planet['rotation_period'];
            $planetFormatted['orbital_period'] = (int)$planet['orbital_period'];
            $planetFormatted['diameter'] = (int)$planet['diameter'];
            $planetFormatted['films_count'] = count($planet['films']);
            $planetFormatted['created'] = date($planet['created']);
            $planetFormatted['edited'] = date($planet['edited']);
            $planetFormatted['url'] = $planet['url'];
        }

        return $planetFormatted;
    }
}