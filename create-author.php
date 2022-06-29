<head>
    <title>Create author</title>
</head>
<?php 
    include('templates/header.php'); 

    if(isset($_POST['submit'])){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO authors (first_name, last_name, gender) VALUES ('$firstName', '$lastName', '$gender')";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location:/create-post.php");
    }

    

?>
<main role="main" class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            
        <h2>Create author</h2>
            <form action="create-author.php" method="post">
                
                <li><label for="firstName">Enter your first name</label></li>
                <li><input type="text" name="firstName" id="firstName" placeholder="First name..." required></li>

                <li><label for="lastName">Enter your last name</label></li>
                <li><input type="text" name="lastName" id="lastName" placeholder="Last name..." required></li>

                <li>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="male" value="Male">
                </li>

                <li>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" id="female" value="Female">
                </li>
                
                <li>
                    <button type="submit" name="submit">Create author</button>
                </li>
        
            </form>
            
        </div><!-- /.blog-main -->

        <?php include('templates/sidebar.php'); ?>

    </div><!-- /.row -->

</main><!-- /.container -->