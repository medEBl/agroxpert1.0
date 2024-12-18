<?php

class ForumPost
{
    private $idpost; //primary key of post
    private $typeuser; // 
    private $authorname; // 
    private $typepost; // 
    private $titleP;
    private $contentP;
    private $createDateP;
    private $updateDateP;
    private $nbviewsp;
    private $nblikesp;
    
    private $Id_UserP;//foreign key to id user suposed to be 1

    // Constructor with new attributes
    public function __construct($idpost = null, $typeuser = null, $authorname = null, $typepost = null, 
                                $titleP = null, $contentP = null, $createDateP = null, $updateDateP = null, 
                                $nbviewsp = 0, $nblikesp = 0, $Id_UserP = null)
    {
        $this->idpost = $idpost;
        $this->typeuser = $typeuser;  // New field
        $this->authorname = $authorname;  // New field
        $this->typepost = $typepost;  // New field
        $this->titleP = $titleP;
        $this->contentP = $contentP;
        $this->createDateP = $createDateP;
        $this->updateDateP = $updateDateP;
        $this->nbviewsp = $nbviewsp;
        $this->nblikesp = $nblikesp;
        $this->Id_UserP = $Id_UserP;
    }

    // Getter and Setter for idpost
    public function getId()
    {
        return $this->idpost;
    }

    public function setId($idpost)
    {
        $this->idpost = $idpost;
    }

    // Getter and Setter for typeuser (Admin, Member)
    public function getTypeUser()
    {
        return $this->typeuser;
    }

    public function setTypeUser($typeuser)
    {
        $this->typeuser = $typeuser;
    }

    // Getter and Setter for authorname
    public function getAuthorName()
    {
        return $this->authorname;
    }

    public function setAuthorName($authorname)
    {
        $this->authorname = $authorname;
    }

    // Getter and Setter for typepost (discussion, question)
    public function getTypePost()
    {
        return $this->typepost;
    }

    public function setTypePost($typepost)
    {
        $this->typepost = $typepost;
    }

    // Getter and Setter for titleP
    public function getTitle()
    {
        return $this->titleP;
    }

    public function setTitle($titleP)
    {
        $this->titleP = $titleP;
    }

    // Getter and Setter for contentP
    public function getContent()
    {
        return $this->contentP;
    }

    public function setContent($contentP)
    {
        $this->contentP = $contentP;
    }

    // Getter and Setter for createDateP
    public function getCreateDate()
    {
        return $this->createDateP;
    }

    public function setCreateDate($createDateP)
    {
        $this->createDateP = $createDateP;
    }

    // Getter and Setter for updateDateP
    public function getUpdateDate()
    {
        return $this->updateDateP;
    }

    public function setUpdateDate($updateDateP)
    {
        $this->updateDateP = $updateDateP;
    }

    // Getter and Setter for nbviewsp
    public function getNbViews()
    {
        return $this->nbviewsp;
    }

    public function setNbViews($nbviewsp)
    {
        $this->nbviewsp = $nbviewsp;
    }

    // Getter and Setter for nblikesp
    public function getNbLikes()
    {
        return $this->nblikesp;
    }

    public function setNbLikes($nblikesp)
    {
        $this->nblikesp = $nblikesp;
    }

    // Getter and Setter for Id_User (foreign key)
    public function getIdUser()
    {
        return $this->Id_UserP;
    }

    public function setIdUser($Id_UserP)
    {
        $this->Id_UserP = $Id_UserP;
    }
}

?>
