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
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Form Page</h2>
        <form action="http://localhost/api_bulk_upload/create.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Upload File:</label>
                <input type="file" id="file" value="" name="file" required><br><br>
            </div>
            <button style="margin-left:155px;" type="submit" id="submit" name="submit">Submit</button>
        </form>
    </div>

    <div class="card">
        <h2>Table</h2>
        <table id="nameTable">
            <thead>
                <tr>
                    <th>Mobile</th>
                    <th>Otp</th>
                </tr>
            </thead>
            <tbody id="data">

            </tbody>
        </table>
    </div>
</body>
<script>
    goat();

    function goat() {
        fetch("http://localhost/api_bulk_upload/read.php").then(
            res => {
                res.json().then(
                    data => {
                        if (data.data.length > 0) {
                            var temp = "";

                            data.data.forEach((idemdata) => {
                                temp += "<tr>";
                                temp += "<td>" + idemdata.mobile + "</td>";
                                temp += "<td>"+ idemdata.otp + "</td></tr>";
                            });
                            document.getElementById('data').innerHTML = temp;
                        } // if close
                    } //data close
                ) //then close
            } //res close
        );
    }
</script>

</html>