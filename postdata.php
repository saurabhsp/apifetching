<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"), true);
    
    if ($data && isset($data["title"]) && isset($data["body"])) {
        echo json_encode(["message" => "Data received", "receivedData" => $data]);
    } else {
        echo json_encode(["error" => "Invalid data"]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit JSON Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <form id="dataForm">
        <input type="text" id="title" placeholder="Title" required><br><br>
        <textarea id="body" placeholder="Body" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>

    <script>
        $(function() {
            // When the form is submitted
            $("#dataForm").on("submit", function(e) {
                e.preventDefault();

                var title = $("#title").val();
                var body = $("#body").val();
                
                // Send the JSON data via AJAX
                $.ajax({
                    url: "postdata.php",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ title: title, body: body }),
                    success: function(response) {
                        alert(JSON.stringify(response, null, 2));
                    }  
                });
            });
        });
    </script>

</body>
</html>
