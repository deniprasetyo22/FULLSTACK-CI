<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Registrasi<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="w-full flex justify-center bg-gray-100 py-10">
    <div class="md:w-1/3 w-full bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center mb-4">Registrasi</h2>

        <?php if (session('errors')) : ?>
        <div class="mb-4 p-3 text-red-700 bg-red-100 border border-red-400 rounded">
            <?php foreach (session('errors') as $error) : ?>
            <p><?= $error ?></p>
            <?php endforeach ?>
        </div>
        <?php endif ?>

        <form action="<?= route_to('register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Username" value="<?= old('username') ?>">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Email" value="<?= old('email') ?>">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Password">
            </div>

            <div class="mb-4">
                <label for="pass_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="pass_confirm"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Konfirmasi Password">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Daftar
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-gray-600">Sudah punya akun? <a href="<?= route_to('login') ?>"
                    class="text-indigo-600 hover:underline">Login</a></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>