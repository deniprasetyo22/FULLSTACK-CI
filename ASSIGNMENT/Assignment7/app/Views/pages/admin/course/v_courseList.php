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
        <a href="<?= url_to('create-course') ?>" class="bg-blue-500 hover:bg-blue-600 rounded text-white py-1.5 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <form action="<?= $baseUrl ?>" method="get" class="space-y-4">
        <div class="flex flex-wrap gap-4">
            <div class="w-full md:w-4/12">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" value="<?= $params->search ?>"
                        class="flex-1 p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari ID, Course Code, Course Name, Credits or Semester...">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
                </div>
            </div>
            <div class="w-full md:w-2/12">
                <select name="credits"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">All Credits</option>
                    <?php foreach ($credits as $c): ?><option value="<?= $c ?>"
                        <?= ($params->credits == $c) ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="semester"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">All Semester</option>
                    <?php foreach ($semesters as $s): ?><option value="<?= $s ?>"
                        <?= ($params->semester == $s) ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="perPage"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <?php foreach ([5, 10, 25, 50] as $perPage): ?><option value="<?= $perPage ?>"
                        <?= ($params->perPage == $perPage) ? 'selected' : '' ?>><?= $perPage ?> per page</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-1/12">
                <a href="<?= $params->getResetUrl($baseUrl) ?>"
                    class="block text-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Reset</a>
            </div>
        </div>
        <input type="hidden" name="sort" value="<?= $params->sort; ?>">
        <input type="hidden" name="order" value="<?= $params->order; ?>">
    </form>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 py-2 px-4 text-center">ID</th>
                    <th class="border border-gray-300 py-2 px-4 text-center">
                        <a href="<?= $params->getSortUrl('code', $baseUrl) ?>">
                            Course Code
                            <?= $params->isSortedBy('code') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                        </a>
                    </th>
                    <th class="border border-gray-300 py-2 px-4 text-center">
                        <a href="<?= $params->getSortUrl('name', $baseUrl) ?>">
                            Course Name
                            <?= $params->isSortedBy('name') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                        </a>
                    </th>
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
        <div class="flex justify-center mt-2">
            <?= $pager->links('courses', 'custom_pager') ?>
        </div>
        <div class="text-center mt-2">
            <small>Menampilkan <?= count($courses) ?> dari <?= $total ?>
                total data (Halaman <?= $params->page ?>)</small>
        </div>
    </div>
</div>
<?= $this->endSection() ?>