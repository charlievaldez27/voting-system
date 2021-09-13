<?php

if(isset($_POST['new11'])){
	if ($_POST['new11'] == $_POST['confirm22']) {
		echo "<p style = 'color: #06cce0; font-size: 12px'>password matched</p>";
	}
	else{
		echo "<p style = 'color: red; font-size: 12px'>password not matched</p>";
	}
}

?>