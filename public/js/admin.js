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


    $('.addRow').click("click", function () {
        const row = $(this).parent().parent().prev();
        const clone = row.clone().find("input").val("").end();
        row.after(clone);
    });

    $('.deleteRow').click("click", function () {
        const item = $(this).attr("data-item");
        const id = $(this).attr("data-id");
        const el = $(this);
        $.ajax({
			url: "../ajax/deleteRow",
			type: "POST",
			data: { 'deleteRow' : 1, 'item' : item, 'id' : id},
			dataType: "json",
			success: function(data) {	
				if (data.success == true) {
                    el.parent().parent().fadeOut();
                } else {
                    alert("Something went wrong.  Please try again.");
                }		
            },
            error: function (data) {
                alert("Something went wrong.  Please try again.");
            }
		}, "json");
    });

    $('.deleteImage').click("click", function () {
        if (confirm("Are you sure you want to remove this image?")) {
            const item = $(this).attr("data-item");
            const club = $(this).attr("data-club");
            const section = $(this).attr("data-section");
            const el = $(this);

            $.ajax({
                url: "../ajax/deleteImage",
                type: "POST",
                data: { 'deleteImage' : 1, 'item' : item, 'club' : club, 'section' : section},
                dataType: "json",
                success: function(data) {	
                    if (data.success == true) {
                        el.parent().parent().fadeOut();
                    } else {
                        alert(data.message);
                    }		
                },
                error: function (data) {
                    alert("Something went wrong.  Please try again.");
                }
            }, "json");
        }
    });

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

function toggleImportant(club_id, notice_id) {
    $.ajax({
        url: "ajax/toggleImportant",
        type: "POST",
        data: { 'toggleImportant' : 1, 'club_id' : club_id, 'notice_id' : notice_id},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                console.log("Successfully changed important status.");		
            } else {
                alert("Something went wrong.  Please try again.");
            }
        },
        error: function (data) {
            console.log("Something went wrong.");
        }
    }, "json");
}

function toggleActive(club_id, person_id) {
    $.ajax({
        url: "../ajax/toggleActive",
        type: "POST",
        data: { 'toggleActive' : 1, 'club_id' : club_id, 'person_id' : person_id},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                console.log("Successfully changed active status.");		
            } else {
                alert("Something went wrong.  Please try again.");
            }
        },
        error: function (data) {
            console.log("Something went wrong.");
        }
    }, "json");
}


function filter(section, club_id, season, leagues) {
    $.ajax({
        url: "ajax/filter",
        type: "POST",
        data: { 'filter' : 1, 'section' : section, 'club_id' : club_id, 'season' : season, 'leagues' : leagues, 'admin' : true},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                $("#title").html(data.title);
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