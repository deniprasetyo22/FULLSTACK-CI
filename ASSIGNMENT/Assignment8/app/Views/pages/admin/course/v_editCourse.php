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

    <form action="<?= url_to('update-course', $course->id) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <!-- Course Code -->
        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-semibold mb-2">Course Code:</label>
            <input type="text" id="code" name="code"
                class="w-full p-2 border <?= session('errors.code') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('code', $course->code) ?>">
            <?php if (session('errors.code')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.code') ?></p>
            <?php endif; ?>
        </div>

        <!-- Course Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Course Name:</label>
            <input type="text" id="name" name="name"
                class="w-full p-2 border <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('name', $course->name) ?>">
            <?php if (session('errors.name')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <!-- Credits -->
        <div class="mb-4">
            <label for="credits" class="block text-gray-700 font-semibold mb-2">Credits:</label>
            <input type="number" id="credits" name="credits"
                class="w-full p-2 border <?= session('errors.credits') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('credits', $course->credits) ?>">
            <?php if (session('errors.credits')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.credits') ?></p>
            <?php endif; ?>
        </div>

        <!-- Semester -->
        <div class="mb-4">
            <label for="semester" class="block text-gray-700 font-semibold mb-2">Semester:</label>
            <input type="number" id="semester" name="semester"
                class="w-full p-2 border <?= session('errors.semester') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('semester', $course->semester) ?>">
            <?php if (session('errors.semester')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.semester') ?></p>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex space-x-4">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
                <i class="fa-solid fa-save"></i> Update
            </button>
            <a href="<?= url_to('course-list') ?>"
                class="w-full text-center bg-gray-500 hover:bg-gray-600 text-white p-2 rounded">
                <i class="fa-solid fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>