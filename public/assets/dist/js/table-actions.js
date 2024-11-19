$(document).ready(function() {
    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', name: 'id',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'institution_name', name: 'institution_name', orderable: false},
            { data: 'fullname', name: 'fullname' },
            { data: 'email', name: 'email' },
            { data: 'status', "width": "10%", name: 'status', orderable: false}, 
            { data: 'role', "width": "10%", name: 'role', orderable: false},  
            { data: 'created_at', "width": "15%", name: 'created_at' },
            { data: 'actions', "width": "12%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    $('#institutionsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', name: 'id',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'institutionName', name: 'institutionName'},
            { data: 'status', "width": "10%", name: 'status', orderable: false},
            { data: 'submitter_name', name: 'submitter_name', orderable: false},  
            { data: 'created_at', "width": "15%", name: 'created_at' },
            { data: 'actions', "width": "12%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    $('#reportingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#route_name").val(),
        columns: [
            {
                data: 'id', name: 'id',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'institutionName', name: 'institutionName'},
            { data: 'progress_bar', name: 'progress_bar', searchable: false},
            { data: 'actions', "width": "15%", name: 'actions', orderable: false, searchable: false },
        ],
        "order": [[0, "DESC"]]
    });

    var institutionId = $('#institution_id').val();
    $('#institutionsUserTable').DataTable({
        processing: true,
        serverSide: true,
        // ajax: $("#route_name").val(),
        ajax: {
            url: $("#route_name").val(),
            type: 'GET',
            data: function(d) {
                d.institution_id = institutionId; 
            }
        },
        columns: [
            {
                data: 'id', name: 'id',
                render: function(data, type, row) {
                    return '#' + data; // Prepend '#' to the 'id' data
                }
            },
            { data: 'fullname', name: 'fullname' },
            { data: 'email', name: 'email' },
            { data: 'designation', name: 'designation' },
            { data: 'status', "width": "10%", name: 'status', orderable: false},  
            { data: 'created_at', name: 'created_at' },
        ],
        "order": [[0, "DESC"]],
        lengthMenu: [ [5, 10, 25, 50,], [5, 10, 25, 50,] ]
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

$(document).ready(function() {
    $('.policy-select').change(function() {
        var value = $(this).val();
        var question_id = $(this).attr("data-question-id");
        if(value==1 || value==2 || value=='Yes'){
            $('.additional-fields-'+question_id).show();
        } else{
            $('.additional-fields-'+question_id).hide();
        }
    });

    $('.removeQueImg').on('click', function(){
        var url = $(this).data('url');
        var iKey = $(this).data('ikey');
        
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this image?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel"
        }).then((result) => {
            if (result.isConfirmed) {

                $('.loading-spinner-main').css("display", "flex");

                $.ajax({
                    url: url,
                    type: "DELETE",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    success: function(data) {
                        if (data.success) {
                          $('#' + iKey).remove();
                          toastr.success(data.success);
                        } else {
                          toastr.error(data.error || "An error occurred while deleting the user."); // Handle any unexpected errors
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
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

                setTimeout(() => {
                    $('.loading-spinner-main').css("display", "none");
                }, 1000);
            } else {
                toastr.info("Your data is safe!")
            }
        });
    });
});

function formatNumber(input, flag = 2) {
    if (input.value === '') {
        return;
    }

    const isValid = /^(\d+(\.\d*)?|\.\d+)?$/.test(input.value);
    if (flag == 1 && input.value === '.') {
        input.value = '0.0';
    }
    
    if (isValid && flag == 1) {
        return;
    }

    let value = input.value.replace(/,/g, ''); 
    var isValidInput = /^\d*$/.test(value);
    
    if (!isValidInput) {
        input.value = value.slice(0, -1); // Remove last character
        return;
    }

    // Save the cursor position
    const selectionStart = input.selectionStart;

    let number = parseFloat(value);

    if (isNaN(number)) {
        input.value = '';
        return;
    }

    if (flag === 0) {
        input.value = number;
    } else if (flag === 2) {
        input.value = number.toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        });
    }

    // Restore the cursor position after formatting
    const newLength = input.value.length;
    const diff = newLength - value.length;
    input.setSelectionRange(selectionStart + diff, selectionStart + diff);

}