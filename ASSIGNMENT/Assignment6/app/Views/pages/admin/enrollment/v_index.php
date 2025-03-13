<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <h2 class="text-2xl font-semibold mb-4 text-center mb-2"><?= $page_title ?></h2>

    <?php if(session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <i class="fa-solid fa-circle-info mr-2"></i>
        <span class="font-medium"> <?= session()->getFlashdata('message') ?></span>
    </div>
    <?php endif; ?>

    <div>
        <a href="<?= base_url('admin/create-enrollment') ?>"
            class="bg-blue-500 hover:bg-blue-600 rounded text-white py-1.5 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 py-2 px-4 text-center">ID</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Student</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Course</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Academic Year</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Semester</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Status</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$enrollments) : ?>
                <tr>
                    <td colspan="2" class="text-center py-2">No items</td>
                </tr>
                <?php else: ?>
                <?php foreach ($enrollments as $enrollment) : ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->id ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->student_name ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->course_name ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->academic_year ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->semester ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $enrollment->status ?></td>
                    <td class="border border-gray-300 py-2 px-4">
                        <div class="flex justify-center space-x-2">
                            <a href="<?= esc(base_url('admin/edit-enrollment/'.$enrollment->id)) ?>"
                                class="text-yellow-500 hover:text-yellow-600">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form action="<?= esc(base_url('admin/delete-enrollment/'.$enrollment->id)) ?>"
                                method="post">
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
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>