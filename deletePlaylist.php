<?php require_once 'templates/_header.php';

function deleteItem($db) {
	$getid = $_POST['id'];

	$db->query("DELETE FROM playlist WHERE id = '$getid'");
}
deleteItem($db);