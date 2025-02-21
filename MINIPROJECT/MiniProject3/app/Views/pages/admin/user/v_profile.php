<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>User Profile<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <div class="relative mb-5">
            <a href="<?= url_to('user') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">User Profile</h2>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">ID:</strong>
            <span class="text-gray-800"><?= esc($user->getUserId()) ?></span>
        </div>

        <div class="mb-4">
            <strong class="text-gray-600">Informasi:</strong>
            <table class="w-full border-collapse border border-gray-300 mt-2">
                <tbody>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Nama Lengkap</th>
                        <td class="border border-gray-300 p-2"><?= esc($user->getFullName()) ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Username</th>
                        <td class="border border-gray-300 p-2"><?= esc($user->getUserName()) ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Jenis Kelamin</th>
                        <td class="border border-gray-300 p-2"><?= esc($user->getSex()) ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Tanggal Lahir</th>
                        <td class="border border-gray-300 p-2"><?= esc($user->getDob()) ?></td>
                    </tr>
                    <tr class="hover:bg-gray-100 transition duration-300">
                        <th class="border border-gray-300 p-2 text-left">Role</th>
                        <td class="border border-gray-300 p-2"><?= esc($user->getRole()) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>