<?= $this->extend('layouts/public_layout') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mx-auto flex justify-center py-10">
    <div class="md:w-1/3 w-full bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>

        <?php if (session('error') !== null) : ?>
        <div class="mb-4 p-3 text-red-700 bg-red-100 border border-red-400 rounded">
            <?= session('error') ?>
        </div>
        <?php endif ?>

        <?php if (session('message') !== null) : ?>
        <div class="mb-4 p-3 text-green-700 bg-green-100 border border-green-400 rounded">
            <?= session('message') ?>
        </div>
        <?php endif ?>

        <form action="<?= route_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="login" class="block text-sm font-medium text-gray-700">Email atau Username</label>
                <input type="text" name="login"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 <?php if (session('errors.login')) echo 'border-red-500'; ?>"
                    placeholder="Email atau Username" value="<?= old('login') ?>">
                <?php if (session('errors.login')) : ?>
                <p class="mt-1 text-sm text-red-600"> <?= session('errors.login') ?> </p>
                <?php endif ?>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 <?php if (session('errors.password')) echo 'border-red-500'; ?>"
                    placeholder="Password">
                <?php if (session('errors.password')) : ?>
                <p class="mt-1 text-sm text-red-600"> <?= session('errors.password') ?> </p>
                <?php endif ?>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat Saya</label>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Login</button>
        </form>

        <div class="text-center mt-4">
            <a href="<?= route_to('forgot') ?>" class="text-indigo-600 hover:underline">Lupa Password?</a>
        </div>

        <div class="mt-4 text-center">
            <p class="text-gray-600">Belum punya akun? <a href="<?= route_to('register') ?>"
                    class="text-indigo-600 hover:underline">Daftar Sekarang</a></p>
        </div>
    </div>

</div>


<?= $this->endSection() ?>