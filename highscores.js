// Function to retrieve high scores from the server
function getHighScores(game) {
    $.ajax({
        url: "getHighScores.php",
        type: "POST",
        data: { game: game },
        success: function(scores) {
            // Parse the JSON response from the server
            var scoreData = JSON.parse(scores);
            // Clear the existing table rows
            $("#scoreTableBody").empty();
            // Add a row for each high score
            for (var i = 0; i < scoreData.length; i++) {
                var rank = i + 1;
                var player = scoreData[i].player;
                var score = scoreData[i].score;
                var row = $("<tr>");
                row.append($("<td>").text(rank));
                row.append($("<td>").text(player));
                row.append($("<td>").text(score));
                $("#scoreTableBody").append(row);
            }
        }
    });
}

// Call the getHighScores function to initially populate the table
getHighScores("game1");

// Set up an interval to update the table every 10 seconds
setInterval(function() {
    getHighScores("game1");
}, 10000);