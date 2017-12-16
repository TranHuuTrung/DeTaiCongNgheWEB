<?php require_once("includes/conection.php") ?>
<?php include "includes/header.php" ?>

<!-- get topic from link when user click on it -->
<?php
     $topic = "";
     $theme = " ";
     if(isset($_GET["topic"])){
         $topic = $_GET['topic'];
    }
    if($topic == 1) $theme = "Giao Duc" ;
    if($topic == 2) $theme = "Suc Khoe" ;
    if($topic == 3) $theme = "Phap Luat" ;
    if($topic == 4) $theme = "Gia Dinh";
    if($topic == 5) $theme = "The Thao" ;
    if($topic == 6) $theme = "The Gioi" ;

     //thực hiện câu sql để lấy thông tin
     $sql = "SELECT * FROM posts WHERE theme = '$theme'";

     //thực hiện truy vấn dữ liệu 
     $query = mysqli_query($connect, $sql);
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
    <?php
        $i=0;
        while($data = mysqli_fetch_array($query)){
            if($i == 4){
                echo "</tr>";
                $i = 0;
            }
    ?>
    <div class="topic-item fl-left">
        <a href="./display_item.php?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
        <img class="fl-left" src="<?php echo $data["url_hinhanh"]; ?>" style="width: 80px; height:80px;">
        <p><?php echo tach_chu_hien_thi($data['content'])."....." ;?></p>
    </div>
    <?php 
    $i++;
    }
    ?>
    <!-- kết thúc vòng while -->
</div>
<?php include "includes/footer.php" ?>
