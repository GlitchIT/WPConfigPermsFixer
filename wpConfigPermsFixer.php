<?php
/*
*  @title 		WPConfig Perms fixer - checks all the user public_html for the wp-config.php and set to read only by user 
*  @author 		Aaron Toomey <aaron@glitch-it.com.au>
*  @created 	2016-08-17
*  @modified 	2016-08-18
*
*/


echo 'Perms fixer starting:'.PHP_EOL.PHP_EOL;

$subs = glob('/home/*' , GLOB_ONLYDIR);
$i = 0;

foreach($subs as $user){
	$cPath = "$user/public_html/wp-config.php";
	if(file_exists($cPath)){
		echo " File exists, changing $cPath to read only by owner".PHP_EOL;
		if(chmod($cPath,0600)){
			echo "  fixed it's perms.".PHP_EOL;
			$i++;
		}else{
			echo "   ERROR: couldn't change perms.".PHP_EOL;
		}
	}else{
		echo " Wp-Config not found for this user: $cPath".PHP_EOL;
	}
}

echo PHP_EOL.PHP_EOL."Found and fixed perms for $i files.".PHP_EOL;

?>
