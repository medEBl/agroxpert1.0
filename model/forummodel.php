<?php

class ForumPost
{
    private $idpost;
    private $titleP;
    private $contentP;
    private $createDateP;
    private $Id_User;

    public function __construct($idpost = null, $titleP = null, $contentP = null, $createDateP = null, $Id_User = null)
    {
        $this->idpost = $idpost;
        $this->titleP = $titleP;
        $this->contentP = $contentP;
        $this->createDateP = $createDateP;
        $this->Id_User = $Id_User;
    }

    public function getId()
    {
        return $this->idpost;
    }

    public function setId($idpost)
    {
        $this->idpost = $idpost;
    }

    public function getTitle()
    {
        return $this->titleP;
    }

    public function setTitle($titleP)
    {
        $this->titleP = $titleP;
    }

    public function getContent()
    {
        return $this->contentP;
    }

    public function setContent($contentP)
    {
        $this->contentP = $contentP;
    }

    public function getCreateDate()
    {
        return $this->createDateP;
    }

    public function setCreateDate($createDateP)
    {
        $this->createDateP = $createDateP;
    }

    public function getIdUser()
    {
        return $this->Id_User;
    }

    public function setIdUser($Id_User)
    {
        $this->Id_User = $Id_User;
    }
}
