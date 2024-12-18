<?php

class MeteoModel
{
    private $meteoData = []; // Tableau pour stocker les données météo
    private $nextId = 1;     // Compteur pour générer des ID uniques

    /**
     * Créer une nouvelle entrée météo.
     *
     * @param float $temperature
     * @param float $humidite
     * @param float $vent
     * @param int $zone
     * @param string $date
     * @param string $time
     * @return array
     */
    public function createMeteo(
        float $temperature,
        float $humidite,
        float $vent,
        int $zone,
        string $date,
        string $time
    ): array {
        $newMeteo = [
            'id_meteo' => $this->nextId++,
            'temperature' => $temperature,
            'humidite' => $humidite,
            'vent' => $vent,
            'zone' => $zone,
            'date' => $date,
            'time' => $time,
        ];

        $this->meteoData[] = $newMeteo; // Ajouter la nouvelle entrée au tableau
        return $newMeteo;
    }

    /**
     * Récupérer toutes les entrées météo.
     *
     * @return array
     */
    public function fetchAllMeteo(): array
    {
        return $this->meteoData;
    }

    /**
     * Mettre à jour une entrée météo existante.
     *
     * @param int $id
     * @param float $temperature
     * @param float $humidite
     * @param float $vent
     * @param int $zone
     * @param string $date
     * @param string $time
     * @return bool
     */
    public function updateMeteo(
        int $id,
        float $temperature,
        float $humidite,
        float $vent,
        int $zone,
        string $date,
        string $time
    ): bool {
        foreach ($this->meteoData as &$meteo) {
            if ($meteo['id_meteo'] === $id) {
                $meteo['temperature'] = $temperature;
                $meteo['humidite'] = $humidite;
                $meteo['vent'] = $vent;
                $meteo['zone'] = $zone;
                $meteo['date'] = $date;
                $meteo['time'] = $time;
                return true;
            }
        }

        return false; // Retourne false si aucune entrée avec l'ID n'a été trouvée
    }

    /**
     * Supprimer une entrée météo par ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteMeteo(int $id): bool
    {
        foreach ($this->meteoData as $key => $meteo) {
            if ($meteo['id_meteo'] === $id) {
                unset($this->meteoData[$key]);
                return true;
            }
        }

        return false; // Retourne false si aucune entrée avec l'ID n'a été trouvée
    }
}

?>
