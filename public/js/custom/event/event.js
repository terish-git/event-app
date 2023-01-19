$(function () {
    $('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        // autoUpdateInput: false,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10),
        autoApply: true,
        locale: { format: "DD-MM-YYYY" },
    });

    $('input[name="end_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        // autoUpdateInput: false,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10),
        autoApply: true,
        locale: { format: "DD-MM-YYYY" },
    });
});

if ($("#eventForm").length > 0) {
    validator = $("#eventForm").validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter event name",
            },
        },
    });
}

$(".inviteUsers").on("click", function (event) {
    event.preventDefault();
    var eventId = $(this).data("id");
    $.ajax({
        type: "GET",
        url: "/home/events/" + eventId + "/edit",
        success: function (data) {
            $("#eventHeading").html(data.name);
            $("#eventID").val(eventId);
            $("#inviteUserModal").modal("show");
        },
    });
});

$(".delete-event").on("click", function (e) {
    e.preventDefault();
    var eventId = $(this).data("id");
    swal({
        title: "Do you want to delete event?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: "events" + "/" + eventId,
                success: function (data) {
                    if (data.error == true) {
                        swal({ text: data.message, icon: "error" });
                    } else {
                        swal(data.message);
                        location.reload();
                    }
                },
                error: function (data) {
                    alert("Error!");
                },
            });
        }
    });
});
