<?php include("includes/conection.php"); ?>
<?php include("includes/header.php") ?>
<?php 
   if (isset($_POST['selected'])) {
   	//thực hiện 1 câu lệnh sql để xóa
   	$type = $_REQUEST['selected'];
    $info = $_REQUEST['info'];
    $column = null;
    if ($type == 0)
        $column ="fullname";
    if ($type == 1)
        $column ="email";
    $query= "select * from users where ".$column."='".$info."'";
    $result = mysqli_query($connect, $query);
   }
  ?> 
   <div id="wrapper_qlithanhvien">
   <!-- phần main -->
   <div id="main_content" class="wrap-inner">
       <table class="table table-hover">
           <caption><h3>Kết quả tìm kiếm thông tin</h3></caption>
           <thead>
               <tr>
               <th scope="col">ID</th>
               <th scope="col">Username</th>
               <th scope="col">Email</th>
               <th scope="col">Fullname</th>
               <th scope="col">CreateDate</th>
               </tr>
           </thead>
           <tbody>
               <?php
               //vòng lặp để lấy ra thông tin các thành viên
               //mysqli_fetch_assoc() dùng các tên của trường để truy xuất còn aray dùng chỉ số 0,1, ....

                   $i = 1 ;
               while ($data = mysqli_fetch_array($result)) {
                       $id = $data['id'];
               ?>
               <tr>
               <th scope="row"><?php echo $id; ?></th>
               <td><?php echo $data['username'];?></td>
               <td><?php echo $data['email']; ?></td>
               <td><?php echo ($data['fullname'])?></td>
               <td><?php echo ($data['createdate'])?></td>
               </tr>
               <?php 
                 $i ++;
               } 
               ?>
           </tbody>
       </table>
       <button class="btn btn-primary" onClick="TroLai()">Back</button>
       <script>
            function TroLai(){
                         window.location.href="./timkiemthanhvien.php";
            }
       </script>
       <!-- giải phóng biến kết nối -->
       <?php
       //    giải phóng các tập bản ghi
           mysqli_free_result($result); 
           //giải phóng biến connect
           mysqli_close($connect); 
       ?>
   </div>


<?php include("includes/footer.php"); ?>