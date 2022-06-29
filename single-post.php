<head>
    <title>Single post</title>
</head>
    <?php include('templates/header.php');
        if(isset($_GET['post_id'])){
            $sql = "SELECT title, body, author_id, created_at FROM posts WHERE id = {$_GET['post_id']}";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $singlePost = $statement->fetch();

            $sqlAuthorID = "SELECT author_id FROM posts WHERE posts.id = {$_GET['post_id']}";
            $statement = $connection->prepare($sqlAuthorID);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $getAuthorID  = $statement->fetch();

            $sqlAuthor = "SELECT * FROM authors WHERE authors.id = $getAuthorID[author_id]";
            $statement = $connection->prepare($sqlAuthor);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $getAuthor  = $statement->fetch();

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
                <p class="blog-post-meta"><?php echo $singlePost['created_at'];?> <a href="#" class="<?php if($getAuthor['gender'] === 'Male') { echo 'male'; } else if(($getAuthor['gender'] === 'Female')) { echo 'female';} ?>"><?php echo ($getAuthor['first_name']) . ' ' . ($getAuthor['last_name'])?></a></p>
                <p><?php echo $singlePost['body'];?></p>
    
                <hr>
                <div class="comments">
                <?php foreach($comments as $comment) { ?>
                    <?php

                        $sqlAuthor = "SELECT * FROM authors WHERE id = '{$comment['author_id']}'";
                        $statement = $connection->prepare($sqlAuthor);
                        $statement->execute();
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        $author = $statement->fetch();

                    ?>
                        <p class="<?php if($author['gender'] === 'Male') { echo 'male'; } else if(($author['gender'] === 'Female')) { echo 'female';} ?>"><?php echo ($author['first_name']) . ' ' . ($author['last_name']);?></p>
                        <ul>
                            <li><?php echo $comment['text']; ?></li>
                            <hr>
                        </ul>
                    <?php } ?>
                </div>  
            </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->

            <?php include('templates/sidebar.php'); ?>

    </div><!-- /.row -->
</main><!-- /.container -->
<?php include('templates/footer.php');?>
