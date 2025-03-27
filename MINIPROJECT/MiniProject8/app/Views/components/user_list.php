<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">User List</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {users}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative p-4">
                <h2 class="text-xl font-semibold mb-2">{fullName}</h2>
                <p class="text-gray-800 mb-1">Username: {userName}</p>
                <p class="text-gray-800 mb-1">Gender: {sex}</p>
                <p class="text-gray-800 mb-1">DOB: {dob}</p>
                <p class="text-gray-800 mb-1">Role: {role}</p>
            </div>

            <div class="p-4 bg-gray-100 text-center">
                <a href="/user-detail/{slug}"
                    class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">
                    View
                </a>
            </div>
        </div>
        {/users}
    </div>
</div>