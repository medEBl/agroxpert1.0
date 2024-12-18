<?php

class ZoneM
{
    private $zoneData = []; // Tableau pour stocker les données météo
    private $nextId = 1; // Compteur pour générer des ID uniques

    /**
     * Créer une nouvelle entrée météo.
     * @param int $id_zone
     * @param string $nom
     * @param string $description
     * @param float $altitude
     * @param float $longitude
     * @return array
     */
    public function createMeteo(string $nom, string $description, float $altitude, int $longitude): array
    {
        $newMeteo = [
            'id_zone' => $this->nextId++,
            'nom' => $nom,
            'description' => $description,
            'latitude' => $altitude,
            'longitude' => $longitude,
        ];

        $this->zoneData[] = $newMeteo; // Ajouter la nouvelle entrée au tableau
        return $newMeteo;
    }

    /**
     * Récupérer toutes les entrées météo.
     *
     * @return array
     */
    public function fetchAllzone(): array
    {
        return $this->zoneData;
    }

    /**
     * Mettre à jour une entrée zone existante.
     *
     * @param int $id
     * @param string $nom
     * @param string $description
     * @param float $altitude
     * @param float $longitude
     * @return bool
     */
    public function updatezone(int $id, string $nom, string $description, float $altitude, float $longitude): bool
    {
        foreach ($this->zoneData as &$zone) {
            if ($zone['id_zone'] === $id) {
                $zone['nom'] = $nom;
                $zone['description'] = $description;
                $zone['latitude'] = $altitude;
                $zone['longitude'] = $longitude;
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
    public function deletezone(int $id): bool
    {
        foreach ($this->zoneData as $key => $zone) {
            if ($zone['id_zone'] === $id) {
                unset($this->zoneData[$key]);
                return true;
            }
        }

        return false; // Retourne false si aucune entrée avec l'ID n'a été trouvée
    }
}

?>
