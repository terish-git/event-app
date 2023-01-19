$(function () {
    $('input[name="date_of_birth"]').daterangepicker(
        {
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10),
            autoApply: true,
            locale: { format: "DD-MM-YYYY" },
        },
        function (start, end, label) {
            var years = moment().diff(start, "years");
        }
    );

    if ($("#userRegistrationForm").length > 0) {
        validator = $("#userRegistrationForm").validate({
            rules: {
                first_name: {
                    required: true,
                },
                email: {
                    required: true,
                    emailFormat: true,
                    remote: { url: "common/is-unique-email", type: "POST" },
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password",
                },
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                },
                email: {
                    required: "Please enter E-mail",
                    remote: "E-mail already existing",
                },
                password: {
                    required: "Please enter password",
                    maxlength: "Length cannot be more than 15 characters",
                    minlength: "Length must be minimum 6 characters",
                },
                password_confirmation: {
                    required: "Confirm Password is required",
                    equalTo: "Password not matching",
                },
            },
        });
    }
    jQuery.validator.addMethod(
        "emailFormat",
        function (value, element) {
            return (
                this.optional(element) ||
                /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/gim.test(value)
            );
        },
        "Please enter a valid E-mail address"
    );
});
