<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $username;
        private $email;
        private $registerdate;
        private $roles;
        private $avatar;
        private $connected;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        public function getId() {
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getUsername(){
            return ucfirst($this->username);
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getEmail()
        {
                return $this->email;
        }
 
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        public function getRegisterdate($format = null)
        {
            $format = ($format) ? $format : "Y/m/d";
            $formattedDate = $this->registerdate->format($format);
            return $formattedDate;
        }

        public function setRegisterdate($registerdate)
        {
            $this->registerdate = new \DateTime($registerdate);

            return $this;
        }

        public function getRoles()
        {
            return $this->roles;
        }

        public function setRoles($roles)
        {
            if($roles == null){
                $this->roles[] = "ROLE_USER";
            }
            else $this->roles = json_decode($roles);

            return $this;
        }

        public function hasRole($role)
        {
            // var_dump($role);die;
            return in_array($role, $this->roles);
        }

        /**
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

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
