<?php
    namespace Model\Entities;

    use App\Entity;
use DateTime;

final class Post extends Entity{

        private $id;
        private $content;
        private $user;
        private $topic;
        private $creationdate;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        public function getId() {
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        

        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
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
         * Get the value of topic
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of topic
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }

        /**
         * Get the value of creationdate
         */ 
        public function getCreationdate()
        {
                $date = new \DateTime($this->creationdate);
                $date = date_format($date,'d-m-Y H:i:s');
                return $date;
        }
       
        /**
         * Set the value of creationdate
         *
         * @return  self
         */ 
        public function setCreationdate($creationdate)
        {
                $this->creationdate = $creationdate;

                return $this;
        }
    }
