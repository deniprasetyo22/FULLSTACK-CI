<div class="h-full flex flex-col bg-gray-800 text-white">
    <!-- Logo -->
    <div class="p-4 text-center text-lg font-bold bg-gray-900">
        Admin Panel
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="/" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="/dashboard" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= url_to('student-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Student List</span>
                </a>
            </li>
            <li>
                <a href="<?= url_to('course-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Course List</span>
                </a>
            </li>
        </ul>
    </nav>
</div>