<?php 
namespace Model\Entities;

use App\Entity;

final class Sujet extends Entity{

    private $id;
    private $titre;
    private $membre;
    private $date;
    private $photo;
    private $close;

    public function __construct($data){  
        $this->hydrate($data);        
        // var_dump($data,$this);die;      
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of membre
     */ 
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Set the value of membre
     *
     * @return  self
     */ 
    public function setMembre($membre)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of close
     */ 
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Set the value of close
     *
     * @return  self
     */ 
    public function setClose($close)
    {
        $this->close = $close;

        return $this;
    }
}

?>