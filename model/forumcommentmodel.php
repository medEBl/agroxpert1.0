<?php

class ForumComment
{
    private $idcommentp; // primary key of forumcomment
    private $contentC; // content of the comment
    private $createDateC; // creation date of the comment
    private $updateDateC; // last update date of the comment
    private $AuthoridC; // foreign key to id user, supposed to be 1
    private $authorname; // author's name
    private $emoji;
    private $idpostc; // foreign key to forumpost, references the post that the comment is associated with

    // Setter for idcommentp
    public function setIdcommentp($idcommentp)
    {
        $this->idcommentp = $idcommentp;
    }

    // Getter for idcommentp
    public function getIdcommentp()
    {
        return $this->idcommentp;
    }

    // Setter for contentC
    public function setContentC($contentC)
    {
        $this->contentC = $contentC;
    }

    // Getter for contentC
    public function getContentC()
    {
        return $this->contentC;
    }

    // Setter for createDateC
    public function setCreateDateC($createDateC)
    {
        $this->createDateC = $createDateC;
    }

    // Getter for createDateC
    public function getCreateDateC()
    {
        return $this->createDateC;
    }

    // Setter for updateDateC
    public function setUpdateDateC($updateDateC)
    {
        $this->updateDateC = $updateDateC;
    }

    // Getter for updateDateC
    public function getUpdateDateC()
    {
        return $this->updateDateC;
    }

    // Setter for AuthoridC
    public function setAuthoridC($AuthoridC)
    {
        $this->AuthoridC = $AuthoridC;
    }

    // Getter for AuthoridC
    public function getAuthoridC()
    {
        return $this->AuthoridC;
    }

    // Setter for authorname
    public function setAuthorname($authorname)
    {
        $this->authorname = $authorname;
    }

    // Getter for authorname
    public function getAuthorname()
    {
        return $this->authorname;
    }

   

    // Setter for idpostc
    public function setIdpostc($idpostc)
    {
        $this->idpostc = $idpostc;
    }

    // Getter for idpostc
    public function getIdpostc()
    {
        return $this->idpostc;
    }
    public function setEmoji($emoji)
    {
        $this->emoji = $emoji;
    }

    // Getter for emoji
    public function getEmoji()
    {
        return $this->emoji;
    }
}
?>
