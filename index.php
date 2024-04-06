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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="index.css">
</head>

<body>
  <div class="w-100 h-100 p-5">
    <h2>-=-=- Simple Book Catalog -=-=-</h2>
    <div class="d-flex flex-column gap-3">
      <div class="d-flex justify-content-end">
        <button class="btn btn-success px-5" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
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
          $count = 0;

          foreach ($result as $row) {
            $count++;
          ?>
            <tr>
              <td><?php echo $row["title"] ?></td>
              <td><?php echo $row["isbn"] ?></td>
              <td><?php echo $row["author"] ?></td>
              <td><?php echo $row["publisher"] ?></td>
              <td><?php echo $row["year_published"] ?></td>
              <td><?php echo $row["category"] ?></td>
              <td>
                <div class="d-flex flex-row gap-1" style="width: fit-content">
                  <button class="btn btn-secondary" onclick="editBook(<?php echo $row['id'] ?>)" data-bs-toggle="modal" data-bs-target="#editModal">EDIT</button>
                  <button class="btn btn-danger" onclick="deleteBook(<?php echo $row['id'] ?>)">DELETE</button>
                </div>
              </td>
            </tr>
          <?php
          }

          if($count <= 0){
          ?>
            <tr>
              <td colspan="7">
                <div class="w-100 text-center">
                  No Data.
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

  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Book</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="add_form" method="POST" action="./modules/add-book.php" class="d-flex flex-column w-100 h-100 px-3">
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" placeholder="Enter Book Title" required>
            </div>
            <div class="mb-3">
              <label for="bookIsbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" name="isbn" placeholder="Enter ISBN" required>
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Author</label>
              <input type="text" class="form-control" name="author" placeholder="Enter Author" required>
            </div>
            <div class="w-100 d-flex flex-row gap-3">
              <div class="mb-3 w-100">
                <label for="bookPublisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" name="publisher" placeholder="Enter Publisher" required>
              </div>
              <div class="mb-3 w-100 flex-grow-1">
                <label for="bookYear" class="form-label">Year Published</label>
                <input type="number" class="form-control" name="yearPublished" placeholder="Enter Year Published" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="bookCategory" class="form-label">Category</label>
              <input type="text" class="form-control" name="category" placeholder="Enter Category" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="add_form" class="btn btn-primary" data-bs-dismiss="modal">Add Book</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Book</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit_form" method="POST" action="./modules/edit-book.php" class="d-flex flex-column w-100 h-100 px-3">
            <input hidden name="bookId" id="bookId" value="">
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="bookTitle" placeholder="Enter Book Title" required>
            </div>
            <div class="mb-3">
              <label for="bookIsbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" name="isbn" id="bookIsbn" placeholder="Enter ISBN" required>
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Author</label>
              <input type="text" class="form-control" name="author" id="bookAuthor" placeholder="Enter Author" required>
            </div>
            <div class="w-100 d-flex flex-row gap-3">
              <div class="mb-3 w-100">
                <label for="bookPublisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="bookPublisher" placeholder="Enter Publisher" required>
              </div>
              <div class="mb-3 w-100 flex-grow-1">
                <label for="bookYear" class="form-label">Year Published</label>
                <input type="number" class="form-control" name="yearPublished" id="bookYear" placeholder="Enter Year Published" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="bookCategory" class="form-label">Category</label>
              <input type="text" class="form-control" name="category" id="bookCategory" placeholder="Enter Category" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="edit_form" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script src="./includes/functions.js"></script>
<script>
  $(document).ready(function() {
    $('#add_form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: "Your book has been saved.",
              showConfirmButton: false,
              timer: 1500,
              willClose: () => {
                window.location.href = "index.php";
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error!",
              text: response.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });

    $('#edit_form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: "Your changes has been saved.",
              showConfirmButton: false,
              timer: 1500,
              willClose: () => {
                window.location.href = "index.php";
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error!",
              text: response.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>

</html>