<?php require_once("includes/conection.php") ?>
<?php include "includes/header.php" ?>

<?php
    //   lấy bài viết từ bảng posts trong database
    $sql_navigation   = "SELECT * FROM posts ORDER BY createdate DESC LIMIT 4";
    $query_navigation = mysqli_query($connect, $sql_navigation); 
    // $data = mysqli_fetch_array($query);
    // var_dump($data);
?>

<?php

function tach_chu_hien_thi($content){
      //lay khoang 30 chu dau tien ra de hien thi
      $mang = explode(" ", $content);
      $str = "";
      $sochu = sizeof($mang);
      if($sochu < 10){
        for($j = 0; $j < sizeof($mang); $j++){
            $str = $str." ".$mang[$j];
        }
      }else{
        for($j = 0; $j < 15; $j++){
            $str = $str." ".$mang[$j];
        }
      }
      return $str;
}
//hàm cho hiển thị nổi bật
function tach_chu_hien_thi_noibat($content){
    //lay khoang 30 chu dau tien ra de hien thi
    $mang = explode(" ", $content);
    $str = "";
    for($j = 0; $j < 45; $j++){
        $str = $str." ".$mang[$j];
    }
    return $str;
}
?>

<!-- truy xuất dữ liệu theo theme = "Giáo dục" -->
<?php
    //lấy bài mới nhất cho vào tin nổi bật của trang
    $sql = "SELECT * FROM posts
            ORDER BY createdate DESC LIMIT 1";
    $query_noibat = mysqli_query($connect, $sql);
    $tin_noi_bat = mysqli_fetch_array($query_noibat);
    //   lấy bài viết từ bảng posts trong database
    $sql_content1   = "SELECT * FROM posts
                      Where theme = 'Giao Duc'
                       ORDER BY createdate DESC LIMIT 6";
    $query_content1 = mysqli_query($connect, $sql_content1); 
    // $data = mysqli_fetch_array($query);
    // var_dump($data);
?>
<!-- truy xuất dữ liệu theo theme = "Thể Thao" -->
<?php
    //   lấy bài viết từ bảng posts trong database
    $sql_content2   = "SELECT * FROM posts 
                       Where theme = 'The Thao'
                       ORDER BY createdate ASC LIMIT 6";
    $query_content2 = mysqli_query($connect, $sql_content2); 
    // $data = mysqli_fetch_array($query);
    // var_dump($data);
?>
<!-- truy xuất dữ liệu theo theme = "Thế Giới" -->
<?php
    //   lấy bài viết từ bảng posts trong database
    $sql_content3   = "SELECT * FROM posts
                     Where theme = 'The gioi'
                      ORDER BY createdate ASC LIMIT 6";
    $query_content3 = mysqli_query($connect, $sql_content3); 
    // $data = mysqli_fetch_array($query);
    // var_dump($data);
?>
<!-- truy xuất dữ liệu theo theme = "Công nghệ" -->
<?php
    //   lấy bài viết từ bảng posts trong database
    $sql_content4   = "SELECT * FROM posts
                       Where theme = 'Cong nghe'
                       ORDER BY createdate ASC LIMIT 6";
    $query_content4 = mysqli_query($connect, $sql_content4); 
    // $data = mysqli_fetch_array($query);
    // var_dump($data);
?>

         <div id="navigation" class="wrap-inner">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="./index.php">HOME</a>
                <a class="navbar-brand" href="./display_topic.php?topic=1">GIÁO DỤC</a>
                <a class="navbar-brand" href="./display_topic.php?topic=2">SỨC KHỎE</a>
                <a class="navbar-brand" href="./display_topic.php?topic=3">PHÁP LUẬT</a>
                <a class="navbar-brand" href="./display_topic.php?topic=4">GIA ĐÌNH</a>
                <a class="navbar-brand" href="./display_topic.php?topic=5">THỂ THAO</a>
                <a class="navbar-brand" href="./display_topic.php?topic=6">THẾ GIỚI</a>
                <form action="xulitimkiem.php" method="post" id="search" class="form-inline my-2 my-lg-0 fl-right">
                    <input class="form-control mr-sm-2" type="search" name="search_key" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
           </nav>
         </div>
         <!-- end navigation -->
         <div id="featured" class="wrap-inner clearfix">
              <div class="main-featured fl-left">
                  <img src="<?php echo $tin_noi_bat["url_hinhanh"]; ?>" style="width: 450px; height:250px;" alt="">
                  <br>
                  <a href="display_item.php?id=<?php echo $tin_noi_bat["id"]; ?>"><?php echo $tin_noi_bat["title"]; ?></a>
                  <p>
                    <?php 
                        echo tach_chu_hien_thi_noibat($tin_noi_bat["content"])."....."; 
                    ?>
                  </p>
              </div>
              <div class="right-featured fl-left">
                  <?php 
                      while($data = mysqli_fetch_array($query_navigation)){

                  ?>
                   <div class="item-right-featured clearfix">
                        <img class="fl-left" src="<?php echo $data["url_hinhanh"]; ?>" style="width: 100px; height:100px;" alt="">
                        <a href="display_item.php?id=<?php echo $data["id"]; ?>"><?php echo $data["title"]; ?></a>
                        <p>
                            <?php 
                               echo tach_chu_hien_thi($data["content"])."....."; 
                            ?>
                        </p>
                   </div>
                   <?php
                      }
                   ?>
                   
              </div>

         </div>
         <!-- end featured -->
         <div id="content" class="wrap-inner clearfix">
            <div class="content-column fl-left">
                <h3>GIÁO DỤC</h3>
                <hr>
                <?php
                    while($content1 = mysqli_fetch_array($query_content1)){
                ?>
                <div class="item-content-column  clearfix">
                   
                    <a href="display_item.php?id=<?php echo $content1["id"]; ?>"><?php echo $content1["title"]; ?></a>
                    <p>
                         <?php 
                          echo tach_chu_hien_thi($content1["content"])."...."; 
                        ?>
                    </p>
                    <a class="fl-right" href="display_item.php?id=<?php echo $content1["id"]; ?>">Read more »</a>
                </div>     
                <?php 
                    }                    
                ?>
 
            </div>
            <div class="content-column fl-left">
                <h3>THỂ THAO</h3>
                <hr>
                <?php
                    while($content2 = mysqli_fetch_array($query_content2)){
                ?>
                <div class="item-content-column  clearfix">
                    <a href="display_item.php?id=<?php echo $content2["id"]; ?>"><?php echo $content2["title"]; ?></a>
                    <p>
                    <?php 
                          echo tach_chu_hien_thi($content2["content"])."....."; 
                        ?>
                    </p>
                    <a class="fl-right" href="display_item.php?id=<?php echo $content2["id"]; ?>">Read more »</a>
                </div>
                <?php 
                    }                    
                ?>


            </div>
            <div class="content-column fl-left">
                <h3>THẾ GIỚI</h3>
                <hr>
                <?php
                   while($content3 = mysqli_fetch_array($query_content3)){
                ?>
                <div class="item-content-column  clearfix">
                    <a href="display_item.php?id=<?php echo $content3["id"]; ?>"><?php echo $content3["title"]; ?></a>
                    <p>
                        <?php 
                          echo tach_chu_hien_thi($content3["content"])."....."; 
                        ?>
                    </p>
                    <a class="fl-right" href="display_item.php?id=<?php echo $content3["id"]; ?>">Read more »</a>                 
                </div>
                <?php 
                    }                    
                ?>
  
            </div>
            <div class="content-column fl-left">
                <h3>CÔNG NGHỆ</h3>
                <hr>
                <?php
                    while($content4 = mysqli_fetch_array($query_content4)){
                ?>
                <div class="item-content-column  clearfix">
                    <a href="display_item.php?id=<?php echo $content4["id"]; ?>"><?php echo $content4["title"]; ?></a>
                    <p>
                       <?php 
                         echo tach_chu_hien_thi($content4["content"])."....."; 
                       ?>
                   </p>
                    <a class="fl-right" href="display_item.php?id=<?php echo $content4["id"]; ?>">Read more »</a>
                </div>
                <?php 
                    }                    
                ?>

            </div>
        </div>
         <!-- end content -->
<?php include "includes/footer.php" ?>