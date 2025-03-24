<div class="h-full flex flex-col bg-gray-800 text-white">
    <!-- Logo -->
    <div class="p-4 text-center text-lg font-bold bg-gray-900">
        Admin Panel
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <!-- <li>
                <a href="/" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-house w-5"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li> -->

            <?php if(in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-table-columns w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('admin/report-student-by-program-study') ?>"
                    class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-table-columns w-5"></i>
                    <span class="ml-3">Report</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('lecturer')) : ?>
            <li>
                <a href="<?= base_url('lecturer/dashboard') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-table-columns w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('student')) : ?>
            <li>
                <a href="<?= base_url('student/dashboard') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-table-columns w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('admin/student-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-users w-5"></i>
                    <span class="ml-3">Student List</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin') || in_groups('lecturer')) : ?>
            <li>
                <a href="<?= base_url('course-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-list w-5"></i>
                    <span class="ml-3">Course List</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('admin/users') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-users w-5"></i>
                    <span class="ml-3">User List</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('student')) : ?>
            <li>
                <a href="<?= base_url('student/profile' ) ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-user w-5"></i>
                    <span class="ml-3">My Profile</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('admin')) : ?>
            <li>
                <a href="<?= base_url('admin/enrollment') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="ml-3">Enrollments</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_groups('student')) : ?>
            <li>
                <a href="<?= base_url('student/enrollment/my-enrollments') ?>"
                    class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="ml-3">My Enrollments</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-700">
        <?php if(logged_in()) : ?>
        <a href="/logout"
            class="w-full flex items-center justify-center p-2 rounded bg-red-600 hover:bg-red-700 text-white">
            <i class="fa-solid fa-sign-out-alt w-5"></i>
            <span class="ml-3">Logout</span>
        </a>
        <?php else : ?>
        <a href="/login"
            class="w-full flex items-center justify-center p-2 rounded bg-green-600 hover:bg-green-700 text-white">
            <i class="fa-solid fa-sign-out-alt w-5"></i>
            <span class="ml-3">Login</span>
        </a>
        <?php endif; ?>
    </div>
</div>