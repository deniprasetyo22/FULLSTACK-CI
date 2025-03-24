<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <a href="<?= base_url('admin/enrollment') ?>" class="text-blue-500 hover:underline">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <h2 class="text-2xl font-semibold text-center mb-2">
        <?= $page_title ?>
    </h2>

    <form action="<?= base_url('admin/store-enrollment') ?>" method="post" id="formData" novalidate>
        <?= csrf_field() ?>

        <!-- Student ID -->
        <div class="mb-4">
            <label for="student_id" class="block text-gray-700 font-semibold mb-2">Student</label>
            <select name="student_id" id="student_id" data-pristine-required
                data-pristine-required-message="Student is required"
                class="w-full border border-gray-300 rounded p-2 <?= session('errors.student_id') ? 'border-red-500' : 'border-gray-300'  ?>">
                <option value="" selected>-- Select Student --</option>
                <?php foreach($students as $student) : ?>
                <option value="<?= $student['id'] ?>">
                    <?= old('student_id') == $student['id'] ? 'selected' : '' ?>
                    <?= $student['name'] ?>
                </option>
                <?php endforeach ?>
            </select>
            <?php if (session('errors.student_id')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.student_id') ?></p>
            <?php endif; ?>
        </div>

        <!-- Course ID -->
        <div class="mb-4">
            <label for="course_id" class="block text-gray-700 font-semibold mb-2">Course</label>
            <select name="course_id" id="course_id" data-pristine-required
                data-pristine-required-message="Course is required"
                class="w-full border border-gray-300 rounded p-2 <?= session('errors.course_id') ? 'border-red-500' : 'border-gray-300'  ?>">
                <option value="" selected>-- Select Course --</option>
                <?php foreach($courses as $course) : ?>
                <option value="<?= $course['id'] ?>">
                    <?= old('course_id') == $course['id'] ? 'selected' : '' ?>
                    <?= $course['name'] ?>
                </option>
                <?php endforeach ?>
            </select>
            <?php if (session('errors.course_id')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.course_id') ?></p>
            <?php endif; ?>
        </div>

        <!-- Academic Year -->
        <div class="mb-4">
            <label for="academic_year" class="block text-gray-700 font-semibold mb-2">Academic Year</label>
            <input type="number" name="academic_year" id="academic_year" data-pristine-required
                data-pristine-required-message="Academic Year is required" placeholder="Academic Year"
                class="w-full p-2 border <?= session('errors.academic_year') ? 'border-red-500' : 'border-gray-300' ?> rounded"
                value="<?= old('academic_year') ?>">
            <?php if (session('errors.academic_year')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.academic_year') ?></p>
            <?php endif; ?>
        </div>

        <!-- Semester -->
        <div class="mb-4">
            <label for="semester" class="block text-gray-700 font-semibold mb-2">Semester</label>
            <select name="semester" id="semester" data-pristine-required
                data-pristine-required-message="Semester is required"
                class="w-full border border-gray-300 rounded p-2 <?= session('errors.semester') ? 'border-red-500' : 'border-gray-300'  ?>">
                <option value="" selected>-- Select Semester --</option>
                <?php foreach($semester as $s) : ?>
                <option value="<?= $s ?>">
                    <?= old('semester') == $s ? 'selected' : '' ?>
                    <?= $s ?>
                </option>
                <?php endforeach ?>
            </select>
            <?php if (session('errors.semester')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.semester') ?></p>
            <?php endif; ?>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
            <select name="status" id="status" data-pristine-required data-pristine-required-message="Status is required"
                class="w-full border border-gray-300 rounded p-2 <?= session('errors.status') ? 'border-red-500' : 'border-gray-300' ?>">
                <option value="" selected>-- Select Status --</option>
                <?php foreach ($statuses as $status) : ?>
                <option value="<?= $status ?>" <?= old('status') == $status ? 'selected' : '' ?>>
                    <?= $status ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (session('errors.status')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.status') ?></p>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                <i class="fa-solid fa-save"></i> Submit
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