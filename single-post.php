<head>
    <title>Single post</title>
</head>
    <?php include('templates/header.php');
        if(isset($_GET['post_id'])){
            $sql = "SELECT title, body, author, created_at FROM posts WHERE id = {$_GET['post_id']}";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $singlePost = $statement->fetch();

            $sql = "SELECT * FROM comments WHERE post_id = {$_GET['post_id']}";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $comments = $statement->fetchAll();
        }
        // var_dump($singlePost)
    ?>
<main role="main" class="container">

    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">

                <h2 class="blog-post-title"><?php echo $singlePost['title'];?></h2>
                <p class="blog-post-meta"><?php echo $singlePost['created_at'];?> <a href="#"><?php echo $singlePost['author'];?></a></p>
                <p><?php echo $singlePost['body'];?></p>
            
                <hr>
                <div class="comments">
                <?php foreach($comments as $comment) { ?>
                    <p><?php echo $comment['author']; ?></p>
                    <ul>
                        <li><?php echo $comment['text']; ?></li>
                        <hr>
                    </ul>
                <?php } ?>
                </div>  
            </div><!-- /.blog-post -->

                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>

        </div><!-- /.blog-main -->

        <?php include('templates/sidebar.php'); ?>

    </div><!-- /.row -->
</main><!-- /.container -->
<?php include('templates/footer.php');?>
