<?php
    namespace Model\Entities;

    use App\Entity;

    final class Membre extends Entity{

        private $id;
        private $pseudo;
        // private $password;
        private $connected;

        public function __construct($data){ 
        //     var_dump($data);die;      
            $this->hydrate($data);        
        }

       

        

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
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
         * Get the value of connected
         */ 
        public function getConnected()
        {
                return $this->connected;
        }

        /**
         * Set the value of connected
         *
         * @return  self
         */ 
        public function setConnected($connected)
        {
                $this->connected = $connected;

                return $this;
        }
    }
