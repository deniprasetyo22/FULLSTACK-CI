<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <a href="<?= url_to('course-list') ?>" class="text-blue-500 hover:underline">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <h2 class="text-2xl font-semibold text-center mb-2">
        <?= $page_title ?>
    </h2>

    <form action="<?= url_to('store-course') ?>" method="post" id="formData" novalidate>
        <?= csrf_field() ?>

        <!-- Course Code -->
        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-semibold mb-2">Course Code:</label>
            <input type="text" id="code" name="code" data-pristine-required
                data-pristine-required-message="Code is required" data-pristine-minLength="8"
                data-pristine-minLength-message="Code must be 8 characters long" data-pristine-maxLength="8"
                data-pristine-maxLength-message="Code must be 8 characters long"
                class="w-full p-2 border <?= session('errors.code') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('code') ?>">
            <?php if (session('errors.code')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.code') ?></p>
            <?php endif; ?>
        </div>

        <!-- Course Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Course Name:</label>
            <input type="text" id="name" name="name" data-pristine-required
                data-pristine-required-message="Course Name is required"
                class="w-full p-2 border <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('name') ?>">
            <?php if (session('errors.name')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <!-- Credits -->
        <div class="mb-4">
            <label for="credits" class="block text-gray-700 font-semibold mb-2">Credits:</label>
            <input type="number" id="credits" name="credits" data-pristine-required
                data-pristine-required-message="Credits is required" data-pristine-min="1"
                data-pristine-min-message="Credtis cannot be less than 1" data-pristine-max="6"
                data-pristine-max-message="Credits cannot be more than 6"
                class="w-full p-2 border <?= session('errors.credits') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('credits') ?>">
            <?php if (session('errors.credits')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.credits') ?></p>
            <?php endif; ?>
        </div>

        <!-- Semester -->
        <div class="mb-4">
            <label for="semester" class="block text-gray-700 font-semibold mb-2">Semester:</label>
            <input type="number" id="semester" name="semester" data-pristine-required
                data-pristine-required-message="Credits is required" data-pristine-min="1"
                data-pristine-min-message="Credtis cannot be less than 1" data-pristine-max="8"
                data-pristine-max-message="Credits cannot be more than 8"
                class="w-full p-2 border <?= session('errors.semester') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('semester') ?>">
            <?php if (session('errors.semester')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.semester') ?></p>
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