<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <h2 class="text-2xl font-semibold mb-4 text-center mb-2"><?= $page_title ?></h2>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium"><?= session()->getFlashdata('message') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <div>
        <a href="<?= url_to('create-course') ?>" class="bg-blue-500 hover:bg-blue-600 rounded text-white py-1 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 py-2 px-4 text-center">ID</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Course Code</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Course Name</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Credits</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Semester</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course) : ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $course->id ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $course->code ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $course->name ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $course->credits ?></td>
                    <td class="border border-gray-300 py-2 px-4 text-center"><?= $course->semester ?></td>
                    <td class="border border-gray-300 py-2 px-4">
                        <div class="flex justify-center space-x-2">
                            <a href="<?= esc(url_to('course-detail', $course->id)) ?>"
                                class="text-blue-500 hover:text-blue-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= esc(url_to('edit-course', $course->id)) ?>"
                                class="text-yellow-500 hover:text-yellow-600">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <form action="<?= esc(url_to('delete-course', $course->id)) ?>" method="post">
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
</div>
<?= $this->endSection() ?>