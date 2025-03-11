<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <div>
        <a href="<?= url_to('course-list') ?>" class="text-blue-500 hover:underline">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>

    <div class="pb-4">
        <h2 class="text-2xl font-semibold text-center"><?= $page_title ?></h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <tbody>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border border-gray-200 font-bold">Course Code:</td>
                    <td class="py-2 px-4 border border-gray-200"><?= $course->code ?></td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border border-gray-200 font-bold">Course Name:</td>
                    <td class="py-2 px-4 border border-gray-200"><?= $course->name ?></td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border border-gray-200 font-bold">Credits:</td>
                    <td class="py-2 px-4 border border-gray-200"><?= $course->credits ?></td>
                </tr>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border border-gray-200 font-bold">Semester:</td>
                    <td class="py-2 px-4 border border-gray-200"><?= $course->semester ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>