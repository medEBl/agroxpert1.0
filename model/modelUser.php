<?php


class model
{
    private $name;
    private $email;
    private $password;
    private $adresse;
    private $typeUser;


    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;  
        $this->password = $password;
        $this->typeUser = $typeUser;
        $this->adresse = $adresse;

    }

    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getType() { return $this->typeUser; }
    public function getAdresse() { return $this->adresse; }



    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setTypeUser($typeUser) { $this->typeUser = $typeUser; } // Setter pour typeUser
    public function setAdresse($adresse) { $this->adresse = $adresse; }

}
?>
