<?php

define('API_VER', 'v2.1.1');

if(is_dir(dirname(__FILE__)."/".API_VER)) {
	header("Location: ./".API_VER);
} else {
	$error = new stdClass();
	$error->error = true;
	$error->description = 'INVALID_API_VERSION';
	echo json_encode($error);
	exit;
}