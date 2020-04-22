<?php
    namespace Model\Entities;

    use App\Entity;

    final class Appartient extends Entity{

        
        private $membre;
        private $groupe;
    

        public function __construct($data){ 
        //     var_dump($data);die;      
            $this->hydrate($data);        
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
         * Get the value of groupe
         */ 
        public function getGroupe()
        {
                return $this->groupe;
        }

        /**
         * Set the value of groupe
         *
         * @return  self
         */ 
        public function setGroupe($groupe)
        {
                $this->groupe = $groupe;

                return $this;
        }
    }
