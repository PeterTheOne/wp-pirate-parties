<?php

class Parties {
    private $apiUrl = 'http://api.piratetimes.net/api/v1/parties/';

    private function remoteGet() {
        $response = wp_remote_get($this->apiUrl);
        if (!is_array($response) || !isset($response['body'])) {
            return [];
        }
        $parties = json_decode($response['body']);
        if ($parties === null) {
            return [];
        }
        return get_object_vars($parties);
    }

    private function filter($parties, $ppiFilter, $ppeuFilter) {
        $filteredParties = array();
        foreach ($parties as $party) {
            if ($ppiFilter === '1' && (!isset($party->membership->ppi) || !$party->membership->ppi)) {
                continue;
            }
            if ($ppeuFilter === '1' && (!isset($party->membership->ppeu) || !$party->membership->ppeu)) {
                continue;
            }
            $filteredParties[] = $party;
        }
        return $filteredParties;
    }

    private function sort($parties, $displayOption) {
        switch ($displayOption) {
            case 'native':
                usort($parties, function($a, $b) {
                    $countryCodeA = $a->country_code;
                    $countryCodeB = $b->country_code;
                    $nameA = isset($a->name->{$countryCodeA}) ? $a->name->{$countryCodeA} : $a->name->en;
                    $nameB = isset($b->name->{$countryCodeB}) ? $b->name->{$countryCodeB} : $b->name->en;
                    return strcmp($nameA, $nameB);
                });
                break;
            case 'country':
                usort($parties, function($a, $b) {
                    return strcmp($a->country_name, $b->country_name);
                });
                break;
            case 'en': default:
            usort($parties, function($a, $b) {
                return strcmp($a->name->en, $b->name->en);
            });
            break;
        }
        return $parties;
    }

    public function get($displayOption, $linkOption, $ppiFilter, $ppeuFilter) {
        $parties = $this->remoteGet();
        $parties = $this->filter($parties, $ppiFilter, $ppeuFilter);
        $parties = $this->sort($parties, $displayOption);

        return $parties;
    }
}
