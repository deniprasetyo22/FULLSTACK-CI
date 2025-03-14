<?= $this->extend('layouts/public_layout'); ?>

<?= $this->section('title') ?>
<?= esc($page_title) ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div class="container mx-auto md:w-1/2 flex flex-col p-6 bg-white shadow-lg rounded-lg my-5">

    <h2 class="text-2xl font-semibold text-center mb-10"><?= $page_title ?></h2>

    <?php if(session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <i class="fa-solid fa-circle-info mr-2"></i>
        <span class="font-medium"> <?= session()->getFlashdata('message') ?></span>
    </div>
    <?php endif; ?>

    <!-- Main Student Info -->
    <div class="overflow-x-auto mb-4">
        <table class="min-w-full bg-white border border-gray-200 shadow-sm">
            <tbody>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Full Name</td>
                    <td class="py-2 px-4"><?= $user->full_name ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Username</td>
                    <td class="py-2 px-4"><?= user()->username ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Email</td>
                    <td class="py-2 px-4"><?= user()->email ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Role</td>
                    <td class="py-2 px-4"><?= $user->role ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Status</td>
                    <td class="py-2 px-4">
                        <span
                            class="px-2 py-1 rounded <?php if($user->status == 'Active') echo 'bg-green-500 text-white'; else echo 'bg-red-500 text-white'; ?>">
                            <?= $user->status ?>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <a href="<?= url_to('edit-my-profile') ?>"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md">
            <i class="fa-solid fa-edit "></i>
            Edit
        </a>
    </div>
</div>

<?= $this->endSection(); ?>