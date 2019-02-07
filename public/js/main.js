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
        row = $(this).parent().parent().prev();
        clone = row.clone().find("input").val("").end();
        row.after(clone);
    });

    $('.deleteRow').click("click", function () {
        item = $(this).attr("data-item");
        id = $(this).attr("data-id");
        el = $(this);
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
                console.log("Something went wrong.");
            }
		}, "json");
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