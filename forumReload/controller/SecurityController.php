<?php
    namespace Controller;

    use App\Session;
    use Model\Managers\UserManager;
    use App\AbstractController;
    use App\Upload;
    
    class SecurityController extends AbstractController{

        public function index(){

            return $this->login();
        }
        
        public function login(){
            if(!empty($_POST)){

                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $pass = filter_input(INPUT_POST, "pass", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{6,32}/')
                    )
                );

                if($email && $pass){
                    $manager = new UserManager();
                    $dbPass = $manager->retrievePassword($email);
                    if(password_verify($pass, $dbPass)){
                        
                        $user = $manager->findByEmail($email);
                        $manager->connection($user->getId(),'1');
                        Session::setUser($user);
                        Session::setAuthor($user);
                        Session::addFlash("success", "Vous êtes connectés, bienvenue !");
                        $this->redirectTo("topics");
                    }
                    else{
                        Session::addFlash("error", "Le mot de passe est faux !");
                    } 
                }
                else{
                    Session::addFlash("error", "L'email ou le mot de passe sont manquants.");
                }
            }
            return [
                "view" => VIEW_DIR."login.php"
            ];
        }
        
        public function register(){
            if(!empty($_POST)){
                if($_FILES["avatar"]["name"] != ''){
                    $avatar = $this->upload($_FILES);
                    $_POST["avatar"] = $avatar;
                }
                // var_dump($_FILES);die;
                $username = filter_input(INPUT_POST, "username", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{4,}/')
                    )
                );
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $pass = filter_input(INPUT_POST, "pass", FILTER_VALIDATE_REGEXP,
                    array(
                        "options" => array("regexp"=>'/[A-Za-z0-9]{6,32}/')
                    )
                );
                $passrepeat = filter_input(INPUT_POST, "pass-r", FILTER_SANITIZE_STRING);

                if($username && $email){
                    if($pass){
                        if($pass === $passrepeat){
                            //embeter la base de données
                            $manager = new UserManager();

                            if($manager->checkUserExists($email) == 0){
                                $user = [
                                    "username" => strtolower($username),
                                    "email"    => $email,
                                    "password" => password_hash($pass, PASSWORD_ARGON2I),
                                    "roles"    => json_encode(["ROLE_USER"]),
                                    "avatar"   => $_POST["avatar"]
                                ];
                                $manager->add($user); 
                                Session::addFlash("success", "Inscription réussie, connectez-vous !");
                                $this->redirectTo("security", "login");
                            }
                            else{
                                Session::addFlash("error", "Cet e-mail existe déjà !");
                            }
                        }
                        else{
                            Session::addFlash("error", "Les deux mots de passe ne correspondent pas.");
                        }
                    }
                    else{
                        Session::addFlash("error", "Le mot de passe est invalide.");
                    }
                }
                else{
                    Session::addFlash("error", "Le pseudo ou l'email sont vides.");
                }
            }
            return [
                "view" => VIEW_DIR."register.php"
            ];
        }
        
        public function logout(){
            $manager = new UserManager();
            $user = $manager->findOneById(Session::getAuthor());
            $manager->connection(Session::getAuthor(),'0');
            Session::setUser(null);
            Session::addFlash("success", "A bientôt !");
            $this->redirectTo("security", "login");
        }
        public function upload($avatar){
            // if(isset($_FILES) && !empty($_FILES["fileToUpload"]["name"])){
               
                $up = Upload::uploadFile("avatar",$_FILES["avatar"]["name"],"public/img/");
                $avatar = "public/img/".$up;
                // var_dump($photo);die;
            // }
            
            return $avatar;
        }
    }
