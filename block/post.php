<div class="post">
    <div class="post-author">
        <img src="<?= $post->user->photo ?>" alt="User Photo">
        <a href="user<?=$post->user->id ?>"><?= htmlspecialchars($post->user->name) ?></a>
    </div>
    <div class="post-content">
        <a href="post<?= $post->id ?>" class="post-date" data-timestamp="<?= $post->date ?>">запись добавлена: </a>
        <p><?= htmlspecialchars($post->text) ?></p>
        <?php if (isset($post->photo)): ?>
            <img src="<?= $post->photo ?>" alt="Post Photo">
        <?php endif; ?>
        <p>Комментариев: <?= $post->comment ?></p>
    </div>
</div>