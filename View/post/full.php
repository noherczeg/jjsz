<html>
    <head>
        <title><?= $post->title ?></title>
    </head>
    <body>
        <!-- POST TARTALMA -->
        <p>
            <?= $post->content ?>
        </p>
        <hr>
        <!-- KOMMENTEK -->
        <p>
            <?php foreach ($comments as $comment): ?>
            <p style="border: 1px solid #ccc;">
                <!-- nl2br A \n karaktert kovertalja <br>-e -->
                <b><?= nl2br($comment->comment) ?></b><br><br>
                <i><?= $comment->email ?></i>
            </p>
            <?php endforeach; ?>
        </p>
        <hr>
        <!-- KOMMENT IRASA -->
        <p>
            <form method="post" action="" name="postComment">
                <label>E-Mail cím:</label><input type="text" size="30" maxlength="64" name="email"><br>
                <label>komment:</label><textarea name="comment" rows="4" cols="40"></textarea><br>
                <button type="submit" name="submit">Küldés</button>
            </form>
        </p>
    </body>
</html>