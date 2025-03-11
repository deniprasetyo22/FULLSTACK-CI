<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <a href="<?= base_url('admin/users') ?>" class="text-blue-500 hover:underline">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <h2 class="text-2xl font-semibold text-center mb-2">
        <?= $page_title ?>
    </h2>

    <form action="<?= base_url('admin/users/store') ?>" method="post" id="formData" novalidate>
        <?= csrf_field() ?>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-semibold mb-2">Username:</label>
            <input type="text" id="username" name="username"
                class="w-full p-2 border <?= session('errors.username') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('username') ?>" required>
            <?php if (session('errors.username')) : ?>
            <p class="text-red-500 text-sm"> <?= session('errors.username') ?> </p>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
            <input type="email" id="email" name="email"
                class="w-full p-2 border <?= session('errors.email') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('email') ?>" required>
            <?php if (session('errors.email')) : ?>
            <p class="text-red-500 text-sm"> <?= session('errors.email') ?> </p>
            <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
            <input type="password" id="password" name="password"
                class="w-full p-2 border <?= session('errors.password') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                required>
            <?php if (session('errors.password')) : ?>
            <p class="text-red-500 text-sm"> <?= session('errors.password') ?> </p>
            <?php endif; ?>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="pass_confirm" class="block text-gray-700 font-semibold mb-2">Confirm Password:</label>
            <input type="password" id="pass_confirm" name="pass_confirm"
                class="w-full p-2 border <?= session('errors.pass_confirm') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                required>
            <?php if (session('errors.pass_confirm')) : ?>
            <p class="text-red-500 text-sm"> <?= session('errors.pass_confirm') ?> </p>
            <?php endif; ?>
        </div>

        <!-- Group -->
        <div class="mb-4">
            <label for="group" class="block text-gray-700 font-semibold mb-2">Group:</label>
            <select id="group" name="group"
                class="w-full p-2 border <?= session('errors.group') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                required>
                <option value="">-- Select Group --</option>
                <?php foreach ($groups as $group) : ?>
                <option value="<?= $group->id; ?>" <?= old('group') == $group->id ? 'selected' : '' ?>>
                    <?= $group->name; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (session('errors.group')) : ?>
            <p class="text-red-500 text-sm"> <?= session('errors.group') ?> </p>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                <i class="fa-solid fa-save"></i> Save
            </button>
        </div>
    </form>
</div>

<script>
window.onload = function() {
    let form = document.getElementById("formData");
    let pristine = new Pristine(form, {
        classTo: 'mb-4',
        errorClass: 'is-invalid',
        successClass: 'is-valid',
        errorTextParent: 'mb-4',
        errorTextTag: 'div',
        errorTextClass: 'text-red-500 text-sm'
    });

    form.addEventListener('submit', function(e) {
        let valid = pristine.validate();
        if (!valid) {
            e.preventDefault();
        }
    });
};
</script>
<?= $this->endSection() ?>