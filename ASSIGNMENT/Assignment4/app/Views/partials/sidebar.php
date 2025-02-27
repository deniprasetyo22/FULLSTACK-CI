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
                    <i class="fa-solid fa-house w-5"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="/dashboard" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-table-columns w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= url_to('student-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-users w-5"></i>
                    <span class="ml-3">Student List</span>
                </a>
            </li>
            <li>
                <a href="<?= url_to('course-list') ?>" class="flex items-center p-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-list w-5"></i>
                    <span class="ml-3">Course List</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-700">
        <a href="#" class="w-full flex items-center justify-center p-2 rounded bg-red-600 hover:bg-red-700 text-white">
            <i class="fa-solid fa-sign-out-alt w-5"></i>
            <span class="ml-3">Logout</span>
        </a>
    </div>
</div>