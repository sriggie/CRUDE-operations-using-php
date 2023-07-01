<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
     <div class="container my-5">
    <h2>List of Clients</h2>
    <a href="/myshop/create.php" class="btn btn-primary" role="button">New Client</a>
    <br>
    <table class="table my-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //varaibles for db_connetion
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "myshop";

            //connection to database

            $connection = new mysqli($servername,$username,$password,$database);

            //check if connection is successful or not 

            if($connection->connect_error) {
                die("connection failed" . $connection->connect_error);
            }
            // read all rows from the database TABLE
            $sql = "SELECT * FROM  clients";
            $result = $connection->query($sql);

            //it will be stored in the querry $result

            //check if its successfull

            if(!$result) {
                die("Invalid Query: " . $connection->error);
            }

            //read data of esch row using while loop 
            // each row will be displyed ontu the html table 
            while($row = $result->fetch_assoc()) {

                //using echo to print each row 
                echo "
                <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a href='/myshop/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='/myshop/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>
                ";
            }
 
            
            ?>
           
        </tbody>
    </table>
     </div>
</body>
</html>


