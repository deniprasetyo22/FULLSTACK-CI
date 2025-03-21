<?= $this->extend('layouts/public_layout'); ?>

<?= $this->section('title') ?>
<?= esc($page_title) ?>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div class="container mx-auto md:w-1/2 flex flex-col p-6 bg-white shadow-lg rounded-lg my-5">
    <div>
        <a href="<?= url_to('my-profile') ?>" class="text-blue-500 hover:underline">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </div>

    <h2 class="text-2xl font-semibold text-center mb-2"><?= esc($page_title) ?></h2>

    <?php if(session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <i class="fa-solid fa-circle-info mr-2"></i>
        <span class="font-medium"> <?= session()->getFlashdata('message') ?></span>
    </div>
    <?php endif; ?>

    <form action="<?= url_to('update-my-profile') ?>" method="POST" id="formData" novalidate>
        <?= csrf_field()  ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="full_name" value="<?= old('full_name', esc($user->full_name)) ?>"
                class="w-full p-2 border rounded <?= session('errors.full_name') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.full_name')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.full_name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" value="<?= old('username', esc($user->username)) ?>"
                class="w-full p-2 border rounded <?= session('errors.username') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.username')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.username') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="<?= old('email', esc($user->email)) ?>"
                class="w-full p-2 border rounded <?= session('errors.email') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.email')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.email') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password (kosongkan jika tidak ingin
                diubah)</label>
            <input type="password" name="password"
                class="w-full p-2 border rounded <?= session('errors.password') ? 'border-red-500' : '' ?>">
            <?php if(session('errors.password')): ?>
            <p class="text-sm text-red-500"><?= session('errors.password') ?></p>
            <?php endif; ?>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                <i class="fa-solid fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<script>
let pristine;
window.onload = function() {
    let form = document.getElementById("formData");

    var pristine = new Pristine(form, {
        classTo: 'mb-4',
        errorClass: 'is-invalid',
        successClass: 'is-valid',
        errorTextParent: 'mb-4',
        errorTextTag: 'div',
        errorTextClass: 'text-red-500 text-sm'
    });


    form.addEventListener('submit', function(e) {
        var valid = pristine.validate();
        if (!valid) {
            e.preventDefault();
        }
    });

};
</script>
<?= $this->endSection() ?>