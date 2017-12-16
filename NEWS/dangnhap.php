<?php 
session_start();
?>
<?php include "includes/header.php" ?>

<div id="wp-dangki" class="wrap-inner">
	<form method="POST" action="dangnhap.php">
        <div class="form-dang-ki">
            <div class="form-group">
                <label for="inputAddress">Username</label>
                <input type="text" class="form-control" name="username"  id="username" placeholder="User name">
            </div>
            <div class="form-group">
                <label for="inputAddress">Password</label>
                <input type="password" class="form-control" name="password"  id="password" placeholder="Pass Word">
            </div>
            <button type="button" class="btn btn-primary" onClick="go_back()" >Back</button>
            <button type="submit" class="btn btn-primary" onClick="check()" name="btn_login">Submit</button>
        </div>
    </form>

    <!-- go back -->
    <script>
        function go_back(){
            window.location.href="./index.php";
        }
        function check(){
          var username = document.getElementById("username").value;
          var password = document.getElementById("password").value;
          if(username == "")
          {
            confirm("Nhập username vào !");
            document.getElementById("username").focus();
          }else if(password == ""){
            confirm("Nhập password vào !");
          }else{

          }
        }
    </script>    

   <?php 
    //connect đến database 
    require_once("includes/conection.php");

    //kiểm tra đã nhấn nút đăng nhập chưa nếu ròi thì thực hiện tiếp
    if (isset($_POST["btn_login"])) {
            //thực hiện lấy các dữ liệu mà người dùng nhập vào từ form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //làm sạch các thẻ html các kí tự đặc biệt do người dùng tạo ra để tấn công database theo phương thức sql injection
        $username = strip_tags($username); //loại bỏ các tag html
        $username = addslashes($username);  //các dấu , / ..

        $password = strip_tags($password);
        $password = addslashes($password);

        // if($username ==""){
        //   echo "<p style='color: red;' >Bạn phải nhập Username vào!</p>";
        // }elseif ($password=="") {
        //   echo "<p style='color: red;' >Bạn phải nhập password vào!</p>";
        // }else{
          //thực hiện 1 câu queeery 
          
          $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
          //coonect dâtbsse
          $query = mysqli_query($connect, $sql);
          $num_row = mysqli_num_rows($query);

            //nếu num_row = 0 tức là truy vấn trong database ko có dữ liệu
          if($num_row == 0){
            echo "<p style='color: red;' >Tên đăng nhập hoặc mật khẩu không đúng!</p>";
          }else{
                //lấy thông tin từ bảng user trong database để lưu vào session
                //hàm mysqli_fetch_array trả về kết quả của 1 truy vấn dưới dạng mảng 
            while ($data = mysqli_fetch_array($query)) {
             $_SESSION["user_id"]    = $data["id"];
             $_SESSION["username"]   = $data["username"];
             $_SESSION["password"]   = $data["password"];
             $_SESSION["email"]      = $data["email"];
             $_SESSION["fullname"]   = $data["fullname"];
             $_SESSION["permision"]  = $data["permision"];
           }
                //sau khi thực hiện xong việc lưu vào session thì chuyển hướng trang sang 1 trang khác 
           header('Location: ./admin/main_of_admin.php');  
         }

     }

  ?>
	
	      
</div>
<?php include "includes/footer.php" ?>