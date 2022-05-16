<main>
  <!-- Section: white bgg -->
  <section class="bg-white mb-4 shadow-2">
    <div class="container">
      <!-- Section: imagess -->
      <section class="mb-10">
        <!-- Background imagee -->
        <div class="p-5 text-center bg-image shadow-1-strong rounded-bottom" style="
                background-image: url('assets/images/sky.jpg');
                height: 250px;
              " onclick="clickImg('assets/images/sky.jpg')"></div>
        <?php
        foreach ($profileInfo as $row_ava) {
        ?>
          <div class="d-flex justify-content-center">
            <img src="<?php echo $row_ava['UserAva'] ?>" alt="" class="
          rounded-circle
          shadow-3-strong
          position-absolute
          border border-white
        " id="avatarImg" style="width: 180px;height:180px; margin-top: -60px" onclick="clickImg('<?php echo $row_ava['UserAva'] ?>')" />
          </div>
          <!-- Background imagee -->
      </section>
      <!-- Section: imagess -->

      <!-- Section: user dataa -->
      <section class="text-center border-bottom">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <h2><strong> <?php echo $row_ava['UserFirstName'] . " " . $row_ava['UserLastName'] ?> </strong></h2>
            <p class="text-muted">
              <?php echo $row_ava['Description'] ?>
            </p>
          </div>
        </div>
      </section>

      <!-- Section buttonss -->
      <section class="py-2 d-flex justify-content-between">
        <!-- leftt -->
        <div>
          <button type="button" class="btn btn-link bg-light" datadata-ripple-color="dark" onclick="document.location.href='index.php?controller=profile&action=index'">
            Bài viết
          </button>
         
        </div>
        <!-- leftt -->


     
        <!-- rightt -->
      </section>
      <!-- Section buttonss -->
    </div>
  </section>
  <!-- Section: white bgg -->

  <!-- Section grey bgg -->
  <section>
    <div class="container">
      <div class="row">
        <!-- leftt -->
        <div class="col-md-5 mb-4 mb-md-0">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title mt"><strong>Giới thiệu</strong></h5>
          
              <ul class="list-unstyled text-muted mt-3">
                <li>
                  <i class="fas fa-house-damage me-2 mt-3"></i>Sống tại
                  <a href="https://vi.wikipedia.org/wiki/H%C3%A0_N%E1%BB%99i"><strong> <?php echo $row_ava['UserAddress'] ?> </strong></a>
                </li>
                <li>
                  <i class="fas fa-map-marker-alt me-2 mt-3"></i>Đến từ
                  <a href="https://vi.wikipedia.org/wiki/H%C3%A0_N%E1%BB%99i"><strong> <?php echo $row_ava['UserAddress'] ?> </strong></a>
                </li>
                <li>
                  <i class="fab fa-github me-2 mt-3"></i><a href="https://github.com/VuNgN/facebook">https://github.com/VuNgN/facebook</a>
                </li>
              </ul>
           
            </div>
          </div>


        <?php
        }
        ?>
        <!-- footerr -->
        </div>
        <!-- leftt -->

        <!-- rightt -->
        <div class="col-md-7 mb-4 mb-md-0">
          <!--THINKING POSTT-->
          <div class="card mb-4 thinking-post">
            <div class="card-body">
              <div class="d-flex">
                <a id="thinking-user" href="index.php?controller=profile&action=index">
                  <img src="<?php echo $row_ava['UserAva'] ?>" alt="" class="rounded-circle border" />
                </a>
                <button class="btn btn-light btn-block btn-rounded bg-light" data-mdb-toggle="modal" data-mdb-target="#buttonModalUserPost">
                  Bạn đang nghĩ gì?
                </button>
              </div>          
            </div>
          </div>
          <!--Newss-->
          <?php
          //TRUY VẤN POST, POST_USERR
          if ($profilePost)
            foreach ($profilePost as $row_news) {
          ?>
            <div class="news <?php echo $row_news['PostID'] ?>">
              <div class="row">
                <!-- heading -->
                <div class="heading">
                  <a class="user-ava" href="index.php?controller=profile&action=index">
                    <img class="user-ava" src="<?php echo $row_news['UserAva'] ?>" alt="">
                  </a>
                  <div class="user-name-time">
                    <a href="index.php?controller=profile&action=index" class="user-name text-decoration-none link-dark">
                      <b><?php echo $row_news['UserFirstName'] . " " . $row_news['UserLastName'] ?></b>
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
                        <div class="col-md-12 items btn-editPost">
                          <!-- bấm vào đây sửa bài viết -->
                          <span class="material-icons">mode_edit</span>
                          <b>Sửa bài viết</b>
                        </div>
                        <!--Sửa bài-->
                        <!--Xóa bài-->
                        <a class="col-md-12 items" href="index.php?controller=Profile&action=deletePost&PostID=<?php echo $row_news['PostID'] ?>">
                          <span class="material-icons">delete</span>
                          <b>Xóa bài viết</b> <!-- bấm vào đây xóa bài viết -->
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- news-content -->
                <div class="news-content">
                  <div class="content-caption">
                    <?php echo $row_news['PostCaption'] ?>
                      <form class="editPost" action="index.php?controller=Profile&action=editPost&PostID=<?php echo $row_news['PostID']?>"
                      style="width:100%;height:auto;display:none; flex-direction:column" method="post">
                        <textarea name="editContent" id="" cols="100" rows="10"><?php echo $row_news['PostCaption']?></textarea>
                        
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary editPostCloseBtn">
                            Đóng
                          </button>
                          <button type="submit" class="btn btn-primary" name="btn-sendPost">
                            Lưu
                          </button>
                        </div>
                      </form>
                  </div>
                  <?php
                  if ($Profile->getImgPost($row_news['PostID']))
                    foreach ($Profile->getImgPost($row_news['PostID']) as $row_img_content) {

                  ?>
                    <div class="content-images">
                      <img src="<?php echo $row_img_content['images']; ?>" alt="" onclick="clickImg('<?php echo $row_img_content['images']; ?>')">
                    </div>
                  <?php
                    }
                  ?>
                </div>

                <!-- action comment -->
                <div class="action-comment">
                  <div class="action-comment-above">
                    <div class="action-index">
                      <span class="material-icons-round">
                        emoji_emotions
                      </span>
                      <div class="share-index-item">
                          <?php echo $Profile->getLikeNumber($row_news['PostID']); ?>
                          lượt like
                      </div>
                    </div>
                    <div class="comment-index">

                      <?php
                      if ($Profile->countComment($row_news['PostID']))
                        foreach ($Profile->countComment($row_news['PostID']) as $comment) {
                      ?>
                        <div class="comment-index-item" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                          <?php echo $comment['count(CommentID)']; ?> bình luận
                        </div>
                      <?php
                        }
                      ?>
                     
                    </div>
                  </div>
                  <div class="action-comment-under">
                    <?php
                            if ($Profile->getLikeModel($row_news['PostID'])) {
                              
                              ?>
                                <a class="action-comment-under-item text-decoration-none" href="index.php?controller=profile&action=likeProcess&PostID=<?php echo $row_news['PostID'] ?>&UserID=<?php echo $row_news['UserID'] ?>" style="">
                                  <div class="action-comment-under-item">
                                    <div class="action-icon">
                                        <span class="material-icons">
                                            thumb_up
                                        </span>

                                    </div>
                                    <div class="action-name">
                                        <h6>Thích</h6>
                                    </div>
                                  </div>
                                </a>
                            <?php } else {

                            ?>
                                <a class="action-comment-under-item text-decoration-none text-muted" href="index.php?controller=profile&action=likeProcess&PostID=<?php echo $row_news['PostID'] ?>&UserID=<?php echo $row_news['UserID'] ?>" style="">
                                  <div class="action-comment-under-item">    
                                    <div class="action-icon">
                                        <span class="material-icons">
                                            thumb_up
                                        </span>

                                    </div>
                                    <div class="action-name">
                                        <h6>Thích</h6>
                                    </div>
                                  </div>
                                </a>

                            <?php  } ?>
                    <div class="action-comment-under-item btn-comment">
                      <div class="action-icon">
                        <span class="material-icons-outlined comment-icon">
                          chat_bubble_outline
                        </span>
                      </div>
                      <div class="action-name ">
                        <h6>Bình luận</h6>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <!--COMMENT INPUTT-->
                <div class="row">
                  <form id="comment-form" action="index.php?controller=profile&action=addComment" method="post" autocomplete="off">
                    <div class="col-md-12 comment-input-form">
                      <a class="icon" href="index.php?controller=profile&action=index">
                        <img class="user-ava" src="<?php echo $row_news['UserAva'] ?>" alt="">
                      </a>
                      <input class="ID" type="text" value="<?php echo $row_news['PostID']; ?>" name="PostID">
                      <input class="ID" type="text" value="<?php echo $UserID; ?>" name="UserID">
                      <!--Người đăng nhậpp-->
                      <div class="comment-input">
                        <input id="comment-input" name="txt-comment" type="text" placeholder=" Viết bình luận" class="form-control">
                      </div>
                      <button id="send-comment" name="btn-comment" type="submit" style="display: none;">
                        <span class="material-icons-round send-icon">
                          reply
                        </span>
                      </button>
                    </div>
                  </form>
                </div>

                <!--COMMENTSS-->
                <ul class="comments <?php echo $row_news['PostID']?>" style="display:none">
                  <?php
                  //TRUY VẤN COMMENT, COMMENT_USER
                  foreach ($Profile->viewComment($row_news['PostID']) as $row_comment) {
                    if ($row_comment['UserID'] == $UserID) {
                  ?>
                      <li class="comment-item myDIV">
                        <a class="icon" href="index.php?controller=profile&action=index">
                          <?php
                          //TRUY VẤN COMMENT, COMMENT_USER
                          foreach ($Profile->getAvatar($row_comment['UserID']) as $rowAvatar) {
                          }
                          ?>
                          <img class="user-ava" src="<?php echo $row_news['UserAva'] ?>" alt="">
                        </a>
                        <div class="commentator-name">
                          <a href="index.php?controller=profile&action=index" class="user-name text-decoration-none link-dark">
                            <b><?php echo $row_comment['UserName']; ?></b>
                          </a>
                          <p class="comment-content">
                            <?php echo $row_comment['CommentContent']; ?>
                          </p>
                        </div>
                      </li>
                    <?php
                    } else {
                    ?>
                      <li class="comment-item myDIV">
                        <?php
                        foreach ($Profile->getAvatar($row_comment['UserID']) as $rowAvatar) {

                        ?>
                          <a class="icon" href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_comment['UserID']; ?>">
                            <?php
                            //TRUY VẤN COMMENT, COMMENT_USER
                            ?>
                            <img class="user-ava" src="<?php echo $rowAvatar['UserAva'] ?>" alt="">
                          </a>
                        <?php } ?>
                        <div class="commentator-name">
                          <a href="index.php?controller=profile&action=getFriendInfo&UserIDFriend=<?php echo $row_comment['UserID']; ?>" class="user-name text-decoration-none link-dark">
                            <b><?php echo $row_comment['UserName']; ?></b>
                          </a>
                          <p class="comment-content">
                            <?php echo $row_comment['CommentContent']; ?>
                          </p>
                        </div>
                        <!--delete COMMENTT-->
                        <div id="edit-comment" class="hide">
                          <a href="index.php?controller=profile&action=deleteComment&CommentID=<?php echo $row_comment['CommentID']; ?>" class="link-dark">
                            <span class="hide material-icons-outlined option-comment option-icon" style="font-size:15px">
                              delete_forever
                            </span>
                          </a>
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
            } // to
          ?>
          <!--THINKING POSTT-->
          <div class="col-md-9 mb-4 mb-md-0 thinking-post">
            <div class="modal fade" id="buttonModalUserPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="post-form" action="index.php?controller=Profile&action=addPost" method="post" autocomplete="off" enctype="multipart/form-data">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">
                        <strong>Tạo bài viết</strong>
                      </h5>
                      <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="text" name="UserID" value="<?php echo $UserID ?>" hidden>
                    <textarea id="post-writing" cols="50" rows="5" class="modal-body" placeholder="Hãy viết gì đó..." name="txt-content"></textarea>
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
        </div>
      </div>
      <!-- rightt -->
 
    </div>
    </div>

  </section>
  <!-- Section grey bgg -->
</main>
<script>
  function clickImg(link) {
    window.open(link, "_blank");
  }
</script>

<?php
include "views/templates/footer.php";
?>