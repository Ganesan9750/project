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
        <form action="http://localhost/api/create.php" method="POST">
            <div>
                <label for="name">Mobile Number:</label>
                <input type="text" id="mobile" value="" name="mobile" required>
            </div>
            <br>
            <div style="margin-left:75px;">
                <label for="name">OTP:</label>
                <input type="text" id="otp" value="" name="otp" required><br><br>
            </div>
            <button style="margin-left:155px;" type="submit" id="submit" name="submit">Submit</button>
        </form>
    </div>

    <div class="card">
        <h2>Table</h2>
        <table id="nameTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Mobile</th>
                    <th>OTP</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="data">

            </tbody>
        </table>
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
        }

    });
</script>
<script>
    function deletedata(id) {
        var deleteurl = "http://localhost/api/delete.php?id=" + id;

        $.ajax({
            url: deleteurl,
            type: "Delete",
            success: function() {
                goat();
            },
            error: function(error) {
                alert("Error Deleting data:" + error.statusText);
            }
        });
    }


    goat();

    function goat() {
        fetch("http://localhost/api/read.php").then(
            res => {
                res.json().then(
                    data => {
                        if (data.data.length > 0) {
                            var temp = "";

                            data.data.forEach((idemdata) => {
                                temp += "<tr>";
                                temp += "<td>" + idemdata.id + "</td>";
                                temp += "<td>" + idemdata.mobile + "</td>";
                                temp += "<td>" + idemdata.otp + "</td>";
                                temp += "<td><button class='view-btn' data-id='" + idemdata.id + "'>View</button></td>";
                                temp += "<td><button class='edit-btn' data-id='" + idemdata.id + "'>Edit</button></td>";
                                temp += "<td><button class='delete-btn' data-id='" + idemdata.id + "'>Delete</button></td></tr>";
                            });
                            document.getElementById('data').innerHTML = temp;
                        } // if close
                    } //data close
                ) //then close
            } //res close
        );
    }

    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        console.log("Edit button id:", id);

        var lastcheckedcustomer = {
            id: id,
            mobile: $(this).closest('tr').find('td:eq(1)').text(),
            otp: $(this).closest('tr').find('td:eq(2)').text(),
        };
        var confirmation = confirm('Are you sure you want to view this data?');
        if (confirmation) {
            window.location.href = "http://localhost/api/view.php?id=" + id + "&mobile=" + encodeURIComponent(lastcheckedcustomer.mobile) + "&otp=" + encodeURIComponent(lastcheckedcustomer.otp);
        }
    });

    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var rowtext = $(this).closest('tr').text().trim();
        var confirmation = confirm("Are you delete this item?");
        if (confirmation) {
            deletedata(id);
        }
    });

    var lastclickedcustomer ={};

    $(document).on('click','.edit-btn',function(){
        var id= $(this).data('id');
        console.log("edit id",id);

        var lastclickedcustomer={
            id: id,
            mobile: $(this).closest('tr').find('td:eq(1)').text(),
            otp: $(this).closest('tr').find('td:eq(2)').text(),
        };
        var confirmation = confirm("Are you edit this item?");
        if(confirmation){
            window.location.href = "http://localhost/api/edit.php?id=" + id + "&mobile=" + encodeURIComponent(lastclickedcustomer.mobile) + "&otp=" + encodeURIComponent(lastclickedcustomer.otp);
        }
    });
    goat();
</script>

</html>