<?php
include "header.php";

if($include!='view/login.php'){
	include "topmenu.php";

?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
    	<?php include $include; ?>
	</div>		
</div>
<?php
}else{
	include $include;
}

include "footer.php";
?>