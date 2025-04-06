<header>
    <a href="/blog-kit/main/">Main</a>
    <?php if(isset($user)): ?>
        <a href="/blog-kit/main/user<?= $user->id ?>">Profile</a>
    <?php else: ?>
        <a href="/blog-kit/main/login">Login</a>
        <a href="/blog-kit/main/registration">Registration</a>
    <?php endif; ?>
</header>