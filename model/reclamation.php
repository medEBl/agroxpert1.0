<?php

class Reclamation {
    private ?int $id; // Identifiant unique
    private ?DateTime $datereclamation; // Date de la réclamation
    private ?string $description; // Description de la réclamation
    private ?string $statut; // Statut de la réclamation (ex: ouvert, fermé)
    private ?int $id_user; // Identifiant de l'utilisateur
    private ?int $tel; // Téléphone de l'utilisateur
    private ?string $adresse; // Adresse de l'utilisateur

    // Constructor
    public function __construct(
        ?int $id,
        ?DateTime $datereclamation,
        ?string $description,
        ?string $statut,
        ?int $id_user,
        ?int $tel,
        ?string $adresse
    ) {
        $this->id = $id;
        $this->datereclamation = $datereclamation;
        $this->description = $description;
        $this->statut = $statut;
        $this->id_user = $id_user;
        $this->tel = $tel;
        $this->adresse = $adresse;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getDatereclamation(): ?DateTime {
        return $this->datereclamation;
    }

    public function setDatereclamation(?DateTime $datereclamation): void {
        $this->datereclamation = $datereclamation;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getStatut(): ?string {
        return $this->statut;
    }

    public function setStatut(?string $statut): void {
        $this->statut = $statut;
    }

    public function getIdUser(): ?int {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): void {
        $this->id_user = $id_user;
    }

    public function getTel(): ?int {
        return $this->tel;
    }

    public function setTel(?int $tel): void {
        $this->tel = $tel;
    }

    public function getAdresse(): ?string {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): void {
        $this->adresse = $adresse;
    }
}
?>
