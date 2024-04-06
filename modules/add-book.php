<?php 

include_once '../includes/db.php';

header('Content-Type: application/json');

$response = array(
  "success" => false
);

$title = $_POST["title"];
$isbn = $_POST["isbn"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$year_published = $_POST["yearPublished"];
$category = $_POST["category"];


$sql = "INSERT INTO catalog(title, isbn, author, publisher, year_published, category) VALUES (?, ?, ?, ?, ?, ?)";

$result = $db->process_db($sql, [$title, $isbn, $author, $publisher, $year_published, $category], false);

if($result){
  $response["success"] = true;
}

echo json_encode($response);
exit();