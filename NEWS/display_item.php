<?php require_once("includes/conection.php") ?>
<?php include "includes/header.php" ?>

<!-- get id was sent from file index when user click on read more or click on link -->
<?php  
       $id = -1;
       if(isset($_GET["id"])){
       	    $id = intval($_GET["id"]); //dùng intval để chuyển các dạng như chuỗi số ... -> số hệ số 10 kiểu int
       }

       //thực hiện câu sql để lấy ra các thông tin bài viết theo id 
       $sql = "SELECT * FROM posts WHERE id = $id";
       //thực hiện truy vấn dữ liệu thông qua $connect
       $query = mysqli_query($connect, $sql);

 ?> 

<!-- navigation -->
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
         <div class="content-show wrap-inner">
            <div class="show_content fl-left"  style="width: 450px;">
                 <?php
                    //mảng dữ liệu 
                    while ($data = mysqli_fetch_array($query)) {
                      //câu sql lấy tên user theo user_id
                      //phải tạo 1 biến $i vì vòng lặp while thay đổi chỉ số của mảng data 
                      //nếu chỗ user.id = $posts.user_id thì nõ luôn chỉ bởi 1 người viết
                      $i = $data['user_id'] ;
                      $sql1 = "SELECT * FROM users inner join posts on users.id = $i ";
                      $query1 = mysqli_query($connect,$sql1);
                      $data1 = mysqli_fetch_array($query1);
                      //trường hợp username bị xóa 
                      $data_name = isset($data1['username']) ? $data1['username'] : "Admin";
                      // $day  = "SELECT DAYNAME($data['createdate'])";
                      
                ?>
                
                <!-- hiển thị nội dung của bài viết -->
                 <h2 style="color: blue;  font-size: 25px;"><?php echo $data["title"]; ?></h2></br>
                 <i>Ngày tạo: <?php echo $data['createdate']." <b>by</b> ".$data_name; ?></i><br><br>
                 <p><?php echo $data["content"]; ?>

                <?php } ?>
                 <br>
                <button id="back" onclick="go_back()">Back</button>
            </div>
            <script>
                function go_back(){
                    window.location.href="./index.php";
                }
            </script>
            <div class="right-featured fl-right">
                  <?php 
                      $sql_navigation = "SELECT * From posts ORDER BY createdate DESC LIMIT 4";
                      $query_navigation = mysqli_query($connect, $sql_navigation);
                      while($data = mysqli_fetch_array($query_navigation)){

                      //lay khoang 30 chu dau tien ra de hien thi
                      $mang = explode(" ", $data["content"]);
                      $str = "";
                      $sochu = sizeof($mang);
                      if($sochu < 10){
                        for($j = 0; $j < 4; $j++){
                            $str = $str." ".$mang[$j];
                        }
                      }else{
                        for($j = 0; $j < 15; $j++){
                            $str = $str." ".$mang[$j];
                        }
                      }
                      

                  ?>
                   <div class="item-right-featured clearfix">
                          <img class="fl-left" src="<?php echo $data["url_hinhanh"]; ?>" style="width: 100px; height:100px;" alt="">
                          <a href="display_item.php?id=<?php echo $data["id"]; ?>"><?php echo $data["title"]; ?></a>
                          <p><?php echo $str." ...."; ?></p>
                   </div>
                   <?php
                      }
                   ?>
                   
              </div>
         </div>
<?php include "includes/footer.php" ?>