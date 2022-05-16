<!--MAIN-->
<main class="container" >
    <!--MAIN-NEW-FEED-->
    <div class="row">

        <div class="col-md-9" id="main-news-feed " style="margin-left: 10%">
      
           
            <!--News-->
            <?php
            if ($posts)
                foreach ($posts as $row_news) {
            ?>
            <div class="news <?php echo $row_news['PostID'] ?>">
                <div class="row">
                    <div class="heading">
                        <a class="user-ava"
                            href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_news['UserID']; ?>">
                            <img class="user-ava" src="<?php echo ($row_news['UserAva']); ?>" alt="">
                        </a>
                        <div class="user-name-time">
                            <a href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_news['UserID']; ?>"
                                class="user-name text-decoration-none link-dark">
                                <b><?php echo $row_news['UserName'] ?></b>
                            </a>
                            <h6 class="time">
                                <?php echo $row_news['PostTime'] ?>
                            </h6>
                        </div>
                        <div class="option ms-auto">
                            <div class="option-icon collapsibleOption">
                                <span class="material-icons-outlined" style="position: absolute;">
                                    more_horiz
                                </span>
                            </div>
                            <div class="collapse contentOption">
                                <div class="option-item">
                                 
                                    <a class="col-md-12 items link-dark"
                                        href="index.php?controller=newsfeed&action=reportPost&PostID=<?php echo $row_news['PostID']; ?>&PostUserID=<?php echo $row_news['UserID']; ?>">
                                        <span class="material-icons-outlined">report</span>
                                        <b>Báo cáo bài viết</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="content-caption">
                            <?php echo $row_news['PostCaption'] ?>
                        </div>
                        <div class="content-images">
                            <?php
                                if ($Newsfeed->getImgPost($row_news['PostID']))
                                    foreach ($Newsfeed->getImgPost($row_news['PostID']) as $row_img_content) {
                                ?>
                            <img src="<?php echo $row_img_content['images']; ?>" alt=""
                                onclick="clickImg('<?php echo $row_img_content['images']; ?>')">
                            <?php
                                    }
                                ?>
                        </div>
                    </div>
                    <div class="action-comment">
                        <div class="action-comment-above">
                            <div class="action-index">
                                <span class="material-icons-round">
                                    emoji_emotions
                                </span>
                                <div class="share-index-item">
                                    <?php echo $Newsfeed->getLikeNumber($row_news['PostID']); ?>
                                    lượt like
                                </div>
                            </div>
                            <!-- //ĐẾM LƯỢT BÌNH LUÂN -->
                            <div class="comment-index">

                                <?php
                                    foreach ($Newsfeed->countComment($row_news['PostID']) as $comment) {
                                    ?>
                                <div class="comment-index-item" data-bs-toggle="collapse"
                                    data-bs-target="#collapseWidthExample" aria-expanded="false"
                                    aria-controls="collapseWidthExample">
                                    <?php echo $comment['count(CommentID)']; ?> bình luận
                                </div>
                                <?php
                                    }
                                    ?>
                               
                            </div>
                        </div>
                        <div class="action-comment-under">
                            <?php
                                if ($Newsfeed->getLikeModel($row_news['PostID'])) {
    
                                ?>
                            <a class="action-comment-under-item text-decoration-none"
                                href="index.php?controller=newsfeed&action=likeProcess&PostID=<?php echo $row_news['PostID'] ?>"
                                style="">
                                <div class="action-icon">
                                    <span class="material-icons">
                                        thumb_up
                                    </span>

                                </div>
                                <div class="action-name">
                                    <h6>Thích</h6>
                                </div>
                            </a>
                            <?php } else {
    
                                ?>
                            <a class="action-comment-under-item text-decoration-none text-muted"
                                href="index.php?controller=newsfeed&action=likeProcess&PostID=<?php echo $row_news['PostID'] ?>"
                                style="">
                                <div class="action-icon">
                                    <span class="material-icons">
                                        thumb_up
                                    </span>

                                </div>
                                <div class="action-name">
                                    <h6>Thích</h6>
                                </div>
                            </a>

                            <?php  } ?>
                            <div class="action-comment-under-item btn-comment">
                                <div class="action-icon">
                                    <span class="material-icons-outlined comment-icon">
                                        chat_bubble_outline
                                    </span>
                                </div>
                                <div class="action-name <?php echo $row_news['PostID'] ?>">
                                    <h6>Bình luận</h6>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <!--COMMENT INPUT-->
                    <div class="row">
                        <form id="comment-form" action="index.php?controller=newsfeed&action=addComment" method="post"
                            autocomplete="off">
                            <div class="col-md-12 comment-input-form">
                                <?php
                                    foreach ($row_user_ava as $user_ava) {
                                    ?>
                                <a class="icon" href="index.php?controller=profile&action=index">
                                    <img class="user-ava" src="<?php echo ($user_ava['UserAva']); ?>" alt="">
                                </a>
                                <?php
                                    }
                                    ?>
                                <input class="ID" type="text" value="<?php echo $row_news['PostID']; ?>" name="PostID">
                                <input class="ID" type="text" value="<?php echo $UserID; ?>" name="UserID">
                                <!--Người đăng nhập-->
                                <div class="comment-input">
                                    <input id="comment-input" name="txt-comment" type="text"
                                        placeholder=" Viết bình luận" class="form-control">
                                </div>
                                <button id="send-comment" name="btn-comment" type="submit" style="display: none">
                                    <span class="material-icons-round send-icon">
                                        reply
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!--COMMENTS-->
                    <ul class="comments <?php echo $row_news['PostID'] ?>" style="display:none">
                        <?php
                            //TRUY VẤN COMMENT, COMMENT_USER
                            if ($Newsfeed->getComment($row_news['PostID']))
                                foreach ($Newsfeed->getComment($row_news['PostID']) as $row_comment) {
                                    if ($row_comment['UserID'] == $UserID) {
                            ?>
                        <!--COMMENT OF USER LOGIN-->
                        <li class="comment-item myDIV">
                            <a class="icon" href="index.php?controller=profile&action=index">
                                <img class="user-ava" src="<?php echo ($row_comment['UserAva']); ?>" alt="">
                            </a>
                            <div class="commentator-name">
                                <a href="index.php?controller=profile&action=index"
                                    class="user-name text-decoration-none link-dark">
                                    <b><?php echo $row_comment['UserName']; ?></b>
                                </a>
                                <p class="comment-content">
                                    <?php echo $row_comment['CommentContent']; ?>
                                </p>
                            </div>
                            <!--EDIT COMMENT-->
                        
                        </li>
                        <?php
                                    } else {
                                ?>
                        <!--COMMENT OF USER FRIEND-->
                        <li class="comment-item myDIV">
                            <a class="icon"
                                href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_comment['UserID']; ?>">
                                <img class="user-ava" src="<?php echo ($row_comment['UserAva']); ?>" alt="">
                            </a>
                            <div class="commentator-name">
                                <a href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_comment['UserID']; ?>"
                                    class="user-name text-decoration-none link-dark">
                                    <b><?php echo $row_comment['UserName']; ?></b>
                                </a>
                                <p class="comment-content">
                                    <?php echo $row_comment['CommentContent']; ?>
                                </p>
                            </div>
                        </li>

                        <?php
                                    }
                                }
                            ?>
                    </ul>
                </div>


            </div>
            <?php
                }
            ?>
        </div>
        <!--THINKING POST-->
        <div class="col-md-9 mb-4 mb-md-0 thinking-post">
            <div class="modal fade" id="buttonModalUserPost" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form id="post-form" action="index.php?controller=newsfeed&action=addPost" method="post"
                        autocomplete="off" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <strong>Tạo bài viết</strong>
                                </h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <input type="text" name="UserID" value="<?php echo $UserID ?>" hidden>
                            <textarea id="post-writing" cols="50" rows="5" class="modal-body"
                                placeholder="Hãy viết gì đó..." name="txt-content"></textarea>
                            <div class="displayImg">
                                <div class="mb-3 p-2">
                                    <label for="formFileMultiple" class="form-label">Chọn ảnh của bạn</label>
                                    <input class="form-control" type="file" id="formFileMultiple" name="myFile">
                                    <!-- <input class="form-control" type="file" id="formFileMultiple" name="myFile" multiple> -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary" name="btn-sendPost">
                                    Lưu
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!--RIGHT-SIDE-BAR-->
        
    </div>
</main>
<script>
function clickImg(link) {
    window.open(link, "_blank");
}
</script>
<style>
    .d-flex{
        margin-top:12px;
    }
</style>