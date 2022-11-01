<?php include "../app/views/layouts/header.php" ?>

<div class="container">
    <?php if (isset($data['category'])) : ?>
        <div class="category">
            <?= $data['category']; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['products'])) : ?>
        <?php foreach ($data['products'] as $product) : ?>
            <div class="content">
                Content <?= $product['name']; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include "../app/views/layouts/footer.php" ?>