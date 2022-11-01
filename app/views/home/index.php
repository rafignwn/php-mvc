<?php include "../app/views/layouts/header.php" ?>

<div id="carousel-container">
    <div>
        <ul id="carousel" class="animate">
            <li class="slide animate">
                <img src="<?= BASE_URL; ?>\assets\images\pexels-anton-atanasov-213172.jpg" alt="" />
            </li>
            <li class="slide animate">
                <img src="<?= BASE_URL; ?>\assets\images\pexels-pixabay-531321.jpg" alt="" />
            </li>
            <li class="slide animate">
                <img src="<?= BASE_URL; ?>\assets\images\pexels-ian-beckley-2440021.jpg" alt="" />
            </li>
            <li class="slide animate">
                <img src="<?= BASE_URL; ?>\assets\images\pexels-pixabay-247431.jpg" alt="" />
            </li>
            <li class="slide animate">
                <img src="<?= BASE_URL; ?>\assets\images\pexels-alex-azabache-3727257.jpg" alt="" />
            </li>
        </ul>
    </div>
</div>

<div class="pop-up">
    <div class="greeting">
        <span>Hi,</span>
        <h2><?= !empty($user) ? $user["name"] : "Guest"; ?></h2>
        <p>Have a nice day!</p>
    </div>
    <button class="close">
        <ion-icon name="close-outline"></ion-icon>
    </button>
</div>