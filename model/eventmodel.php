<?php

class Event
{
    private $id;          // Primary key (ID)
    private $name;        // Name of the event
    private $description; // Description of the event
    private $image;       // Path or URL of the event image

    /**
     * Constructor with attributes id, name, description, and image
     */
    public function __construct($id = null, $name = null, $description = null, $image = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    // Getter and Setter for id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    // Getter and Setter for description
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Getter and Setter for image
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}

?>
