function editBook(id) {
  $.ajax({
    type: 'GET',
    url: './modules/get-book.php',
    data: {
      bookId: id
    },
    success: function(response) {
      $('#bookId').attr("value", response.id);
      $('#bookTitle').val(response.title);
      $('#bookIsbn').val(response.isbn);
      $('#bookAuthor').val(response.author);
      $('#bookPublisher').val(response.publisher);
      $('#bookYear').val(response.year_published);
      $('#bookCategory').val(response.category);

      $('#editModal').modal('show');
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function deleteBook(id){
  $.ajax({
      type: 'POST',
      url: './modules/delete-book.php',
      data: {bookId: id},
      success: function(response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: "Your book has been deleted.",
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
}