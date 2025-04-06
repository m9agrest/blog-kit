<header>
    <a href="/">Main</a>
    <?php if(isset($user)): ?>
        <a href="/user<?= $user->id ?>">Profile</a>
    <?php else: ?>
        <a href="/login">Login</a>
        <a href="/registration">Registration</a>
    <?php endif; ?>
</header>