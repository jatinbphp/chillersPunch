$(document).ready(function() {
    $('#competitionsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', name: 'id', 'width': '10%',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'title', name: 'title'},
            { data: 'status', "width": "10%", name: 'status', orderable: false},
            { data: 'created_at', "width": "15%", name: 'created_at' },
            { data: 'actions', "width": "12%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    $('#submissionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#submission_route_name").val(),
        columns: [
            {
                data: 'id', name: 'id', 'width': '10%',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'submission_info', name: 'fullName'},
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'isWinner', name: 'isWinner', orderable: false, searchable: false },
            { data: 'actions', "width": "12%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    $('#votingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', name: 'id', 'width': '10%',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'submission_info', "width": "70%", name: 'submissionId', orderable: false},
            { data: 'ipAdress', "width": "10%", name: 'ipAdress', orderable: false},
            { data: 'created_at', "width": "10%", name: 'created_at' },
        ],
        "order": [[0, "DESC"]]
    });

    $('.datatable-dynamic tbody').on('click', '.view-info', function (event) {
        event.preventDefault();
        var url = $(this).attr('data-url');
        var id = $(this).attr("data-id");
        var selectForPrice = $(this).attr("data-select-for-price");

        $.ajax({
            url: url,
            type: "GET",
            data: {
                'id': id,
                'selectForPrice': selectForPrice
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                $('#commonModal .modal-content').html(data);
                $('#commonModal').modal('show');
            }
        });
    });
});

//Delete Record
$('.table').on('click', '.deleteRecord', function (event) {
    event.preventDefault();
    var id = $(this).attr("data-id");
    var url = $(this).attr("data-url");
    var table = $(this).attr("data-table");

    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this record?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: "No, cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                success: function(data) {
                    if (data.success) {
                        // Remove the row from the DataTable
                        $('#' + table).DataTable().row('.selected').remove().draw(false);
                        toastr.success(data.success); // Use success message from the response
                    } else {
                        toastr.error(data.error || "An error occurred while deleting the user."); // Handle any unexpected errors
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle the error
                    if (jqXHR.status === 404) {
                        toastr.error("User not found.");
                    } else if (jqXHR.status === 400) {
                        toastr.error("Deletion of a submitter is not permitted. If you need to remove a submitter, please create a new one instead."); 
                    } else if (jqXHR.status === 401) {
                        toastr.error("You can not delete this institution because it is currently assigned to users."); 
                    } else {
                        toastr.error("An unexpected error occurred: " + errorThrown);
                    }
                }
            });
        } else {
            toastr.info("Your data is safe!")
        }
    });
});