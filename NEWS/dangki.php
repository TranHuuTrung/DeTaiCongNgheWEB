<?php include "includes/header.php" ?>
<?php require_once("includes/conection.php") ?>

<div id="wp-dangki" class="wrap-inner">
	<form method="POST" action="dangki.php">
        <div class="form-dang-ki">
            <div class="form-group">
                <label for="inputAddress">Username</label>
                <input type="text" class="form-control" name="username"  id="username" placeholder="User name">
            </div>
            <div class="form-group">
                <label for="inputAddress">Password</label>
                <input type="password" class="form-control" name="password"  id="password" placeholder="Pass Word">
            </div>
            <div class="form-group">
                <label for="inputAddress">Full Name</label>
                <input type="text" class="form-control" name="fullname"  id="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="inputAddress">Email</label>
                <input type="text" class="form-control" name="email"  id="email" placeholder="Email">
            </div>
            <button type="button" class="btn btn-primary" onClick="go_back()" >Back</button>
            <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
        </div>
    </form>

    <!-- go back -->
    <script>
        function go_back(){
            window.location.href="./index.php";
        }
    </script>    

	<!-- Kiểm tra nhập vào  -->
    <?php
         //kiểm tra xem người dùng đã bấm nút button submit chưa 
	    if(isset($_POST['btn_submit'])){

           //kiểm tra xem thông tin các trường đã có chưa tránh trường hợp lỗi vì không có 1 trong các trường 
		   $username = isset($_POST['username']) ? $_POST['username'] :"" ;
		   $password = isset($_POST['password']) ? $_POST['password'] :"" ;
		   $email    = isset($_POST['email']) ? $_POST['email'] :"" ;
		   $fullname     = isset($_POST['fullname']) ? $_POST['fullname'] :"" ;


		    if($username == ""){
			   echo "<p style='color: red;' >bạn phải nhập đầy đủ username vào !</p>";
		    }elseif ($password =="") {
			   echo "<p style='color: red;' >Bạn phải nhập Password!</p>";
		    }elseif ($fullname=="") {
			   echo "<p style='color: red;' >Bạn phải nhập Name!</p>";
		    }elseif ($email=="") {
                
			   echo "<p style='color: red;' >Bạn phải nhập Email!</p>";
		    }else{
                //check xem đã tồn tại username, email chưa        
                $sql_check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
                //coonect database
                $query_check = mysqli_query($connect, $sql_check);
                $num_row = mysqli_num_rows($query_check);
                if($num_row != 0){
                    echo "<p style='color: red;' >Không Được trùng Tên đăng nhập và Email!</p>";
                }else{
                    //tạo 1 query để đưa dư liệu vào bảng user trong database
                    $sql = "INSERT INTO users(username, password, email, fullname, createdate)
                    VALUES('$username', '$password', '$email', '$fullname', now())";
                    //thực hiện kết nối câu query với database với biến $connect lấy từ file connection.php 
                    mysqli_query($connect, $sql);

                    //đăng kí xong thì chuyển sang trang mới
                    header('Location: ./index.php');


                    echo "<p style='color: blue;' >Chúc mừng bạn đã đăng kí thành công!</p>";
                }  
            }
	    }
	?> 
	      
</div>
<?php include "includes/footer.php" ?>