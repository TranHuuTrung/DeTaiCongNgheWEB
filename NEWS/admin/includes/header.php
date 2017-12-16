<!DOCTYPE html>
<html lang="en">
<?php 
     session_start();
     $per = $_SESSION["permision"];    
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News 24h</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/reset.css">
    <link rel="stylesheet" href="styles/css/mystyle.css">
    <link rel="stylesheet" href="styles/css/formdangki.css">
    <link rel="stylesheet" href="styles/css/thembaiviet.css">
    <link rel="stylesheet" href="styles/css/display_topic.css">
    <script src="http://localhost/news/admin/ckeditor/ckeditor.js"></script>
</head>
<body>
    <div id="wrapper">
         <div id="topbar" class="clearfix">
             <div class="wrap-inner">
                <ul id="top-menu" class=" fl-right">
                    <li class="fl-left"><a href="./quanlithanhvien.php" onClick="return checkPermision()">Manage Member</a></li>
                    <li class="fl-left"><a href="./quanlibaiviet.php">Manage News</a></li>
                    <li class="fl-left"><a href="./thembaiviet.php">Add News</a></li>
                    <li class="fl-left"><a href="./timkiemthanhvien.php">Search Member</a></li>
                    <li class="fl-left"><a href="http://">Archived News</a></li>
                    <li class="fl-left"><a href="./dangxuat.php">LogOut</a></li>
                </ul>
             </div> 
             <p  hidden id="permis"><?php echo $per; ?></p>
         </div>
         <!-- end topbar -->
         <div id="header" class="wrap-inner clearfix text-center">
             <a href="./main_of_admin.php"><img class="fl-left" src="styles/images/logo.png" alt="logo of news 24h"></a>
             <p class="clearfix">ALL THE LATEST NEWS & INFORMATION IN THE WORLD</p>
         </div>
         <!-- end header -->
<script>
    function checkPermision(){
        var ele = document.getElementById("permis");
        var con = ele.innerHTML;
        if ( con == 1) return true;
        else{
            alert ("ban khong co quyen admin");
            return false;
        }
        return false;
        
    }
</script>
         