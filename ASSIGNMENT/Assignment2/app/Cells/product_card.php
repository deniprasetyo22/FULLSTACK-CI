<div class="product-card">
    <h3><?= $product['name'] ?></h3>

    <div class="price">
        <?php if ($showDiscount): ?>
        <span class="original-price">
            Rp <?= number_format($product['price']) ?>
        </span>
        <span class="discounted-price">
            Rp <?= number_format($this->getDiscountedPrice()) ?>
        </span>
        <?php else: ?>
        <span>Rp <?= number_format($this->getDiscountedPrice()) ?></span>
        <?php endif; ?>
    </div>

    <button onclick="<?= $this->toggleDiscount() ?>">
        <?= $showDiscount ? 'Hide' : 'Show' ?> Discount
    </button>
</div>