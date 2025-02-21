<div class="h-full flex flex-col bg-gray-800 text-white">
    <!-- Logo -->
    <div class="p-4 text-center text-lg font-bold bg-gray-900">
        Admin Panel
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <?php
            $currentUrl = current_url();
            ?>

            <li>
                <a href="<?= url_to('home') ?>"
                    class="flex items-center p-2 rounded <?= $currentUrl == url_to('home') ? 'bg-gray-700' : '' ?> hover:bg-gray-700">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>

            <li>
                <a href="<?= url_to('dashboard') ?>"
                    class="flex items-center p-2 rounded <?= $currentUrl == url_to('dashboard') ? 'bg-gray-700' : '' ?> hover:bg-gray-700">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?= url_to('user') ?>"
                    class="flex items-center p-2 rounded <?= $currentUrl == url_to('user') ? 'bg-gray-700' : '' ?> hover:bg-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>

            <li>
                <a href="<?= url_to('product') ?>"
                    class="flex items-center p-2 rounded <?= $currentUrl == url_to('product') ? 'bg-gray-700' : '' ?> hover:bg-gray-700">
                    <i class="fas fa-box w-5"></i>
                    <span class="ml-3">Products</span>
                </a>
            </li>
        </ul>
    </nav>
</div>