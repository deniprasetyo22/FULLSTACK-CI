<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <h2 class="text-2xl font-semibold text-center mb-2"><?= esc($page_title) ?></h2>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium"><?= session()->getFlashdata('message') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <div class="mb-2">
        <a href="/create-student" class="bg-blue-500 hover:bg-blue-600 rounded text-white py-1 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">NIM</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Program Study</th>
                <th class="border border-gray-300 px-4 py-2">Semester</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Entry Year</th>
                <th class="border border-gray-300 px-4 py-2">GPA</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2"><?= esc($student->id) ?></td>
                <td class="border border-gray-300 px-4 py-2"><?= esc($student->student_id) ?></td>
                <td class="border border-gray-300 px-4 py-2"><?= esc($student->name) ?></td>
                <td class="border border-gray-300 px-4 py-2"><?= esc($student->study_program) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->current_semester) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->academic_status) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->entry_year) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->gpa) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <div class="flex justify-center gap-3">
                        <a href="<?= url_to('student-profile', esc(strtolower(str_replace(' ', '-', $student->name)))) ?>"
                            class="text-blue-500 hover:text-blue-600">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= url_to('edit-student',esc($student->id))?>"
                            class="text-yellow-500 hover:text-yellow-600">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <form action="<?= url_to('delete-student', esc($student->id)) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="text-red-500 hover:text-red-600">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>