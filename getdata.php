<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap API Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">API Data in Bootstrap Cards</h2>
    <div class="row" id="dataContainer"></div>
</div>

<script>
$(function() {
    $.ajax({
        url: "get.php", // Assuming this returns JSON data
        method: "GET",
        success: function(response) {
            let output = response.slice(0, 20).map((post, index) => {
                let shortTitle = post.title.substring(0, 15) + "...";
                let shortBody = post.body.substring(0, 50) + "...";
                return `
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title" id="title-${index}">${shortTitle}</h5>
                                <p class="card-text" id="body-${index}">${shortBody}</p>
                                <button class="btn btn-primary read-more" data-index="${index}" data-fulltitle="${post.title}" data-fullbody="${post.body}">Read More</button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
            $("#dataContainer").html(output);

            $(".read-more").click(function() {
                let index = $(this).data("index");
                $("#title-" + index).text($(this).data("fulltitle"));
                $("#body-" + index).text($(this).data("fullbody"));
                $(this).remove(); // Remove button after expanding
            });
        },
        error: function() {
            $("#dataContainer").html("<p class='text-danger'>Error fetching data</p>");
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
