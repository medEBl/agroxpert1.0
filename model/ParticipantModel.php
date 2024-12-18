<?php

class Participant
{
    private $id_participant; // Primary key (ID)
    private $name;           // Name of the participant
    private $email;          // Email of the participant
    private $event_id;       // Foreign key to associate with an event

    // Constructor with attributes id_participant, name, email, and event_id
    public function __construct($id_participant = null, $name = null, $email = null, $event_id = null)
    {
        $this->id_participant = $id_participant;
        $this->name = $name;
        $this->email = $email;
        $this->event_id = $event_id;
    }

    // Getter and Setter for id_participant
    public function getIdParticipant()
    {
        return $this->id_participant;
    }

    public function setIdParticipant($id_participant)
    {
        $this->id_participant = $id_participant;
    }

    // Getter and Setter for name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter and Setter for email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter and Setter for event_id (foreign key)
    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }
}

?>
