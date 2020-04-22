<?php
    namespace Controller;

    use App\Session;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CommentManager;
    use Model\Managers\SignalementManager;
    use App\AbstractController;
    
    class ForumController extends AbstractController{

        public function index(){
            if(Session::authenticationRequired()){
                $topicManager = new TopicManager();
                $topics = $topicManager->findAll(["creationdate","DESC"]);

                return [
                    "view" => VIEW_DIR."topics.php",
                    "data" => ["topics" => $topics]
                ];
            }
            else $this->redirectTo("security", "login");
        }

        public function topics(){
            $topicManager = new TopicManager();
            $topics = $topicManager->findAll(["creationdate","DESC"]);
            // var_dump($topic);die;
            return [
                "view" => VIEW_DIR."topics.php",
                "data" => ["topics" => $topics]
            ];
           
            
        }
        public function modifMess(){
            $postManager = new PostManager();
            $post = $postManager->findOneById($_POST["id_post"]);
            return [
                "view" => VIEW_DIR."modifPost.php",
                "data" =>  $post
            ];
            var_dump($_POST);die;

        }
        public function modif(){
            // var_dump($_POST);die;
            $postManager = new PostManager();
            $post = $postManager->modif($_GET["id"]);
            $this->redirectTo("forum", "viewTopic",$_POST["topic_id"]);
        }
        public function viewTopic($id,$idPost = null){
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id,["creationdate","ASC"]);
            if(isset($_GET["idPost"])){
                $idPost = $_GET["idPost"];
                $postManager = new PostManager();
                $post = $postManager->findOneById($idPost);
                if(!empty($_POST)){
                    
                    $post = $postManager->modif($idPost);
                    // var_dump($post);die;
                    $this->redirectTo("forum", "viewTopic",$id);
                }
                // $postManager = new PostManager();
                // $post = $postManager->modif($_GET["idPost"]);
            }
            if($topic){
                $postManager = new PostManager();
                $posts = $postManager->findBytopic($id);
                // var_dump($posts);die;
                $commentManager = new CommentManager();
                $tabComment = [];
                if($posts){
                    foreach ($posts as  $post) {
                        $tabComment[$post->getId()] = $commentManager->findByPost($post->getId());
                    }
                }
                return [
                    "view" => VIEW_DIR."viewTopic.php",
                    "data" => [
                        "topics" => $topic,
                        "posts" => $posts,
                        "comments" => $tabComment,
                        "modifPost" => $post
                         ]
                ];
            }
            else{
                $msg = "pas bien !!!";
                Session::addFlash("error",$msg);
                $this->redirectTo("forum","topics");
            }
           
            
        }
        public function creaTopic(){
            if(isset($_POST["title"])){
                $id_user = Session::getUser()->getId();
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                $tab = ["title" => $title,"user_id" => $id_user];
                $topicManager = new TopicManager();
                $topic = $topicManager->add($tab);
                $idTopic = $topic;
                $content = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
                $postManager = new PostManager();
                $tab = ["content"=>$content,"user_id"=>$id_user,"topic_id"=>$topic];
                $post = $postManager->add($tab);
                $msg = "Votre sujet a bien été créé !!!";
                Session::addFlash("success",$msg);
                $this->redirectTo("forum","viewTopic",$idTopic);
            }
            else{
                return [
                    "view" => VIEW_DIR."creaTopic.php",
                    "data" => ""
                ];
            }          
        }

        public function closeTopic($id){
            $topicManager = new TopicManager();
            $author = $topicManager->isAuthor($_POST["user_id"]);
            $topic = $topicManager->findOneById($id);
            $sessionUserId = Session::getAuthor();
            $closed = $topic->getClosed();
            $closed = $closed == 1 ? $closed = 0 : $closed = 1;
            if($author === $sessionUserId && $sessionUserId == $_POST["user_id"] || Session::isAdmin()){
                $topicManager = new TopicManager();
                $closTopic = $topicManager->closeTopic($id,$closed);
                if($closed == 1){
                    $msg = "Le sujet a  été cloturé.";
                    Session::addFlash("success",$msg);
                }
                else{
                    $msg = "Le sujet a  été réouvert.";
                    Session::addFlash("success",$msg);
                }
            }
            else{
                $msg = "c'est pas bien !!!";
                Session::addFlash("error",$msg);
            }
            $this->redirectTo("forum","viewTopic",$id);
        }

        public function closed(){
            $msg = "Le sujet a  été cloturé.";
            Session::addFlash("success",$msg);
            $this->redirectTo("forum","topics");
        }
        public function deleteTopic($id){
            $topicManager = new TopicManager();
            $author = $topicManager->isAuthor($_POST["user_id"]);
            $topic = $topicManager->findOneById($id);
            $sessionUserId = Session::getAuthor();
            $closed = $topic->getClosed();
            $closed = $closed == 1 ? $closed = 0 : $closed = 1;
            if($author === $sessionUserId && $sessionUserId == $_POST["user_id"] || Session::isAdmin()){
                $closTopic = $topicManager->delete($_POST["topic_id"]);
                $msg = "Le sujet a  supprimer.";
                Session::addFlash("success",$msg);
                $this->redirectTo("forum","topics");
            }
            else{
                $msg = "ciest pas bien !!!";
                Session::addFlash("error",$msg);
                $this->redirectTo("forum","topics");
            }
        }
        public function creaPost($id){
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);
            $closed = $topic->getClosed();
            if(isset($_POST["content"]) && $closed != 1){
                $id_user = Session::getUser()->getId();
                // var_dump($_POST);die;
               
                $idTopic = $id;
                $content = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
                $postManager = new PostManager();
                $tab = ["content"=>$content,"user_id"=>$id_user,"topic_id"=>$id];
                $post = $postManager->add($tab);
                $msg = "Votre message a bien été créé !!!";
                Session::addFlash("success",$msg);
                $this->redirectTo("forum","viewTopic",$id);
            }
            else{
                $msg = "une erreure est survenue";
                Session::addFlash("error",$msg);
                $this->redirectTo("forum","viewTopic",$id);
                return [
                    "view" => VIEW_DIR."creaTopic.php",
                    "data" => ""
                ];
            }
        }

        public function creaComment($id){
            if(isset($_POST["content"])){
                // var_dump(Session::getUser());die;
                $id_user = Session::getUser()->getId();
               
                $idTopic = $id;
                $content = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
                $postManager = new CommentManager();
                $tab = ["content"=>$content,"user_id"=>$id_user,"post_id"=>$id];
                $post = $postManager->add($tab);
                $msg = "Votre commentaire a bien été créé !!!";
                Session::addFlash("success",$msg);
                $this->redirectTo("forum","viewTopic",$_POST["topic_id"]);
            }
            else{
                return [
                    "view" => VIEW_DIR."creaTopic.php",
                    "data" => ""
                ];
            }
        }

        public function signal(){
            // var_dump($_POST);die;
            if(Session::getUser()){
            unset($_POST["submit_x"]);
            unset($_POST["submit_y"]);
            $id = $_POST["topic_id"];
            unset($_POST["topic_id"]);
            $signalManager = new SignalementManager();
            $signal = $signalManager->signal($_POST);
            $msg = "Votre signalement sera étudié dans les plus brefs délais.";
            Session::addFlash("success",$msg);
            $this->redirectTo("forum", "viewTopic",$id);
            }
            else $this->redirectTo("forum", "topics");
        }
        public function signalement(){
            $signalManager = new SignalementManager();
            $signals = $signalManager->findAll();
            if(Session::isAdmin() == Session::getuser()->getId())
            return [
                "view" => VIEW_DIR."signalement.php",
                "data" => ["signals" => $signals]
            ];
            else{
                $msg = "C'est pas bien !!!";
                Session::addFlash("errore",$msg);
                $this->redirectTo("forum", "topcic");
            }
        }

        public function delSignal(){
            // var_dump($_POST);die;
            $signalManager = new SignalementManager();
            $postSignal = $signalManager->delete($_POST["post_id"]);
            $signals = $signalManager->findAll();
            $postManager = new PostManager();
            $postSignal = $postManager->delete($_POST["post_id"]);

            return [
                "view" => VIEW_DIR."signalement.php",
                "data" => ["signals" => $signals]
            ];
            var_dump($signals);die;
        }
        public function deleteMess(){
            $postManager = new PostManager();
            $postSignal = $postManager->delete($_POST["id_post"]);
            $this->redirectTo("forum", "viewTopic",$_POST["topic_id"]);
        }
       
       

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
