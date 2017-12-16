
<?php
     //xóa bỏ session
    //    unset($_SESSION);
       session_destroy();
       header('Location: http://localhost/news/index.php');
?>