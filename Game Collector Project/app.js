const successMsg = $(".alert-success");

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'manual'
    });

    $('form [data-toggle="tooltip"]').focus(function() {
        $(this).tooltip('hide');
    });

    var profileValidator = $("form[name='profileCreate']").validate({

        rules: {
            // required fields in order for form to submit
            firstName: "required",
            lastName: "required",
            age: { // restricts letters for the age
                required: true,
                number: true
            },

            strAddr: "required",
            city: "required",
            state: "required",
            zip: {
                required: true,
                number: true
            }
        },

        errorPlacement: function(error, element) {
            $(element).tooltip('show');
        },

        success: function(label, element) {
            $(element).tooltip('hide');
        },

        errorClass: "warning",
        focusInvalid: false,

        submitHandler: function(form, e) {
            // Show success and disable form buttons
            successMsg.fadeIn(1000).fadeOut(1000);

            $("button[type='reset']").attr("disabled", true);
            $("button[type='submit']").attr("disabled", true);

            setTimeout(function() {
                // After 2 seconds, submit form and re-enable buttons
                form.submit();

                $("button[type='reset']").attr("disabled", false);
                $("button[type='submit']").attr("disabled", false);
            }, 2000);
        }
    });

    $('button[name="clearProfile"]').click(function() {
        profileValidator.resetForm();
        $('[data-toggle="tooltip"]').tooltip('hide');
    });

    var listingValidator = $("form[name='listingCreate']").validate({
        rules: {
            // required fields in order for form to submit
            title: "required",
            description: "required",
            price: {
                required: true,
                number: true
            }
        },

        errorPlacement: function(error, element) {
            $(element).tooltip('show');
        },

        success: function(label, element) {
            $(element).tooltip('hide');
        },

        errorClass: "warning",
        focusInvalid: false,

        submitHandler: function(form, e) {
            // Show success and disable form buttons
            successMsg.fadeIn(750).fadeOut(750);

            $("button[type='reset']").attr("disabled", true);
            $("button[type='submit']").attr("disabled", true);

            setTimeout(function() {
                // After 2 seconds, submit form and re-enable buttons
                form.submit();

                $("button[type='reset']").attr("disabled", false);
                $("button[type='submit']").attr("disabled", false);

            }, 1500);
        }
    });

    $('button[name="clearListing"]').click(function() {
        // reset error classes and hide tooltips
        listingValidator.resetForm();
        $('[data-toggle="tooltip"]').tooltip('hide');
    });

    $("#sendMsg").click(function() {
        $("#messageBox").val('');
        $("#messageSuccess").fadeIn(1000).fadeOut(1000);
    });
});

function toggleListing() {
    $("#listingItem").toggleClass('disabled');
    $("#listingLink").toggleClass('disabled');
    $("#listingItem").attr('data-toggle', 'tooltip');
    $("#listingItem").attr('data-placement', 'bottom');
    $("#listingItem").attr('title', 'Please create a profile');
    $('#listingItem').tooltip({
        trigger: 'hover'
    });


}