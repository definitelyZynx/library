<?php 

include_once '../includes/db.php';

header('Content-Type: application/json');

$response = array(
  "success" => false
);

$id = $_POST["bookId"];
$title = $_POST["title"];
$isbn = $_POST["isbn"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$year_published = $_POST["yearPublished"];
$category = $_POST["category"];


$sql = "UPDATE catalog SET title = ?, isbn = ?, author = ?, publisher = ?, year_published = ?, category = ? WHERE id = ?";

$result = $db->process_db($sql, [$title, $isbn, $author, $publisher, $year_published, $category, $id], false);

if($result){
  $response["success"] = true;
}

echo json_encode($response);
exit();