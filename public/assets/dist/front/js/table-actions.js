$(document).ready(function() {
    var competitions_table = $('#competitionsTable').DataTable({
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

    var submissions_table = $('#submissionTable').DataTable({
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
            { data: 'votings_count', name: 'votings_count', searchable: false },
            { data: 'status', name: 'status', searchable: false },
            { data: 'isWinner', name: 'isWinner', searchable: false },
            { data: 'actions', "width": "12%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    var votings_table = $('#votingTable').DataTable({
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

    var sectionTableMap = {
        'competitions': competitions_table,
        'submissions': submissions_table,
        'votings': votings_table
    };

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

    //Status Update
    $('.table').on('click', '.ladda-button', function (event) {
        event.preventDefault();

        var clickedElement = $(this);
        var type = clickedElement.attr("data-type");
        var url = clickedElement.attr('data-url');
        var id = clickedElement.attr("data-id");
        var table_name = clickedElement.attr("data-table_name");
        var section = clickedElement.attr("data-table_name");
        var l = Ladda.create(clickedElement[0]);

        if(table_name == 'competitions' && type == 'unassign'){
            swal("Warning", "You cannot deactivate all competitions. At least one competition must remain active.", "warning");
            return false;
        }

        $.ajax({
            url: url,
            type: "post",
            data: {
                'id': id,
                'type': type,
                'table_name': table_name,
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                console.log(data);

                l.stop();
                if (type === 'unassign') {
                    $('#assign_remove_'+id).hide();
                    $('#assign_add_'+id).show();
                } else {
                    $('#assign_remove_'+id).show();
                    $('#assign_add_'+id).hide();
                }
                var table = sectionTableMap[section];
                if (table) {
                    table.draw(false);
                }

                if(table_name == 'submissions'){
                    $('#totalWinners').text(data.totalWinners);
                }
            }
        });
    });

    //Submitssion Status Update
    $('.table').on('change', '.updateSubmissionStatus', function (event) {
        event.preventDefault();

        var clickedElement = $(this);
        var id = clickedElement.attr("data-id");
        var url = $('#submission_status_route_name').val();
        var status = $(this).val();
        
        $.ajax({
            url: url,
            type: "post",
            data: {
                'id': id,
                'status': status              
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                console.log(data);
                if(data == 1){
                  swal("Success", "Submission status has been updated", "success");
                }else{
                  swal("Error", "Submission status not updated. Please try again!", "error");
                }
            }
        });
    });
});

function viewVotingListFunction(submissionId){

    if ($.fn.DataTable.isDataTable('#viewVotingListTable')) {
        $('#viewVotingListTable').DataTable().destroy();
    }

    $('#viewVotingListTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#submission_voting_route_name").val(),
            type: "get",
            data: {
                submissionId: submissionId 
            }
        },
        columns: [
            { data: 'ipAdress', name: 'ipAdress' },
            { data: 'created_at', name: 'created_at' }
        ],
        "order": [[0, "DESC"]]
    });
}