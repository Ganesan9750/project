<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <form action="#" id="myForm" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" id="image"><br><br>
        <button type="button" id="confirmButton"> Submit</button>
    </form>
</body>
<script>
    $(document).ready(function() {
        $("#confirmButton").click(function() {
            var formData = new FormData($('#myForm')[0]);

                $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    success: function(response) {

                    }
                });
            
        });

    });
</script>
</html>