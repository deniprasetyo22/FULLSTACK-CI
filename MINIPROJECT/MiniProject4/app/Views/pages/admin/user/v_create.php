<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Add User<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <form action=" <?= url_to('store_user') ?>" method="POST">
        <div class="relative mb-5">
            <a href="<?= url_to('user') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Add User</h2>
        </div>
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="full_name"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.full_name') ? 'border-red-500' : 'border-gray-300' ?>"
                value="<?= old('full_name') ?>" placeholder="Full Name">
            <?php if(session('errors.full_name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.full_name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.username') ? 'border-red-500' : 'border-gray-300' ?>"
                placeholder="Username" value="<?= old('username') ?>">
            <?php if(session('errors.username')): ?>
            <p class="text-sm text-red-500"><?= session('errors.username') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.email') ? 'border-red-500' : 'border-gray-300' ?>"
                placeholder="Email" value="<?= old('email') ?>">
            <?php if(session('errors.email')): ?>
            <p class="text-sm text-red-500"><?= session('errors.email') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.password') ? 'border-red-500' : 'border-gray-300' ?>"
                placeholder="Password" value="<?= old('password') ?>">
            <?php if(session('errors.password')): ?>
            <p class="text-sm text-red-500"><?= session('errors.password') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role" id="role"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.role') ? 'border-red-500' : 'border-gray-300' ?>">
                <option value="" disabled selected>-- Choose Role --</option>
                <?php foreach($roles as $role): ?>
                <option value="<?= $role ?>"><?= $role ?></option>
                <?php endforeach; ?>
            </select>
            <?php if(session('errors.role')): ?>
            <p class="text-sm text-red-500"><?= session('errors.role') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" id="status"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.status') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php foreach($status as $s): ?>
                <option value="<?= $s ?>"><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                <i class="fa-solid fa-save"></i>
                <span>Submit</span>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>