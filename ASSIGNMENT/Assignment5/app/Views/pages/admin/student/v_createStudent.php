<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <a href="<?= url_to('student-list') ?>" class="text-blue-500 hover:underline">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <h2 class="text-2xl font-semibold text-center mb-2">
        <?= $page_title ?>
    </h2>

    <form action="<?= url_to('store-student') ?>" method="post" id="formData" novalidate>
        <?= csrf_field() ?>

        <!-- Student ID -->
        <div class="mb-4">
            <label for="student_id" class="block text-gray-700 font-semibold mb-2">Student ID:</label>
            <input type="number" id="student_id" name="student_id" data-pristine-required
                data-pristine-required-message="Student ID is required" data-pristine-minlength="3"
                data-pristine-minlength-message="Student ID must be at least 3 characters long"
                class="w-full p-2 border <?= session('errors.student_id') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('student_id') ?>">
            <?php if (isset(session('errors')['student_id'])) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors')['student_id'] ?>
            </div>
            <?php endif ?>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
            <input type="text" id="name" name="name" data-pristine-required
                data-pristine-required-message="Name is required"
                class="w-full p-2 border <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('name') ?>">
            <?php if (session('errors.name')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.name') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Study Program -->
        <div class="mb-4">
            <label for="study_program" class="block text-gray-700 font-semibold mb-2">Study Program:</label>
            <input type="text" id="study_program" name="study_program" data-pristine-required
                data-pristine-required-message="Study Program is required"
                class="w-full p-2 border <?= session('errors.study_program') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('study_program') ?>">
            <?php if (session('errors.study_program')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.study_program') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Current Semester -->
        <div class="mb-4">
            <label for="current_semester" class="block text-gray-700 font-semibold mb-2">Current Semester:</label>
            <input type="number" id="current_semester" name="current_semester" data-pristine-required
                data-pristine-required-message="Current Semester is required" data-pristine-min="1"
                data-pristine-min-message="Semester cannot be less than 1" data-pristine-max="8"
                data-pristine-max-message="Semester cannot be more than 8"
                class="w-full p-2 border <?= session('errors.current_semester') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('current_semester') ?>">
            <?php if (session('errors.current_semester')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.current_semester') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Academic Status -->
        <div class="mb-4">
            <label for="academic_status" class="block text-gray-700 font-semibold mb-2">Academic Status:</label>
            <select id="academic_status" name="academic_status" data-pristine-required
                data-pristine-required-message="Academic Status is required"
                class="w-full p-2 border <?= session('errors.academic_status') ? 'border-red-500' : 'border-gray-300' ?> rounded">
                <option value="" disabled selected>-- Select Status --</option>
                <?php foreach ($academic_status as $status): ?>
                <option value="<?= esc($status) ?>" <?= old('academic_status') == $status ? 'selected' : '' ?>>
                    <?= esc($status) ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (session('errors.academic_status')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.academic_status') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Entry Year -->
        <div class="mb-4">
            <label for="entry_year" class="block text-gray-700 font-semibold mb-2">Entry Year:</label>
            <input type="number" id="entry_year" name="entry_year" data-pristine-required
                data-pristine-required-message="Entry Year is required"
                class="w-full p-2 border <?= session('errors.entry_year') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('entry_year') ?>">
            <?php if (session('errors.entry_year')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.entry_year') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- GPA -->
        <div class="mb-4">
            <label for="gpa" class="block text-gray-700 font-semibold mb-2">GPA:</label>
            <input type="text" id="gpa" name="gpa" data-pristine-required
                data-pristine-required-message="GPA is required" data-pristine-min="0.00"
                data-pristine-min-message="GPA cannot be less than 0.00" data-pristine-max="4.00"
                data-pristine-max-message="GPA cannot be more than 4.00"
                class="w-full p-2 border <?= session('errors.gpa') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('gpa') ?>">
            <?php if (session('errors.gpa')) : ?>
            <div class="text-red-500 text-sm">
                <?= session('errors.gpa') ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
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