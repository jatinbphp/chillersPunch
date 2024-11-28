(function () {
    const $menu = $('.menu-toggle');
    const onMouseUp = (e) => {
        if (!$menu.is(e.target) && $menu.has(e.target).length === 0) {
            $menu.removeClass('is-active');
        }
    };

    $('.toggle').on('click', () => {
        $menu.toggleClass('is-active').promise().done(() => {
            if ($menu.hasClass('is-active')) {
                $(document).on('mouseup', onMouseUp);
            } else {
                $(document).off('mouseup', onMouseUp);
            }
        });
    });
})();

$('.listen-vote-main').on('click', '.play-button', function (event) {
    event.preventDefault();
    var url = $(this).attr('data-url');
    var id = $(this).attr("data-id");

    $.ajax({
        url: url,
        type: "GET",
        data: {
            'id': id
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        success: function(data){
            $('#commonModal .modal-content').html(data);
            $('#commonModal').modal('show');
        }
    });
});

document.addEventListener('livewire:init', function () {
    Livewire.on('showsuccessalert', () => {
        $('#myModal').modal('hide');
        swal("Success!", "Your submission has been successfully submitted!", "success");
    });

    Livewire.on('exitsErroralert', () => {
        swal("Error!", "You have already submitted to this competition with this email address.", "error");
    });

    Livewire.on('notExitsCompetitionalert', () => {
        swal("Error!", "The selected competition is not active or does not exist.", "error");
    });
});

$('.listen-vote').on('click', '.vote-button', function (event) {
    event.preventDefault();
    const button = $(this); // Reference to the clicked button
    const voteId = button.data('vote-id'); // Get vote ID from data attribute

    swal({
        title: "Are you sure?",
        text: "Do you want to cast your vote?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Yes, Vote',
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {

            var url = $('#submission-add-vote').val();

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'id': voteId
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                success: function(data){
                    
                    if (data.success) {
                        swal("Success!", data.success, "success");
                    } else {
                        swal("Warning", data.error, "warning");
                    }
                }
            });
        } else {
            swal("Cancelled", "Your data safe!", "error");
        }
    });
});
AOS.init({
    duration: 1200,
})
