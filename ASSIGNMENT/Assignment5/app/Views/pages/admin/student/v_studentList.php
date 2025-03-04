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
        <a href="/create-student" class="bg-blue-500 hover:bg-blue-600 rounded text-white py-2 px-3">
            <i class="fa-solid fa-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <form action="<?= $baseUrl ?>" method="get" class="space-y-4">
        <div class="flex flex-wrap gap-4">
            <div class="w-full md:w-6/12">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" value="<?= $params->search ?>"
                        class="flex-1 p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari ID, Nama, Program Study, Semester, Entry Year atau GPA...">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
                </div>
            </div>
            <div class="w-full md:w-2/12">
                <select name="academic_status"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <?php foreach ($academic_status as $status): ?><option value="<?= $status ?>"
                        <?= ($params->academic_status == $status) ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="study_program"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Study Program</option>
                    <?php foreach ($study_program as $program): ?><option value="<?= $program ?>"
                        <?= ($params->study_program == $program) ? 'selected' : '' ?>><?= ucfirst($program) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="entry_year"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Entry Year</option>
                    <?php foreach ($entry_year as $year): ?><option value="<?= $year ?>"
                        <?= ($params->entry_year == $year) ? 'selected' : '' ?>><?= ucfirst($year) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-2/12">
                <select name="perPage"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <?php foreach ([5, 10, 25, 50] as $perPage): ?><option value="<?= $perPage ?>"
                        <?= ($params->perPage == $perPage) ? 'selected' : '' ?>><?= $perPage ?> per halaman</option>
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



    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white">
                <!-- <th class="border border-gray-300 px-4 py-2">ID</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('id', $baseUrl) ?>">
                        ID <?= $params->isSortedBy('id') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">NIM</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('student_id', $baseUrl) ?>">
                        NIM
                        <?= $params->isSortedBy('student_id') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">Name</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('name', $baseUrl) ?>">
                        Name
                        <?= $params->isSortedBy('name') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">Program Study</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('program_study', $baseUrl) ?>">
                        Program Study
                        <?= $params->isSortedBy('program_study') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">Semester</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('current_semester', $baseUrl) ?>">
                        Semester
                        <?= $params->isSortedBy('current_semester') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">Status</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('academic_status', $baseUrl) ?>">
                        Status
                        <?= $params->isSortedBy('academic_status') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">Entry Year</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('entry_year', $baseUrl) ?>">
                        Entry Year
                        <?= $params->isSortedBy('entry_year') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
                <!-- <th class="border border-gray-300 px-4 py-2">GPA</th> -->
                <th class="border border-gray-300 px-4 py-2">
                    <a href="<?= $params->getSortUrl('gpa', $baseUrl) ?>">
                        GPA
                        <?= $params->isSortedBy('gpa') ? ($params->getSortDirection() == 'asc' ? '↑' : '↓') : '↕' ?>
                    </a>
                </th>
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
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->current_semester) ?>
                </td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->academic_status) ?>
                </td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->entry_year) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center"><?= esc($student->gpa) ?></td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <div class="flex justify-center items-center gap-3">
                        <a href="<?= url_to('student-profile', esc(strtolower(str_replace(' ', '-', $student->name)))) ?>"
                            class="text-blue-500 hover:text-blue-600">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= url_to('edit-student', esc($student->id)) ?>"
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
    <div class="flex justify-center">
        <?= $pager->links('students', 'custom_pager') ?>
    </div>
    <div class="text-center mt-2">
        <small>Menampilkan <?= count($students) ?> dari <?= $total ?>
            total data (Halaman <?= $params->page_students ?>)</small>
    </div>
</div>
<?= $this->endSection() ?>