<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Admin Report
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="flex flex-col space-y-4 p-6 bg-white shadow rounded-lg h-full">
    <div class="container mx-auto mt-5 px-4 mb-5">
        <h2 class="text-center text-2xl font-semibold mb-4"><?= $title2 ?></h2>

        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="get"
                action="<?= site_url('admin/dashboard') ?>">
                <div>
                    <input type="text" id="name" name="name"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                        placeholder="Masukkan NIM atau Nama" value="<?= $filters['name'] ?? '' ?>">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Lihat Laporan
                    </button>
                    <a href="<?= site_url('admin/dashboard') ?>"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="flex justify-end mb-3">
            <a href="<?= site_url('admin/report') . (!empty($filters['student_id']) || !empty($filters['name']) ? '?' . http_build_query($filters) : '') ?>"
                class="bg-green-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-green-600">
                <i class="bi bi-file-excel"></i> Export Excel
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">No</th>
                            <th class="border border-gray-300 p-2">NIM</th>
                            <th class="border border-gray-300 p-2">Nama</th>
                            <th class="border border-gray-300 p-2">Program Studi</th>
                            <th class="border border-gray-300 p-2">Semester</th>
                            <th class="border border-gray-300 p-2">Kode MK</th>
                            <th class="border border-gray-300 p-2">Nama Mata Kuliah</th>
                            <th class="border border-gray-300 p-2">SKS</th>
                            <th class="border border-gray-300 p-2">Tahun Akademik</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enrollments)): ?>
                        <tr>
                            <td colspan="10" class="text-center border border-gray-300 p-2">Tidak ada data yang
                                ditemukan</td>
                        </tr>
                        <?php else: ?>
                        <?php $no = 1; foreach ($enrollments as $enrollment): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 p-2"><?= $no++ ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->student_id ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->name ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->study_program ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->current_semester ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->course_code ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->course_name ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->credits ?></td>
                            <td class="border border-gray-300 p-2">
                                <?= $enrollment->academic_year . ' - ' . $enrollment->enrollment_semester ?></td>
                            <td class="border border-gray-300 p-2"><?= $enrollment->status ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="border-top: 2px solid black; margin: 20px 0;"></div>

    <div class="container mx-auto mt-5 px-4">
        <h2 class="text-center text-2xl font-semibold mb-4"><?= $title1 ?></h2>
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <form class="grid grid-cols-1 md:grid-cols-3 gap-4"
                action="<?= base_url('admin/report-student-by-program-study-pdf') ?>" method="post" target="_blank">
                <div>
                    <select class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                        name="study_program">
                        <option value="">-- Pilih Program Studi --</option>
                        <?php foreach ($study_programs as $program): ?>
                        <option value="<?= $program ?>"> <?= $program ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <select class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                        name="entry_year">
                        <option value="">-- Pilih Tahun Masuk --</option>
                        <?php foreach ($entry_years as $year): ?>
                        <option value="<?= $year ?>"> <?= $year ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full">
                        Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>