function changeSeason(club_id, season) {
    $.ajax({
        url: "../ajax/changeSeason",
        type: "POST",
        data: { 'changeSeason' : 1, 'club_id' : club_id, 'season' : season},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                // console.log(data);
                $(".sj-heading-large").html(data.title);
                $("#results").hide().html(data.html).fadeIn();
            } else {
                console.log("Something went wrong.  Please try again.");
            }
        },
        error: function (data) {
            // console.log(data);
            console.log("Error with ajax.");
        }
    }, "json");
}

function changeYear(club_id, season) {
    $.ajax({
        url: "../ajax/changeYear",
        type: "POST",
        data: { 'changeYear' : 1, 'club_id' : club_id, 'season' : season},
        dataType: "json",
        success: function(data) {
            if (data.success == true) {
                // console.log(data);
                $(".sj-heading-large").html(data.title);
                $("#reports").hide().html(data.html).fadeIn();
            } else {
                console.log("Something went wrong.  Please try again.");
            }
        },
        error: function (data) {
            // console.log(data);
            console.log("Error with ajax.");
        }
    }, "json");
}
