<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Student List
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto pb-8">
    <h2 class="text-2xl font-semibold mb-4 text-center my-4">Student List</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Student ID</th>
                    <th class="py-2 px-4 text-left">Name</th>
                    <th class="py-2 px-4 text-left">Program Study</th>
                    <th class="py-2 px-4 text-left">Semester</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Entry Year</th>
                    <th class="py-2 px-4 text-left">GPA</th>
                    <th class="py-2 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4"><?= esc($student->id) ?></td>
                    <td class="py-2 px-4"><?= esc($student->student_id ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->name ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->study_program ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->current_semester ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->academic_status ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->entry_year ?? '') ?></td>
                    <td class="py-2 px-4"><?= esc($student->gpa ?? '') ?></td>
                    <td>
                        <a href="/student/<?= esc($student->id ?? '') ?>" class="py-2 px-4 text-blue-500">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>