<<<<<<< HEAD
=======
<?php
    require_once 'models/Newsfeed.php';
    class NewsfeedController {
        public function index() {
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            $row_user_ava = $Newsfeed->getName(); 
            $posts = $Newsfeed->getPost();
            
            require_once "views/newsfeed/index.php";
        }
        public function addComment(){
            //add cmt
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            if (isset($_POST["btn-comment"])&& $_POST['txt-comment']){
                $UserCommentID = $_POST["UserID"];
                $PostID = $_POST["PostID"];
                $CommentContent = $_POST["txt-comment"];
                $arrComment = [
                    'userID' => $UserCommentID,
                    'postID' => $PostID,
                    'content' => $CommentContent
                ];
                $NewsfeedAddComment = $Newsfeed->addComment($arrComment);
            }
            header('location: index.php?controller=Newsfeed&action=index');
        }
        public function editComment(){
            //edit cmt
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            if (isset($_POST["btn-edit"])&& $_POST['txt-edit']){
                $CommentID = $_POST["CommentID"];
                $CommentContent = $_POST["txt-edit"];
                $arrComment = [
                    'commentID' => $CommentID,
                    'content' => $CommentContent
                ];
                $NewsfeedAddComment = $Newsfeed->editComment($arrComment);
            }
            header('location: index.php?controller=Newsfeed&action=index');
        }
        public function deleteComment(){
            //delete cmt
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            $commentID = $_GET['CommentID'];
            $NewsfeedAddComment = $Newsfeed->deleteComment($commentID);
            header('location: index.php?controller=Newsfeed&action=index');
        }

        public function reportPost() {
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            $PostID = $_GET['PostID'];
            $PostUserId = $_GET['PostUserID'];
            $isReported = $Newsfeed->report($PostID, $PostUserId);
            if ($isReported){
                header('location: index.php?controller=Newsfeed&action=index');
            }
            else {
                $error = "Report thất bại";
                header("location: views/templates/404page.php?error=$error");
            }
        }
        public function likeProcess() {
            $UserID = $_SESSION['isLoginOk'];
            $Newsfeed = new Newsfeed($UserID);
            $PostID = $_GET['PostID'];
            $Newsfeed->likeProcess($PostID);
            header("location: index.php?controller=newsfeed&action=index");
        }
    }
?>
>>>>>>> 7776eef44b7d53de0f7e3753e57832b0542b839b
