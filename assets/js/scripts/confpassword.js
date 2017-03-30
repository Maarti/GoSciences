$("#newpass").keyup(function() {
    if ($(this).val()) {
        $("#newpassconf").show();
    } else {
        $("#newpassconf").hide();
    }
});