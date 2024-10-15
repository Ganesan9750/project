<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form and Table</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 500px;
            max-width: 100%;
        }

        .card h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8  px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Edit Page</h2>
            <div>
                <label for="name">Mobile Number:</label>
                <input type="hidden" id='id' name="id">
                <input type="text" id="mobile" value="" name="mobile" required>
            </div>
            <br>
            <div style="margin-left:75px;">
                <label for="name">OTP:</label>
                <input type="text" id="otp" value="" name="otp" required><br><br>
            </div>
            <button style="margin-left:155px;" type="submit" id="submit" name="submit">Update</button>
    </div>
</body>
<script>
    $(document).ready(function() {
       
        var id = <?php echo json_encode(isset($_GET['id']) ? $_GET['id'] : ''); ?>;
            var mobile = <?php echo json_encode(isset($_GET['mobile']) ? htmlspecialchars_decode($_GET['mobile']) : ''); ?>;
            var otp = <?php echo json_encode(isset($_GET['otp']) ? htmlspecialchars_decode($_GET['otp']) : ''); ?>;
        if (id) {
            $("#mobile").val(mobile);
            $("#otp").val(otp);
            $("#id").val(id);
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            // alert("hi");
            var mobile = $('#mobile').val();
            var otp = $('#otp').val();
            var id = $('#id').val();
            $.ajax({
                url: 'http://localhost/api/update.php?id=' + encodeURIComponent(id),
                type: 'POST',
                data: { mobile: mobile, otp: otp },
                success: function(response) {
                    window.location.href = "index.php";
                },
            });
        });
    });
</script>

</html>