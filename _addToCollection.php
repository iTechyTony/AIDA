<?php require_once 'templates/_header.php';?>

<?php

function getPlaylistInfo($db) {
	$getid = $_POST['id'];
	$sql   = 'SELECT * FROM playlist WHERE id='.$getid;
	try {

		$stmt = $db->prepare($sql);
		$stmt->execute();

		$stmt->bindColumn(1, $id);
		$stmt->bindColumn(2, $name);
		$stmt->bindColumn(3, $artist);
		$stmt->bindColumn(4, $album);
		$stmt->bindColumn(5, $genre);
		$stmt->bindColumn(6, $rating);
		$stmt->bindColumn(7, $song);
		$stmt->bindColumn(7, $image);
		$stmt->bindColumn(9, $price);
		$stmt->bindColumn(10, $description);

		$row = $stmt->fetch(PDO::FETCH_BOUND);

		$item = new Item($id, $name, $price, $description);

		$item->setArtist($artist);

		$_SESSION["quantity"] = $_POST['quantity'];
		$quantity             = $_SESSION["quantity"];

		//Use new collection or existing one
		$ca = $_SESSION["ObjColl"];

		$ca->addItem($item);
		$ca->updateItem($item, $quantity);

		header("Location: collection_app.php");
		exit();

	} catch (PDOException $e) {
		print$e->getMessage();
	}
}
getPlaylistInfo($db);

?>




