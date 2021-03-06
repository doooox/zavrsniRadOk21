<head>
    <title>All posts</title>
</head>
<body>
<?php include('templates/header.php');
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $statement->fetchAll();
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">

                <?php foreach($posts as $post) { ?>
                    <?php 
                        $sqlAuthor = "SELECT * FROM authors WHERE id = '{$post['author_id']}'";
                        $statement = $connection->prepare($sqlAuthor);
                        $statement->execute();
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        $author = $statement->fetch();
                    ?>
                        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a></h2>
                        <p class="blog-post-meta"><?php echo $post['created_at'];?> <a href="#" class="<?php if($author['gender'] === 'Male') { echo 'male'; } else if(($author['gender'] === 'Female')) { echo 'female';} ?>" ><?php echo ($author['first_name']) . ' ' . ($author['last_name']);?></a></p>
                        <p><?php echo $post['body'];?></p>
                <?php } ?>

                <hr>

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