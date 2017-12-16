<?php include("includes/conection.php") ?>
<?php include("includes/header.php") ?>
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

<!-- xóa bài viết -->
<?php 
   if (isset($_GET['id_delete'])) {
   	//thực hiện 1 câu lệnh sql để xóa
   	$id_xoa = $_GET['id_delete'];
     $sql_xoa = "DELETE FROM posts WHERE id ='$id_xoa' ";
     //thực hiện query
     mysqli_query($connect, $sql_xoa);
   }

?>
<!-- end xóa bài viết-->


<div id="main_content" class="wrap-inner">
    
    <?php 
    //lấy user_id để hiển thị tất cả các bài viết do người dùng đang đăng nhập tạo
       $user_id = $_SESSION['user_id'];
    //    var_dump($user_id);

    // câu sql để lấy thông tin
    $sql   = "SELECT * from posts WHERE user_id = '$user_id' ";
    $query = mysqli_query($connect, $sql);
    ?>

    <table class="table table-hover">
        <caption><h3>Thông tin tất cả bài viết</h3></caption>
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Theme</th>
            <th scope="col">Chỉnh Sửa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //vòng lặp để lấy ra thông tin các thành viên
            //mysqli_fetch_assoc() dùng các tên của trường để truy xuất còn aray dùng chỉ số 0,1, ....
            
            while ($data = mysqli_fetch_array($query)) {
                    $id = $data['id'];
            ?>
            <tr>
            <th scope="row"><?php echo $id; ?></th>
            <td><?php echo $data['title'];?></td>
            <td><?php echo tach_chu_hien_thi($data['content'])." ....." ; ?></td>
            <td><?php echo $data['theme']; ?></td>
            <td>
                <a href="chinhsuabaiviet.php?id=<?php echo $id; ?>">Sửa</a>
                <a href="quanlibaiviet.php?id_delete=<?php echo $id; ?>" onClick="return confirm('Are you sure Delete Yours New?')">Xóa</a>
            </td>
            </tr>
            <?php 
            } 
            ?>
        </tbody>
    </table>
    <button class="btn btn-primary" onClick="TroLaiMain()">Back</button>
    <!-- sự kiện cho việc click back và go -->
    <script>
        function TroLaiMain(){
            window.location.href="./main_of_admin.php";
        }
      
	</script>
</div>
<?php include("includes/footer.php"); ?>