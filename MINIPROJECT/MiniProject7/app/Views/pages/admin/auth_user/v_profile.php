<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 h-full bg-white p-6 rounded-lg shadow">
    <div class="relative mb-5">
        <a href="<?= url_to('auth-user') ?>"
            class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
        <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">User Profile</h2>
    </div>

    <div class="mb-4">
        <strong class="text-gray-600">ID:</strong>
        <span class="text-gray-800"><?= esc($user->id) ?></span>
    </div>

    <div class="mb-4">
        <strong class="text-gray-600">Informasi:</strong>
        <table class="w-full border-collapse border border-gray-300 mt-2">
            <tbody>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Full Name</th>
                    <td class="border border-gray-300 p-2"><?= esc($user->full_name) ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Username</th>
                    <td class="border border-gray-300 p-2"><?= esc($user->username) ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Email</th>
                    <td class="border border-gray-300 p-2"><?= esc($user->email) ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Role</th>
                    <td class="border border-gray-300 p-2"><?= esc($user->role) ?></td>
                </tr>
                <tr class="hover:bg-gray-100 transition duration-300">
                    <th class="border border-gray-300 p-2 text-left">Status</th>
                    <td class="border border-gray-300 p-2"><?= esc($user->status) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>