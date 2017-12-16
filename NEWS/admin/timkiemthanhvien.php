<?php include("includes/conection.php") ?>
<?php include("includes/header.php") ?>

<div id="main_content" class="wrap-inner">
	<form action="xulitimkiemthanhvien.php" method="post" onsubmit="return check()">
		<table style="margin:auto">
			<caption style="margin-left:100px;display:block"><h3>Tìm kiếm thông tin thành viên</h3></caption>
			<tr style="margin:30px;display:block">
				<td style="margin-right:10px;display:inline-block"> 
					<select onchange="setname()" id="mylist" >
						<option>By FullName</option>
						<option>By Email</option>
					</select> 
				</td>
				<td style="display:inline-block">  <input name="info"	type="text" size="20"></td>
			</tr>
		</table>
		<input type="hidden" name="selected">
				
		<div class="button" style="margin-left:420px">
			<input class="btn btn-primary" type="submit" value="Search">
			<input class="btn btn-primary" type="reset" value="Reset">
		</div>
	</form>
</div>
<script>
    function setname(){
	var e = document.getElementById("mylist");
	var index = e.selectedIndex;
	var e1 = document.getElementsByName("selected")[0];
	e1.value = index;
}
    function check(){
	var e = document.getElementsByName("info")[0];
	if (!e.value) {
		alert("Mời bạn nhập thông tin tìm kiếm");
		return false;
		}
	else return true;}
</script>
<?php include("includes/footer.php"); ?>