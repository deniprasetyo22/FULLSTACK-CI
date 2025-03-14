<div class="container mx-auto p-6 md:w-1/2">
    <div>
        {!user_profile_cell!}
    </div>
    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
        <div class="relative mb-5 top-2 left-2">
            <a href="/user-list" class="flex items-center text-blue-500 hover:text-blue-600">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Back
            </a>
        </div>
        <h1 class="text-2xl font-bold text-center pt-6">User Detail</h1>
        <div class="p-4">
            <table class="border border-collapse w-full mx-auto">
                <tbody>
                    <tr>
                        <td class="font-bold border p-4">Full Name:</td>
                        <td class="border p-4">{fullName}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Username:</td>
                        <td class="border p-4">{userName}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Sex:</td>
                        <td class="border p-4">{sex}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Date of Birth:</td>
                        <td class="border p-4">{dob}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Role:</td>
                        <td class="border p-4">{role}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Account Status:</td>
                        <td class="border p-4">{account_status}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Activity History Table -->
            <h2 class="text-xl font-bold text-center mt-8">Activity History</h2>
            <div class="overflow-x-auto">
                <table class="border border-collapse w-full mt-4">
                    <thead>
                        <tr>
                            <th class="border p-2 bg-gray-200">Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">{activity_history}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>