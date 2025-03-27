<nav class="bg-blue-500 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Online Food Ordering
                System</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-black rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto text-center" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                <?php if(in_groups('customer')) : ?>
                <li>
                    <a href="<?= url_to('home') ?>"
                        class="block py-2 px-3 text-white md:p-0 hover:text-gray-200">Home</a>
                </li>
                <?php endif; ?>

                <?php if(in_groups('customer')) : ?>
                <li>
                    <a href="<?= url_to('my-profile') ?>"
                        class="block py-2 px-3 text-white md:p-0 hover:text-gray-200">Profile</a>
                </li>
                <?php endif; ?>

                <?php if(in_groups('administrator')) : ?>
                <li>
                    <a href="<?= url_to('admin-dashboard') ?>"
                        class="block py-2 px-3 text-white md:p-0 hover:text-gray-200">Dashboard</a>
                </li>
                <?php endif; ?>

                <?php if(in_groups('product_manager')) : ?>
                <li>
                    <a href="<?= url_to('manager-dashboard') ?>"
                        class="block py-2 px-3 text-white md:p-0 hover:text-gray-200">Dashboard</a>
                </li>
                <?php endif; ?>

                <?php if(logged_in()) : ?>
                <li>
                    <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md">Logout</a>
                    <?php else : ?>
                    <a href="/login" class="bg-green-500 hover:bg-green-600 text-white px-4 py-1.5 rounded-md">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>