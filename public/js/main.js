$(document).ready(function () {

    $('#sidebarCollapse').click(function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    setTimeout(function() {
        $(".close_alert").trigger('click');
    }, 5000);

    $('.close_alert').click(function () {
        $(this).parent().parent().fadeOut(200, function() {
            $(this).remove();
        });
        // console.log($(this).parent().parent());
    });
});