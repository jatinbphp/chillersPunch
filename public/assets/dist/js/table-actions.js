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

    const itemsPerPage = 12;
    let currentPage = 1;
    let totalItems = 0;
    let currentData = [];

    function loadCards() {
        $.ajax({
            url: $("#submission_route_name").val(),
            method: 'GET',
            data: {
                page: currentPage,
                per_page: itemsPerPage,
            },
            success: function (response) {
                totalItems = response.total;  // Total items available from the server
                currentData = response.data;  // Data for the current page
                renderCards(currentData);     // Render the cards with the fetched data
                updatePagination(totalItems); // Update pagination controls
            },
            error: function () {
                alert('Error fetching data');
            }
        });
    }

    // Function to render the cards to the DOM
    function renderCards(cards) {
        $('#cardGrid').empty(); // Clear the existing cards

        // Loop through the cards data and create HTML for each card
        cards.forEach(function (card) {
            const cardHTML = `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card d-flex flex-fill">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="lead"><b>${card.fullName}</b></h2>
                                    
                                    <ul class="ml-0 mb-0 fa-ul text-muted">
                                        <li>
                                            Email: ${card.emailAddress}
                                        </li>
                                        <li>
                                            Phone: ${card.phoneNumber}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-3">
                                    <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary"> <i class="fas fa-user"></i> View Profile </a>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('#cardGrid').append(cardHTML);
        });
    }

    // Function to update pagination controls based on total number of items
    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        $('#pagination').empty(); // Clear existing pagination buttons

        // Generate pagination buttons
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = $('<li>')
                .addClass('page-item')
                .html(`<a class="page-link" href="#">${i}</a>`)
                .on('click', function (e) {
                    e.preventDefault();
                    currentPage = i;
                    loadCards();  // Load the data for the selected page
                });

            $('#pagination').append(pageButton);
        }
    }

    // Event listener for search input (similar to DataTable search functionality)
    $('#search-input').on('input', function () {
        currentPage = 1; // Reset to the first page when searching
        loadCards(); // Fetch the data based on the search query
    });

    // Initial load of cards
    loadCards();
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