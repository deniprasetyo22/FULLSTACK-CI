<div>
    <div class="sidebar">
        <ul class="nav-menu">
            <?php foreach ($menu as $item): ?>
            <li class="nav-item <?= ($this->getActiveMenu() == base_url($item['url'])) ? 'active' : '' ?>">
                <a href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>