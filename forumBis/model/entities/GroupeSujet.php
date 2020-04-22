<?php
    namespace Model\Entities;

    use App\Entity;

    final class Groupe_sujet extends Entity{

       
        private $sujet;
        private $groupe;
    

        public function __construct($data){ 
        //     var_dump($data);die;      
            $this->hydrate($data);        
        }

        

        /**
         * Get the value of sujet
         */ 
        public function getSujet()
        {
                return $this->sujet;
        }

        /**
         * Set the value of sujet
         *
         * @return  self
         */ 
        public function setSujet($sujet)
        {
                $this->sujet = $sujet;

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
