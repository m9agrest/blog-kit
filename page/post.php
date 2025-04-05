<?php
$post = getPost($post_id, $list);
if(!isset($post)){
    stop(404);
}
?>
<html>
    <?php blockHead($post->text /* выделить пару слов или "запись ".$post->user->name */); ?>
    <body>
        <?php blockHeader(); ?>
        <main>
            <?php if (isset($post->father)): ?>
                <?php blockPost($post->father); ?>
            <?php endif; ?>

            <?php blockPost($post); ?>

            <?php if (count($post->children) > 0): ?>
                <?php foreach ($post->children as $comment): ?>
                    <?php blockPost($comment); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Комментариев нет.</p>
            <?php endif; ?>
        </main>
    </body>
</html>