<?php
    namespace Model\Entities;

    use App\Entity;

    final class Signalement extends Entity{

        private $user;
        private $post;
        private $creationdate;

        public function __construct($data){         
            $this->hydrate($data);        
        }
        
        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getCreationdate()
        {
                $date = new \DateTime($this->creationdate);
                $date = date_format($date,'d-m-Y H:i:s');
                return $date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setCreationdate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of post
         */ 
        public function getPost()
        {
                return $this->post;
        }

        /**
         * Set the value of post
         *
         * @return  self
         */ 
        public function setPost($post)
        {
                $this->post = $post;

                return $this;
        }
    }
