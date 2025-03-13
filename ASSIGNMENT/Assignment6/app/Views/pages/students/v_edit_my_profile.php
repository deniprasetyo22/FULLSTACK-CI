<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col p-6 bg-white shadow rounded-lg h-full">

    <div>
        <a href="<?= base_url('student/my-profile') ?>" class="text-blue-500 hover:underline">
            <i class="fa-solid fa-arrow-left"></i>
            Back
        </a>
    </div>

    <h2 class="text-2xl font-semibold text-center mb-2"><?= esc($page_title) ?></h2>

    <form action="<?= base_url('student/update-my-profile/'.$student->id) ?>" method="POST" id="formData" novalidate>
        <?= csrf_field()  ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label class="block text-gray-700">Student ID</label>
            <input type="text" name="student_id" value="<?= old('student_id', esc($student->student_id)) ?>"
                class="w-full p-2 border rounded <?= session('errors.student_id') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.student_id')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.student_id') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="<?= old('name', esc($student->name)) ?>"
                class="w-full p-2 border rounded <?= session('errors.name') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.name')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Program Study</label>
            <input type="text" name="study_program" value="<?= old('study_program', esc($student->study_program)) ?>"
                class="w-full p-2 border rounded <?= session('errors.study_program') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.study_program')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.study_program') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Semester</label>
            <input type="number" name="current_semester"
                value="<?= old('current_semester', esc($student->current_semester)) ?>"
                class="w-full p-2 border rounded <?= session('errors.current_semester') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.current_semester')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.current_semester') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Academic Status</label>
            <select name="academic_status"
                class="w-full p-2 border rounded <?= session('errors.academic_status') ? 'border-red-500' : '' ?>">
                <?php foreach ($academic_status as $status) : ?>
                <option value="<?= esc($status) ?>"
                    <?= old('academic_status', $student->academic_status) == $status ? 'selected' : '' ?>>
                    <?= esc($status) ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (session('errors.academic_status')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.academic_status') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Entry Year</label>
            <input type="number" name="entry_year" value="<?= old('entry_year', esc($student->entry_year)) ?>"
                class="w-full p-2 border rounded <?= session('errors.entry_year') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.entry_year')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.entry_year') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">GPA</label>
            <input type="text" name="gpa" value="<?= old('gpa', esc($student->gpa)) ?>"
                class="w-full p-2 border rounded <?= session('errors.gpa') ? 'border-red-500' : '' ?>">
            <?php if (session('errors.gpa')) : ?>
            <p class="text-red-500 text-sm"><?= session('errors.gpa') ?></p>
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