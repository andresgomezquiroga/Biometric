
// Para las datables
$(function () {

    // Datable user
  $("#users").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": [
      {
        "extend": "pdf",
        "className": "btn-danger mr-2",
        "exportOptions": {
          "columns": [0, 1, 2, 3, 4, 5, 6]  
        }
      },
      {
        "extend": "colvis",
        "className": "btn-info",
      }
    ]    
  }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');

});



