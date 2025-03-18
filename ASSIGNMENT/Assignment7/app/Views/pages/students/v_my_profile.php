<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col p-6 bg-white shadow rounded-lg h-full">

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
                    <td class="py-2 px-4 font-bold">Username</td>
                    <td class="py-2 px-4"><?= user()->username ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Email</td>
                    <td class="py-2 px-4"><?= user()->email ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Student ID</td>
                    <td class="py-2 px-4"><?= $student->student_id ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Name</td>
                    <td class="py-2 px-4"><?= $student->name ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Study Program</td>
                    <td class="py-2 px-4"><?= $student->study_program ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Current Semester</td>
                    <td class="py-2 px-4"><?= $student->current_semester ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Academic Status</td>
                    <td class="py-2 px-4"><?= $student->academic_status ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">GPA</td>
                    <td class="py-2 px-4"><?= $student->gpa ?></td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Entry Year</td>
                    <td class="py-2 px-4"><?= $student->entry_year ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <a href="<?= base_url('student/edit-my-profile') ?>"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md">
            <i class="fa-solid fa-edit "></i>
            Edit
        </a>
    </div>
</div>
<?= $this->endSection() ?>