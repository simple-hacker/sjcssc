$(document).ready(function() {
    $('#league-filters label').click(function() {
        let inp = $(this).children('input');
        inp.prop("checked", !inp.prop("checked"));
        let leagues = [];
        $.each($('input[name="leagues"]:checked'), function () {
            leagues.push($(this).val());
        });
        let section = $('#section').val();
        let club_id = $('#club_id').val();
        let season = $('#season').val();

        filter(section, club_id, season, leagues);
    });

    $('#season-filters button').click(function() {
        $('#season').val($(this).attr('data-season'));
        let leagues = [];
        $.each($('input[name="leagues"]:checked'), function () {
            leagues.push($(this).val());
        });
        let section = $('#section').val();
        let club_id = $('#club_id').val();
        let season = $('#season').val();

        filter(section, club_id, season, leagues);
    });
});

function filter(section, club_id, season, leagues) {
    $.ajax({
        url: "../ajax/filter",
        type: "POST",
        data: { 'filter' : 1, 'section' : section, 'club_id' : club_id, 'season' : season, 'leagues' : leagues},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                $(".sj-heading-large").html(data.title);
                $("#table").hide().html(data.html).fadeIn();
            } else {
                alert("Error: "+data.message);
            }
        },
        error: function (request, status, error) {
            alert("Fatal error: "+error);
        }
    }, "json");
}