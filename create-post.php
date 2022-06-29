<head>
    <title>Create post</title>
</head>
<body>
    <?php include('templates/header.php');

        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $body = $_POST['body'];
            $author = $_POST['author'];
            $createdAt = date("Y-m-d h:i");

            $sql = "INSERT INTO posts (title, body, author_id, created_at) VALUES ('$title', '$body', '$author', '$createdAt')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            header("Location:/posts.php");
        }
    
        $sql = "SELECT id, first_name, last_name, gender FROM authors";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $authors = $statement->fetchAll();
    
    ?>

    <main role="main" class="container">

    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <form action="create-post.php" method="post">

                    <li><label for="title">Enter post title:</label></li>
                    <li><input type="text" name="title" id="title" placeholder="Post title..." required></li>

                    <li><label for="body">Enter post content:</label></li>
                    <li><textarea name="body" id="" cols="30" rows="10" required placeholder="Post content..." ></textarea></li>

                    <li><label for="author">Select post author:</label></li>
                    <li>
                        <select class="<?php echo $author['gender'] ?>" name="author" placeholder="Select Author" >
                            <?php foreach($authors as $author) { ?> 
                                <option  class="<?php echo $author['gender'] ?>" value="<?php echo $author['id'] ?>">
                                    <?php echo ($author['first_name']) . ' ' . ($author['last_name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </li>
                    <br>
                    <li><button type="submit" name="submit">Submit</button></li>
                </form>
            </div>
        </div><!-- /.blog-main -->
        <?php include('templates/sidebar.php'); ?>
    </div><!-- /.row -->
</main><!-- /.container -->
    <?php include('templates/footer.php');?>
</body>
</html>