<?php require_once 'templates/_header.php';

function deleteItem($db) {
  $getid = $_POST['id'];

  $external_database = new AIDADatabase('mysql','FinestWeb.db.9997411.hostedresource.com','FinestWeb','FinestWeb','Dat92083368!');


  $external_database->query("DELETE FROM Bug WHERE id = '$getid'");
}
deleteItem($db);
