<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shinigami Shop</title>

    <link rel="shortcut icon" href="<?= BASE_URL; ?>/assets/bag.png" type="image/x-icon">
    <!-- ionicon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- style -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/style.css">
    <script src="<?= BASE_URL; ?>/assets/js/scripts.js" defer></script>
    <script src="<?= BASE_URL; ?>/assets/js/carousel.js" defer></script>
    <script src="<?= BASE_URL; ?>/assets/js/alert.js" defer></script>
    <?= Flasher::getFlash(); ?>
</head>

<body>
    <div class="navigation">
        <div class="container">
            <div class="navbar">
                <a href="<?= BASE_URL; ?>" class="logo">
                    <ion-icon name="logo-buffer"></ion-icon> <span>LOGO</span>
                </a>
                <span data-triger-category="category of product">
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </span>
                <nav>
                    <span id="btnSearch" class="nav-link show">
                        <ion-icon name="search-outline"></ion-icon>
                    </span>
                    <div id="formSearch">
                        <form action="">
                            <span id="CloseSearch">
                                <ion-icon name="close-outline"></ion-icon>
                            </span>
                            <input type="text" placeholder="search items . . .">
                        </form>
                    </div>
                    <a href="#Keranjang" class="nav-link">
                        <ion-icon name="bag-handle-outline"></ion-icon>
                    </a>
                    <?php if (empty($user)) : ?>
                        <a href="#Login" data-triger-login="triger login" class="nav-link">
                            <ion-icon name="log-in-outline"></ion-icon>
                        </a>
                    <?php else : ?>
                        <a href="<?= BASE_URL; ?>/auth/logout" class="nav-link">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </a>
                    <?php endif; ?>
                    <!-- <span class="burger">
                        <div class="burger-block"></div>
                    </span> -->
                </nav>
            </div>
            <div class="category">
                <ul>
                    <li><a href="<?= BASE_URL; ?>/product/category/Honda">Honda</a></li>
                    <li><a href="<?= BASE_URL; ?>/product/category/Suzuki">Suzuki</a></li>
                    <li><a href="<?= BASE_URL; ?>/product/category/Yamaha">Yamaha</a></li>
                    <li><a href="<?= BASE_URL; ?>/product/category/Kawasaki">Kawasaki Motor</a></li>
                    <li><a href="<?= BASE_URL; ?>/product/category/KTM">KTM Racing</a></li>
                    <li><a href="<?= BASE_URL; ?>/product/category/Viar">Viar Motor</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (empty($data['user'])) : ?>
        <div id="ModalLogin" class="modal modal-auth none">
            <div class="form-container">
                <span id="CloseModalLogin" class="btn-close-modal">
                    <ion-icon name="close-outline"></ion-icon>
                </span>
                <h2>Login</h2>
                <form action="<?= BASE_URL; ?>/auth/login" id="formLogin" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" required placeholder="username or email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required placeholder="password">
                    </div>
                    <button type="submit" name="submit">Log in</button>
                    <p>Don't have an account? <a href="#Register" data-triger-register="triger register">Register</a></p>
                </form>
            </div>
        </div>

        <div id="ModalRegister" class="modal modal-auth none">
            <div class="form-container">
                <span id="CloseModalRegister" class="btn-close-modal">
                    <ion-icon name="close-outline"></ion-icon>
                </span>
                <h2>Register</h2>
                <form action="<?= BASE_URL; ?>/auth/register" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" required placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" required placeholder="Email address">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" required placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required placeholder="password">
                        <span class="show-hide-pw">
                            <ion-icon name="eye-off-outline"></ion-icon>
                        </span>
                    </div>
                    <button type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <main>