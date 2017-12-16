<?php require_once("includes/conection.php") ?>
<?php include "includes/header.php" ?>

<!-- get lấy id của thành viên  -->
<?php 
     $id_thanhvien = -1;
     if(isset($_GET['id'])){
         $id_thanhvien = $_GET['id'];
     }
    //  var_dump($id_thanhvien);
    
    //thực hiện select đến cơ sở dữ liệu để lấy dữ liệu thông qua id
    $sql = "SELECT * FROM users WHERE id = '$id_thanhvien' ";
    $query = mysqli_query($connect, $sql);

?>


<div id="main_content" class="wrap-inner">
    <?php
       while($data = mysqli_fetch_array($query)){

    ?>
    <form method="POST">
        <table id="bangthemthanhvien">
            <caption><h3>Chỉnh Sửa Thành Viên</h3></caption>
            <tr>
                 <td><input type="hidden" name="id" id="id" value="<?php echo $data["id"]; ?>"></td>
            </tr>
            <tr>
                <td><p>Username </p></td>
                <td><input class="form-control form-control-marginbottom" value="<?php echo $data["username"]; ?>"  type="text" name="username" id="username" size="30"></td>
            </tr>
            <tr>
                <td><p>Full name </p></td>
                <td><input class="form-control form-control-marginbottom" value="<?php echo $data["fullname"]; ?>" type="text" name="fullname" id="fullname" size="30"></td>
            </tr>
            <tr>
                <td><p>Email </p></td>
                <td><input class="form-control form-control-marginbottom" value="<?php echo $data["email"]; ?>" type="text" name="email" id="email" size="30"></td>
            </tr>
            <tr>
                <td><p>Quyền </p></td>
                <td>
                    <select id="permision" name="permision">
                        <option value="0">Thành Viên</option>
                        <option value="1">Admin</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input class="btn btn-primary" type="button" value="Back" onclick="Backtrangquanli()"></td>
                <td colspan="3" align="center"><input class="btn btn-primary" type="submit" name="btn_chinhsuathongtin" value="Go" onClick="Go()"></td>
            </tr>
        </table>
    </form>
    <?php
       }
    ?>

    <!-- sự kiện cho việc click back và go -->
    <script>
        function Backtrangquanli(){
            window.location.href="./quanlithanhvien.php";
        }
      
	</script>

    <!-- xử lí khi người dùng nhấn btn go để hoàn thành việc chỉnh sửa  -->
    
    <?php
        if(isset($_POST["btn_chinhsuathongtin"])){
            //lấy các thông tin sau khi đã chỉnh sửa
            $id        = $_POST["id"];
            $username  = $_POST["username"];
            $fullname  = $_POST["fullname"];
            $email     = $_POST["email"];
            $permision = $_POST["permision"];

            if ($username == "") {
				echo "<p style='color: red;' >Username không được bỏ trống!</p>";
			}elseif ($fullname=="") {
				echo "<p style='color: red;' >Fullname không được để trống!</p>";
			}elseif ($email=="") {
				echo "<p style='color: red;' >Email không được để trống!</p>";
			}else{
             //thực hiện câu lệnh update
             $sql_update = "UPDATE users SET username = '$username', fullname = '$fullname', 
             email = '$email', permision = '$permision' WHERE id ='$id'";
             $query_update = mysqli_query($connect, $sql_update);

              header('Location: ./quanlithanhvien.php');
             echo "<p style='color:green;'>Bạn đã chỉnh sửa thành công!</p>"; 
             
        }
    }
    ?>

</div>

<?php include "includes/footer.php" ?>