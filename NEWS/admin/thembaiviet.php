<?php require_once("includes/conection.php"); ?>
<!-- <?php include("includes/permission.php"); ?> -->
<?php include("includes/header.php"); ?>

<div id="wrapper_them_bai_viet">
	<!-- phần main -->
	<div id="main_content" class="wrap-inner">
		<form method="POST" action="thembaiviet.php" enctype="multipart/form-data">
			<table>
				<tr>
					<td colspan="3"><h3>Thêm bài viết mới </h3></td>
				</tr>
				<tr>
					<td><p>Chủ đề(Theme): </p></td>
                    <td><input type="text" id="theme" name="theme" value="Giao Duc"  class="form-control  form-control-marginbottom"</td>
                    <td>
                        <select id="getTheme" onChange="myChangeTheme()">
                            <option value="Giao Duc">Giáo Dục
                            <option value="Suc Khoe">Sức Khỏe
                            <option value="Phap Luat">Pháp Luật
                            <option value="Gia Dinh">Gia Đình
                            <option value="The Thao">Thể Thao
                            <option value="The Gioi">Thế Giới
                            <option value="Cong nghe">Công Nghệ
                        </select>
                    </td>
                    
                </tr>
                <tr>
					<td><p>Tiêu đề : </p></td>
					<td><input type="text" id="title" name="title" class="form-control form-control-marginbottom" ></td>
				</tr>
                <tr>
                    <td><p>Hình ảnh </p></td>
                    <td><input type="file" class="themhinhanh" name="hinh"></td>
                </tr>
				<tr>
					<td><p>Nội dung : </p></td>
					<td><textarea name="post_content" id="post_content_ckeditor" cols="110" rows="10"></textarea></td>
				</tr>
				<tr>
                    <td colspan="2"> <input class="btn btn-primary" type="button" value="Trở lại" onClick="back_thembaiviet()"></td>
					<td colspan="3" align="center"><input class="btn btn-primary dangbai" type="submit" name="btn_dangbai" value="Thêm bài viết"></td>
				</tr>
               
			</table>

        </form>
        <script>
             function back_thembaiviet(){
                window.location.href="./main_of_admin.php";
             }
             //hàm lấy giá trị của chủ đề 
             function myChangeTheme(){
                var theme = document.getElementById("getTheme").value;
                document.getElementById("theme").value = theme;
            }
        </script>
		<script>
	           //thay thế textarea làm cho khung thêm nội dung đẹp hơn
	           CKEDITOR.replace( 'post_content_ckeditor' );
        </script>
        <?php
                //kiểm tra xem người dùng đã bấm nút đăng bài chưa
            if (isset($_POST["btn_dangbai"])) {
                $user_id = $_SESSION["user_id"];
                $theme = $_POST["theme"];
                $title = $_POST["title"];
                $content =$_POST["post_content"];
                //xử lí hình ảnh
                $image_name = $_FILES['hinh']['name'];
                $array_image_name = explode(".", $image_name);
                //lấy phần tử cuối cùng của mảng chính là loại ảnh (jpg, png, ....)
                $image_type = $array_image_name[count($array_image_name) - 1];
                $valid_type = "gif,png,jpg,bmp,jpeg,GIF,JPG,PNG,BMP,JPEG";
                $array_valid_type = explode(",", $valid_type);
                //kiểm tra xem hình vừa upload lên có hợp lệ hay không
                $valid_image = "";
                for($i = 0; $i < count($array_valid_type); $i++){
                    if($image_type == $array_valid_type[$i]){
                        $valid_image = "true";
                        break; //kết thúc vòng forr
                    }
                }
        

                if($title =="") {
                    echo "<p style='color:red;'>Bạn phải tạo tiêu đề cho bài viết</p>";
                }elseif($valid_image != "true"){
                    echo "<p style='color:red;'>Bạn phải chọn đúng định dạng ảnh</p>";
                }elseif ($content =="") {
                    echo "<p style='color:red;'>Bạn phải tạo nội dung cho bài viết</p>";
                }else{
                    
                    if($valid_image == "true"){
                        // $thumb_image = "thumb_".$image_name;
                        $now = getdate();
                        $nam = $now["year"];
                        $thang = $now["mon"];
                        $dir = "hinhanh/".$nam;
                        if(is_dir($dir)){
                            //nếu có rồi thì ko làm gì cả
                        }else{
                            //còn chưa có thì tạo mới
                            mkdir($dir);    
                        }
 
                        $dir = "hinhanh/".$nam."/".$thang;
                        if(is_dir($dir)){
                            //không làm j cả
                        }else{
                            mkdir($dir);
                        }
                        $dir = "hinhanh/".$nam."/".$thang."/".$theme;
                        if(is_dir($dir)){
                            //không làm j cả
                        }else{
                            mkdir($dir);
                        }

                        $upload_path = $dir."/".$image_name;
                        // var_dump($upload_path);
                        move_uploaded_file($_FILES['hinh']['tmp_name'], $upload_path);//tham số thứ 1 : file nguồn, tham số thứ 2 : file đích
                         
                        //thực hiện câu sql để thêm bài viết vào bảng database pots
                        $sql = "INSERT INTO posts(title, content, user_id,is_public, createdate,theme,url_hinhanh)
                        VALUES('$title', '$content', '$user_id', '1' ,now(), '$theme','$upload_path') ";
                        //thực thi câu lệnh sql
                        mysqli_query($connect, $sql);
                        echo "<img src=' ".$upload_path." '/>";
                        echo "<p style='color:green;'>Bạn đã thêm bài viết thành công!</p>";
                    }                
                }
            }
            ?>
    </div>

<?php include("includes/footer.php") ?>