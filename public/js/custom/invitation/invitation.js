$(".remove-invitation").on("click", function (e) {
    e.preventDefault();
    var invitedID = $(this).data("id");
    swal({
        title: "Do you want to remove email?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: "/home/invitations" + "/" + invitedID,
                success: function (data) {
                    var row = $("#row-" + invitedID);
                    row.addClass("bg-danger");
                    row.hide(2000, function () {
                        this.remove();
                    });
                    $("#invitedCOunt").html($("#invitedCuntVal").val()-1);
                },
                error: function (data) {
                    alert("Error!");
                },
            });
        }
    });
});
