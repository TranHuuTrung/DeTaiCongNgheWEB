<?php include("includes/conection.php"); ?>
<!-- <?php include("includes/permission.php") ?> -->
<?php include("includes/header.php") ?>


	<!-- phần main -->
	<div id="main_content" class="wrap-inner">
		<form action="themthanhvien.php" method="POST">
			<table id="bangthemthanhvien">
				<caption><h3>Thêm thành viên mới</h3></caption>
				<tr>
					<td><p>Username </p></td>
					<td><input class="form-control form-control-marginbottom" type="text" name="username" id="username" size="30"></td>
				</tr>
				<tr>
					<td><p>Password </p></td>
					<td><input class="form-control form-control-marginbottom" type="text" name="password" id="password" size="30"></td>
				</tr>
				<tr>
					<td><p>Full name </p></td>
					<td><input class="form-control form-control-marginbottom" type="text" name="fullname" id="fullname" size="30"></td>
				</tr>
				<tr>
					<td><p>Email </p></td>
					<td><input class="form-control form-control-marginbottom" type="text" name="email" id="email" size="30"></td>
				</tr>
				<tr>
					<td><p>Quyền </p></td>
					<td>
						<select id="permission" name="permission">
							<option value="0">Thành Viên</option>
							<option value="1">Admin</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input class="btn btn-primary" type="button" value="Trở lại" onclick="Backtrangchu()"></td>
					<td colspan="3" align="center"><input class="btn btn-primary" type="submit" name="btn_themthanhvienmoi" value="Thêm thành viên mới"></td>
				</tr>
			</table>
         </form>

		<script>
		    function Backtrangchu(){
				window.location.href="./main_of_admin.php";
			}
		</script>


		<!-- xử lí thông tin thêm thành viên mới -->
		<?php  
			// kiểm tra xem người quản trị đã bấm nút thêm thành viên chưa
		if (isset($_POST['btn_themthanhvienmoi'])) {
				# nếu đã bấm nút thêm thì chúng ta tiến hành lấy thông tin
			$username   = isset($_POST['username']) ? $_POST['username'] : "";
			$password   = isset($_POST['password']) ? $_POST['password'] : "";
			$fullname   = isset($_POST['fullname']) ? $_POST['fullname'] : "";
			$email      = isset($_POST['email']) ? $_POST['email'] :"";
			$permission = isset($_POST['permission']) ? $_POST['permission'] : "0";

				// kiểm tra xem có bỏ trống trường nào ko
			if ($username == "") {
				echo "<p style='color: red;' >Username không được bỏ trống!</p>";
			}elseif ($password =="") {
				echo "<p style='color: red;' >Password không được để trống!</p>";
			}elseif ($fullname=="") {
				echo "<p style='color: red;' >Fullname không được để trống!</p>";
			}elseif ($email=="") {
				echo "<p style='color: red;' >Email không được để trống!</p>";
			}else{
				//viết câu lệnh sql thêm vào bảng user
				$sql = "INSERT INTO users(username, password, email, fullname, createdate, permision )
						VALUES('$username', '$password','$email','$fullname', now(), '$permission')";
			    //thực hiện câu query dến database
				$init_user = mysqli_query($connect, $sql);

				// kiểm tra xem có trùng dữ liệu trong database hay không 
				if (!$init_user) {
					echo "<p style='color: red;' >Người dùng đã tồn tại, vui lòng không nhập trùng username và email!</p>";
				}else{
					// header('Location: http://facebook.com');
				}
			}
		}
		?>
    </div>
<?php include("includes/footer.php"); ?>