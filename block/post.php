<div class="<?= $type ?>post">
    <div class="post-author">
        <img src="/blog-kit/main/photo/<?= $post->user->photo ?>" alt="User Photo">
        <a href="/blog-kit/main/user<?=$post->user->id ?>"><?= htmlspecialchars($post->user->name) ?></a>
    </div>
    <div class="post-content">
        <a href="/blog-kit/main/post<?= $post->id ?>" class="post-date" data-timestamp="<?= $post->date ?>">запись добавлена: </a>
        <p><?= htmlspecialchars($post->text) ?></p>
        <?php if (isset($post->photo)): ?>
            <img src="<?= $post->photo ?>" alt="Post Photo">
        <?php endif; ?>
    </div>
    <div class="post-info">
        <p>Лайков: <?= $post->like ?></p>
        <p>Комментариев: <?= $post->comment ?></p>
    </div>
</div>