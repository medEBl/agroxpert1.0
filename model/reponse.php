<?php

class Reponse {
    private ?int $id_reponse; // ID primaire
    private ?int $id; // Clé étrangère
    private ?string $reponse; // Texte de la réponse
    private ?DateTime $date_reponse; // Date de la réponse

    // Constructeur
    public function __construct(?int $id_reponse, ?int $id, ?string $reponse, ?DateTime $date_reponse) {
        $this->id_reponse = $id_reponse;
        $this->id = $id;
        $this->reponse = $reponse;
        $this->date_reponse = $date_reponse;
    }

    // Getters et Setters
    public function getIdReponse(): ?int {
        return $this->id_reponse;
    }

    public function setIdReponse(?int $id_reponse): void {
        $this->id_reponse = $id_reponse;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getReponse(): ?string {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): void {
        $this->reponse = $reponse;
    }

    public function getDateReponse(): ?DateTime {
        return $this->date_reponse;
    }

    public function setDateReponse(?DateTime $date_reponse): void {
        $this->date_reponse = $date_reponse;
    }
}
?>
