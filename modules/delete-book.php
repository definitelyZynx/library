<?php 

include_once '../includes/db.php';

header('Content-Type: application/json');

$response = array(
  "success" => false
);

$id = $_POST["bookId"];

$sql = "DELETE FROM catalog WHERE id = ?";
$result = $db->process_db($sql, [$id], false);

if($result){
  $response["success"] = true;
}

echo json_encode($response);
exit();