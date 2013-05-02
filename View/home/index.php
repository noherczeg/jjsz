<html>
    <head>
        <title>Blogom</title>
    </head>
    <body>
        <div class="menu"></div>
        <div class="post-list">
            <ul>
                <?php foreach($posts as $key => $post): ?>
                <li>
                    <h3><?= $post->title ?></h3>
                    <p>
                        <?= $post->content ?><br>
                        <a href="<?= \System\Request::getBaseURL() . 'post/full/' . $post->id ?>">megtekintés</a>
                    </p>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>