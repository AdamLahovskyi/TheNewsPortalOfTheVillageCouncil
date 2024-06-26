<?php
/** @var string $Title */
/** @var string $Content */

use models\Users;

if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = "";
}
$core = core\Core::get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $Title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/" class="nav-link px-2 link-secondary">Main Page</a></li>
                    <li><a href="/news/todayslatestnews" class="nav-link px-2 link-body-emphasis">Latest News</a></li>
                    <li><a href="/news/featured" class="nav-link px-2 link-body-emphasis">Featured News</a></li>
                    <?php if (!Users::IsUserLogged()) : ?>
                        <li><a href="/users/login" class="nav-link px-2 link-body-emphasis">Sign In</a></li>
                        <li><a href="/users/register" class="nav-link px-2 link-body-emphasis">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
                <form action="/news/searchresult/" method="post" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
                <?php if (Users::IsUserLogged()) : ?>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../../files/user_image.jpg" alt="user_image" width="32" height="32"
                                 class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small z-10000">
                            <?php if (Users::IsUserAdmin()) : ?>
                            <li><a class="dropdown-item" href="/news/add">Add News</a></li>
                            <li><a class="dropdown-item" href="/users/adminpanel">Admin Panel</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="/news/mynews">Browse My News</a></li>
                            <li><a class="dropdown-item" href="/users/profile">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/users/logout">Log out</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
</div>
<div class="container">
    <?= $Content ?>
</div>
<br>
<footer class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-body text-decoration-none">Main Page</a></li>
                    <li><a href="/news/todayslatestnews" class="text-body text-decoration-none">Latest News</a></li>
                    <li><a href="/news/featured" class="text-body text-decoration-none">Featured News</a></li>
                    <?php if (!Users::IsUserLogged()) : ?>
                        <li><a href="/users/login" class="text-body text-decoration-none">Sign In</a></li>
                        <li><a href="/users/register" class="text-body text-decoration-none">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">User Services</h5>
                <ul class="list-unstyled">
                    <?php if (Users::IsUserLogged()) : ?>
                        <?php if (Users::IsUserAdmin()) : ?>
                            <li><a href="/news/add" class="text-body text-decoration-none">Add News</a></li>
                            <li><a href="/users/adminpanel" class="text-body text-decoration-none">Admin Panel</a></li>
                        <?php endif; ?>
                        <li><a href="/news/mynews" class="text-body text-decoration-none">Browse My News</a></li>
                        <li><a href="/users/profile" class="text-body text-decoration-none">Profile</a></li>
                        <li><a href="/users/logout" class="text-body text-decoration-none">Log Out</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">Contact</h5>
                <p class="text-body-secondary">10010, Zhytomyr, Ukraine</p>
                <p class="text-body-secondary">postofadam@gmail.com</p>
            </div>
        </div>
        <hr class="my-4">
        <p class="text-center text-body-secondary">© 2024 Adam Lahovskyi. All rights reserved.</p>
    </div>
    <div class="text-center">
        <a href="mailto:postofadam@gmail.com" class="text-decoration-none me-3">
            <i class="far fa-envelope fa-2x"></i>
        </a>
        <a href="https://t.me/adam4ikkk" target="_blank" class="text-decoration-none me-3">
            <i class="fab fa-telegram fa-2x"></i>
        </a>
        <a href="https://github.com/AdamLahovskyi" target="_blank" class="text-decoration-none">
            <i class="fab fa-github fa-2x"></i>
        </a>
    </div>
</footer>


</body>
</html>
