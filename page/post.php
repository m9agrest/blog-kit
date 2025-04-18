<?php
$post = getPost($post_id, $list);
if(!isset($post)){
    stop(404);
}
?>
<html>
    <?php blockHead($post->text /*TODO выделить пару слов или "запись ".$post->user->name */); ?>
    <body>
        <?php blockHeader(); ?>
        <main>
            <?php if (isset($post->father)): ?>
                <?php blockPost($post->father, "father"); ?>
            <?php endif; ?>

            <?php blockPost($post); ?>

            <?php if (count($post->children) > 0): ?>
                <?php foreach ($post->children as $comment): ?>
                    <?php blockPost($comment, "children"); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Комментариев нет.</p>
            <?php endif; ?>
            <?php blockPagination($list, $post->comment, "post".($post->id)) ?>
        </main>
    </body>
</html>