<div>
    <ul>
        <?php foreach ($this->products as $product) : ?>
        <li>
            <?= esc($product['name']) ?>
            - Rp <?= number_format($product['price'], 0, ',', '.') ?>
            x <?= esc($product['quantity']) ?>
            = Rp <?= number_format($product['price'] * $product['quantity'], 0, ',', '.') ?>
        </li>
        <?php endforeach; ?>
        <strong>Total Harga: Rp <?= number_format($this->getTotalPriceProperty(), 0, ',', '.') ?></strong>
    </ul>
</div>