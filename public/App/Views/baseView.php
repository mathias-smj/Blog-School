<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../public/style/style.css">
    <title>Blog</title>
</head>
<body>
    <nav class="sb">
        <a <?php if ($currentPage === 'home' ) { echo 'class="sb-active"'; } ?> href="/">Home</a>
        <a <?php if ($currentPage === 'login' ) { echo 'class="sb-active"'; } ?> href="/login">Login</a>
        <a <?php if ($currentPage === 'posts' ) { echo 'class="sb-active"'; } ?> href="/posts">Posts</a>
        <?php
        if ($isAdmin) { ?>
            <a <?php if ($currentPage === 'post/create' ) { echo 'class="sb-active"'; } ?> href="/post/create">Create</a>
        <?php } ?>
        <a href="/register">Register</a>
        <a href="/logout">Logout</a>
    </nav>
    <main class="sb-container">
      <?php include('layout/header.php') ?>
       <!-- Contenu de la page -->
        <div>
            <?php echo $content ?>
        </div>
      <?php include('layout/footer.php') ?>
    </main>
</body>
</html>
