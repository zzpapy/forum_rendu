<?php
    namespace Model\Entities;

    use App\Entity;

    final class Groupe extends Entity{

        private $id;
        private $nom;
        private $membre;
    

        public function __construct($data){ 
        //     var_dump($data);die;      
            $this->hydrate($data);        
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
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

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
    }
