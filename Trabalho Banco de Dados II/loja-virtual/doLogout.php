<?php

	session_start();

	$token = md5(session_id());
	
	if(isset($_GET['token']) && $_GET['token'] === $token) {
        setcookie('login', '', 1);
        setcookie('senha', '', 1);
        setcookie('idTipoConta', '', 1);
		session_destroy();
	    header("location: index.php");
	   exit();
	} else {
	   echo '<a href="doLogout.php?token='.$token.'>Confirmar logout</a>';
	}

?>