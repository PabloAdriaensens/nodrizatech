<?php

namespace App\Application\Service;

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

    /**
     * @param $planetStructure
     * @param $parameter
     * @return array
     */
    public function validatePlanet($planetStructure, $parameter): array
    {
        $differentKeys = array_diff_key($parameter, $planetStructure);

        if (!empty($differentKeys)) {
            foreach ($differentKeys as $key => $index) {
                if (!array_key_exists($key, $planetStructure)) {
                    return ['JSON with not valid parameters'];
                }
            }
        }

        if (array_key_exists('name', $parameter)) {
            return [];
        }

        return ['Name not found in parameters'];
    }
}