<?php
    namespace Controller;

    use App\Session;
    use App\Upload;
    use Model\Managers\UserManager;
    use App\AbstractController;
    
    class HomeController extends AbstractController{

        public function index(){
            if(Session::authenticationRequired()){
                $this->redirectTo("forum","topics");
            }
            else $this->redirectTo("security", "login");
        }

        public function users(){
            if(Session::isAdmin()){
                $manager = new UserManager();
                $users = $manager->findAll(['registerdate', "ASC"]);

                return [
                    "view" => VIEW_DIR."users.php",
                    "data" => [
                        "users" => $users
                    ]
                ];
            }
            else{
                $this->redirectTo();
            } 
            
        }
        public function profile(){
            if(Session::getUser()){
                $user = Session::getUser();
               
                return [
                    "view" => VIEW_DIR."profile.php",
                    "data" => [
                        "users" => $user
                    ]
                ];
            }
            else{
                $this->redirectTo();
            } 
            
        }
        public function modifAvatar($id){
            if($_FILES["avatar"]["name"] != ''){
                if(Session::getAuthor() == $id){
                    $avatar = $this->upload($_FILES);
                    $_POST["avatar"] = $avatar;
                    $manager = new UserManager($id,$avatar);
                    $manager->modifAvatar($id,$avatar);
                    $user = $manager->findOneById($id);
                    Session::setUser($user);
                }
                else{
                    $msg = "c'est pas bien !!!";
                    Session::addFlash("error",$msg);

                }
            }
            $this->redirectTo("home","profile");
        }
        public function upload($avatar){
            $up = Upload::uploadFile("avatar",$_FILES["avatar"]["name"],"public/img/");
            $avatar = "public/img/".$up;
            
            return $avatar;
        }

        public function modifUserName($id){
            // var_dump($_POST);die;
        if(Session::getAuthor() == $id){
            $manager = new UserManager($id);
            $manager->modifUsername($id,$_POST["username"]);
            $user = $manager->findOneById($id);
            Session::setUser($user);
        }
        else{
            $msg = "c'est pas bien !!!";
            Session::addFlash("error",$msg);

        }
            
            $this->redirectTo("home","profile");
        }
       
        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
