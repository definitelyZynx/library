<?php
include_once './includes/db.php';

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Book Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

  <link rel="stylesheet" href="index.css">
</head>

<body>
  <div class="w-100 h-100 p-5">
    <div class="d-flex flex-column gap-3">
      <div class="d-flex justify-content-end">
        <button class="btn btn-success px-5">Add</button>
      </div>
      <table class="table w-100">
        <thead>
          <tr>
            <th scope="col">TITLE</th>
            <th scope="col">ISBN</th>
            <th scope="col">AUTHOR</th>
            <th scope="col">PUBLISHER</th>
            <th scope="col">YEAR PUBLISHED</th>
            <th scope="col">CATEGORY</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM catalog";
          $result = $db->process_db($sql, [], true);

          foreach ($result as $row) {
          ?>
            <tr>
              <td><?php echo $row["title"] ?></td>
              <td><?php echo $row["isbn"] ?></td>
              <td><?php echo $row["author"] ?></td>
              <td><?php echo $row["publisher"] ?></td>
              <td><?php echo $row["year_published"] ?></td>
              <td><?php echo $row["category"] ?></td>
              <td>
                <div class="d-flex flex-row gap-1">
                  <button class="btn btn-secondary">EDIT</button>
                  <button class="btn btn-secondary">DEL</button>
                </div>
              </td>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>

</script>

</html>