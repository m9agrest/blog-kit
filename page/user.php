<?php
$user = getUser($user_id);
if(!isset($user)){
    stop(404);
}
$posts = getPostUser($user_id, $list);
?>
<html>
    <?php blockHead($user->name); ?>
    <body>
        <?php blockHeader(); ?>
        <main>
            <div>
                <img src="/blog-kit/main/photo/<?= $user->photo ?>" alt="User Photo">
                <span><?= htmlspecialchars($user->name) ?></span>
                <span>Подписчиков: <?= $user->sub ?></span>
                <span>Постов: <?= $user->post ?></span>
            </div>
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                    <?php blockPost($post); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Постов нет.</p>
            <?php endif; ?>
            <?php blockPagination($list, $user->post, "user".($user->id)) ?>
        </main>
    </body>
</html>