<?php 

include_once '../includes/db.php';

header('Content-Type: application/json');

$response = array(
  "id" => 0,
  "title" => "",
  "isbn" => "",
  "author" => "",
  "publisher" => "",
  "year_published" => 0,
  "category" => "",
);

$id = $_GET["bookId"];

$sql = "SELECT * FROM catalog WHERE id = ?";
$result = $db->process_db($sql, [$id], true);

foreach($result as $book){
  $response["id"] = $book["id"];
  $response["title"] = $book["title"];
  $response["isbn"] = $book["isbn"];
  $response["author"] = $book["author"];
  $response["publisher"] = $book["publisher"];
  $response["year_published"] = $book["year_published"];
  $response["category"] = $book["category"];
}

echo json_encode($response);
exit();
