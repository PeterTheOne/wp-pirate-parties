<?php

class Parties {
    private $apiUrl = 'http://api.piratetimes.net/api/v1/parties/';

    private function remoteGet() {
        $response = wp_remote_get($this->apiUrl);
        if (!is_array($response) || !isset($response['body'])) {
            return null;
        }
        $parties = json_decode($response['body']);
        if ($parties === null) {
            return null;
        }
        return get_object_vars($parties);
    }

    private function filter($parties, $ppiFilter, $ppeuFilter) {
        $filteredParties = array();
        foreach ($parties as $party) {
            if ($ppiFilter === '1' && !$party->membership->ppi) {
                continue;
            }
            if ($ppeuFilter === '1' && !$party->membership->ppeu) {
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
                    $countryCodeA = $a->countryCode;
                    $countryCodeB = $b->countryCode;
                    return strcmp($a->partyName->{$countryCodeA}, $b->partyName->{$countryCodeB});
                });
                break;
            case 'country':
                usort($parties, function($a, $b) {
                    return strcmp($a->country, $b->country);
                });
                break;
            case 'en': default:
            usort($parties, function($a, $b) {
                return strcmp($a->partyName->en, $b->partyName->en);
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
