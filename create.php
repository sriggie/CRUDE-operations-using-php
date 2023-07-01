
<?php
//  *connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

//create connection
$connection = new mysqli($servername, $username, $password, $database);


// <!-- read the submitted Data -->
$name = "";
$email = "";
$phone = "";
$address = "";

// initialising the variable $errorMessage

$errorMessage ="";
$successMessage =""; 


//initializing an successs value to $successMesssage

//check of the data is being trasnmitted  through the _POST method 

if ( $_SERVER['REQUEST_METHOD']== 'POST') {
    $name = $_POST["name"];
    $email = $_POST ["email"];
    $phone = $_POST ["phone"];
    $address =$_POST ["address"];
    //check if we left any field empty and excecute the error only once using while loop
    
    do {
        if (empty($name)|| empty($email) || empty($phone) || empty($address) ) {
            $errorMessage ="fill in all the empty forms !!";
            break ;
        }

        //add a new client into the database
        $sql = "INSERT INTO clients (name, email, phone, address) " . 
                "VALUES ('$name' , '$email' , '$phone', '$address')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query:" . $connection->error;
            break;
        }
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";

        //re-direct the user to the index user page
        header("location: /myshop/index.php");
        exit;


    }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        //check if the eeror messsage is not empty
        if (!empty($errorMessage)) {
            //if its not display error message
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'</button>
            </div>
            ";
        }


        ?>
        <form method="post">
            <div class="row my-3">
                <label  class="col-sm-3 col-form-label" > Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ;?>">
                </div>
            </div>
            <div class="row my-3">
                <label  class="col-sm-3 col-form-label" > Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ; ?>">
                </div>
            </div>
            <div class="row my-3">
                <label  class="col-sm-3 col-form-label" > phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ; ?>">
                </div>
            </div>
            <div class="row my-3">
                <label  class="col-sm-3 col-form-label" > Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php $address ;?>">
                </div>
            </div>

            <?php
            //if theres no error then a function to display a success mesage
            if (!empty($successMessage) ){
                //display success message 
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close data-bs-dismiss='alert' aria-label
                        </div>
                    </div>
                </div>
                ";
            }


            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
            </div>
            
         </form>    
</body>
</html>


            