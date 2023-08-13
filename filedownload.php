<?php
if(isset($_REQUEST['file'])) {
	$file = urldecode($_REQUEST['file']);
	$path = 'boardImg/'.$file;
	
	if(file_exists($path)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($path).'"');
		header('Content-Length: '.filesize($path));
		readfile($path);
		flush();
		exit;
	}
}
?>