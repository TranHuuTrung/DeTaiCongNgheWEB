<?php include("includes/conection.php") ?>
<?php include("includes/header.php") ?>

<!-- xóa thành viên -->
<?php 
   if (isset($_GET['id_delete'])) {
   	//thực hiện 1 câu lệnh sql để xóa
   	$id_xoa = $_GET['id_delete'];
     $sql = "DELETE FROM users WHERE id ='$id_xoa' ";
     //thực hiện query
     mysqli_query($connect, $sql);
   }

?>
<!-- end xóa thành viên -->


<?php  
    //tạo câu sql truy vấn dữ liệu
    $sql = "SELECT * FROM users";
    $query = mysqli_query($connect, $sql);
?>


<div id="wrapper_qlithanhvien">
	<!-- phần main -->
	<div id="main_content" class="wrap-inner">
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Fullname</th>
                <th scope="col">Quyền</th>
                <th scope="col">Chỉnh Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //vòng lặp để lấy ra thông tin các thành viên
                //mysqli_fetch_assoc() dùng các tên của trường để truy xuất còn aray dùng chỉ số 0,1, ....

                    $i = 1 ;
                while ($data = mysqli_fetch_array($query)) {
                        $id = $data['id'];
                ?>
                <tr>
                <th scope="row"><?php echo $id; ?></th>
                <td><?php echo $data['username'];?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['fullname']; ?></td>
                <td><?php echo ($data['permision'] == 0)? " Thành Viên ":" Admin "  ; ?></td>
                <td>
                    <a href="chinhsuathongtinthanhvien.php?id=<?php echo $id; ?>">Sửa</a>
					<a href="quanlithanhvien.php?id_delete=<?php echo $id; ?>" onClick="return confirm('Are you sure Delete?')">Xóa</a>
                </td>
                </tr>
                <?php 
                  $i ++;
		        } 
			    ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onClick="TroLai()">Back</button>
        <button class="btn btn-primary"><a href="themthanhvien.php" class="a-them">Thêm thành viên mới</a></button>
        <script>
             function TroLai(){
                  window.location.href="./main_of_admin.php";
             }
        </script>
        <!-- giải phóng biến kết nối -->
		<?php
		//    giải phóng các tập bản ghi
			mysqli_free_result($query); 
			//giải phóng biến connect
			mysqli_close($connect); 
		?>
    </div>
<?php include("includes/footer.php"); ?>