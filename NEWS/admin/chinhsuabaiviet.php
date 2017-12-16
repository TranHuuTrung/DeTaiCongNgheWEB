<?php include("includes/conection.php") ?>
<?php include("includes/header.php") ?>
<!-- lấy id bài viết để sauwr thông tin bài viết -->
<?php
    $id_baiviet = -1;
    if(isset($_GET['id'])){
        $id_baiviet = $_GET['id'];
    }
    //thực hiện câu sql để lấy toàn bộ các nội dung của bài viết có id trên
    $sql    = "SELECT * from posts WHERE id = '$id_baiviet' ";
    $query  = mysqli_query($connect, $sql);
?>

<div id="main_content" class="wrap-inner">
    <?php 
         while($data = mysqli_fetch_array($query)){

    ?>
    <form method="POST">
        <table>
            <tr>
                <td colspan="3"><h3>Chỉnh sửa bài viết </h3></td>
            </tr>
            <tr>
                 <td><input type="hidden" name="id" id="id" value="<?php echo $data["id"]; ?>"></td>
            </tr>
            <tr>
                <td><p>Chủ đề(Theme): </p></td>
                <td><input type="text" id="theme" name="theme" value="<?php echo $data['theme']; ?>"  class="form-control  form-control-marginbottom"</td>
                <td>
                    <select id="getTheme" onChange="myChangeTheme()">
                        <option value="Giao Duc">Giáo Dục
                        <option value="Suc Khoe">Sức Khỏe
                        <option value="Phap Luat">Pháp Luật
                        <option value="Gia Dinh">Gia Đình
                        <option value="The Thao">Thể Thao
                        <option value="The Gioi">Thế Giới
                        <option value="Cong Nghe">Công Nghệ
                    </select>
                </td>
                
            </tr>
            <tr>
                <td><p>Tiêu đề : </p></td>
                <td><input type="text" id="title" name="title" value="<?php echo $data['title']; ?>" class="form-control form-control-marginbottom" ></td>
            </tr>
            <tr>
                <td><p>Nội dung : </p></td>
                <td><textarea name="content_saukhisua" id="post_content_ckeditor" cols="110" rows="20"><?php echo $data['content']; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"> <input class="btn btn-primary" type="button" value="Trở lại" onClick="back_suabaiviet()"></td>
                <td colspan="3" align="center"><input class="btn btn-primary dangbai" type="submit" name="btn_chinhsuaxong" value="Chỉnh Sửa Xong"></td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>
    <script>
        //hàm lấy giá trị của chủ đề 
        function myChangeTheme(){
            var theme = document.getElementById("getTheme").value;
            document.getElementById("theme").value = theme;
        }

        function back_suabaiviet(){
            window.location.href="./quanlibaiviet.php";
        }
    </script>
    <!-- xử lí khi người dùng nhấn btn_chinhsuaxong để hoàn thành việc chỉnh sửa  -->
    <?php
        if(isset($_POST["btn_chinhsuaxong"])){
            //lấy các thông tin sau khi đã chỉnh sửa
            $id        = $_POST["id"];
            $title     = $_POST["title"];
            $content   = $_POST["content_saukhisua"];
            $theme     = $_POST["theme"];
            if($title =="") {
                echo "<p style='color:red;'>Bạn phải tạo tiêu đề cho bài viết</p>";
            }elseif ($content =="") {
                echo "<p style='color:red;'>Bạn phải tạo nội dung cho bài viết</p>";
            }else{
                //thực hiện câu sql để thêm bài viết vào bảng database pots
                $sql_sua = "UPDATE posts SET title = '$title', content = '$content', theme = '$theme' WHERE id ='$id' ";
                //thực thi câu lệnh sql
                mysqli_query($connect, $sql_sua);
                echo "<p style='color:green;'>Bạn đã chỉnh sửa bài viết thành công!</p>";
            }     
        }
    ?>

</div>

<?php include "includes/footer.php" ?>