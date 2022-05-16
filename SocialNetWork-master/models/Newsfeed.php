<?php
require_once 'configs/db.php';
class Newsfeed
{
    private $UserID;

    function __construct($UserID)
    {
        $this->UserID = $UserID;
    }
    public function index()
    {
        $connection = $this->connectDb();
        $querySelect = "SELECT * FROM post";
        $results = mysqli_query($connection, $querySelect);
        $posts = [];
        if (mysqli_num_rows($results) > 0) {
            $posts = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        $this->closeDb($connection);

        return $posts;
    }
    public function getName()
    {
        $connection = $this->connectDb();
        $sql_user_ava = "SELECT CONCAT(UserFirstName, ' ', UserLastName) as UserName, UserAva FROM user_profile WHERE UserID =  '" . $this->UserID . "'";
        $result_user_ava = mysqli_query($connection, $sql_user_ava);
        $names = [];
        if (mysqli_num_rows($result_user_ava) > 0) {
            $names = mysqli_fetch_all($result_user_ava, MYSQLI_ASSOC);
        }
        $this->closeDb($connection);
        return $names;
    }
    public function getPost()
    {
        $connection = $this->connectDb();
        $sql = "SELECT PostID, Bang.UserID, UserName, PostCaption, PostTime, UserAva
                    from user_profile,
                        (SELECT *
                        FROM friend_ship INNER JOIN view_post
                        on UserID = User1ID or UserID = User2ID
                        WHERE (User1ID = '" . $this->UserID . "' or User2ID = '" . $this->UserID . "') AND Active = 1) as Bang
                    WHERE Bang.UserID != '" . $this->UserID . "' AND Bang.UserID = user_profile.UserID
                    ORDER BY PostTime DESC";                   //Người đăng nhập-->
        $result_news = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result_news) > 0) {
            $this->closeDb($connection);
            return mysqli_fetch_all($result_news, MYSQLI_ASSOC);
        }
    }
    public function getImgPost($postId)
    {
        $connection = $this->connectDb();
        $sql_img_content = "SELECT * FROM images INNER JOIN post ON post.PostID = images.PostID WHERE post.PostID=" . $postId;
        $result_img_content = mysqli_query($connection, $sql_img_content);
        if (mysqli_num_rows($result_img_content) > 0) {
            $this->closeDb($connection);
            return mysqli_fetch_all($result_img_content, MYSQLI_ASSOC);
        }
    }
    public function countComment($postId)
    {
        $connection = $this->connectDb();
        $sql_count_comment = "SELECT count(CommentID) FROM comment where PostID=" . $postId;
        $result_count_comment = mysqli_query($connection, $sql_count_comment);
        $this->closeDb($connection);
        return mysqli_fetch_all($result_count_comment, MYSQLI_ASSOC);
    }
    public function getComment($postId)
    {
        $connection = $this->connectDb();
        $sql_comment = "SELECT * from view_comment WHERE PostID =" . $postId;
        $result_comment = mysqli_query($connection, $sql_comment);
        if (mysqli_num_rows($result_comment) > 0) {
            $this->closeDb($connection);
            return mysqli_fetch_all($result_comment, MYSQLI_ASSOC);
        }
    }
    
    public function addComment($arrComment){
        $connection = $this->connectDb();
        $sql_comment = "INSERT INTO comment(PostID, UserID, CommentContent)
                        VALUES('{$arrComment['postID']}', '{$arrComment['userID']}', '{$arrComment['content']}')";
        $result = mysqli_query($connection, $sql_comment);
        $this->closeDb($connection);
        return $result;
    }
    public function editComment($arrComment){
        $connection = $this->connectDb();
        $sql = "UPDATE comment SET CommentContent='{$arrComment['content']}' WHERE CommentID='{$arrComment['commentID']}'";
        $result = mysqli_query($connection, $sql);
        $this->closeDb($connection);
        return $result;
    }
    public function deleteComment($commentID){
        $connection = $this->connectDb();
        $sql = "DELETE FROM comment WHERE CommentID = $commentID";
        $result = mysqli_query($connection, $sql);
        $this->closeDb($connection);
        return $result;
    }
    
    public function report($postId, $PostUserID){
        $connection = $this->connectDb();
        $sql_report_post = "UPDATE post SET Reported = 1 WHERE PostID = $postId";
        $sql_report_user = "UPDATE user_profile SET  Reported = Reported + 1 WHERE UserID = $PostUserID";
        $KQ1= mysqli_query($connection, $sql_report_post);
        $KQ2= mysqli_query($connection, $sql_report_user);
        $this->closeDb($connection);
        return ($KQ1 && $KQ2);
    }

    public function getLikeModel($postid) {
        $connection = $this->connectDb();
        $sql = "SELECT COUNT(PostID) from like_action where PostID= $postid and UserID= $this->UserID";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $islike = (mysqli_fetch_assoc($result)['COUNT(PostID)']==1);
            $this->closeDb($connection);
            return $islike;
        }
    }

    public function likeProcess ($postId) {
        $isLiked = $this->getLikeModel($postId);
        $connection = $this->connectDb();
        if($isLiked) {
            $sql = "DELETE from like_action where PostID= $postId and UserID= $this->UserID";
            $result = mysqli_query($connection, $sql);
        } else {
            $sql1 = "INSERT into like_action (PostID, UserID) values(" .$postId. ", ".$this->UserID.")";
            $result = mysqli_query($connection, $sql1);
        }

        $this->closeDb($connection);
    }

    public function getLikeNumber($postid) {
        $connection = $this->connectDb();
        $sql = "SELECT COUNT(PostID) from like_action where PostID= $postid";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $likeNumber = (mysqli_fetch_assoc($result)['COUNT(PostID)']);
            $this->closeDb($connection);
            return $likeNumber;
        }
    }

    public function connectDb()
    {
        $connection = mysqli_connect(
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_NAME
        );
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " . mysqli_connect_error());
        }

        return $connection;
    }
    public function closeDb($connection = null)
    {
        mysqli_close($connection);
    }
}
