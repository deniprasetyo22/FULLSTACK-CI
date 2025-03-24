<a href="/admin/student-list" class="text-blue-500 hover:underline">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Back</span>
</a>

<h2 class="text-2xl font-semibold mb-4 text-center my-4">{name}</h2>

<!-- Academic Status -->
<div class="mb-6">
    {! academic_status !}
</div>

<!-- Main Student Info -->
<div class="overflow-x-auto mb-6">
    <table class="min-w-full bg-white border border-gray-200 shadow-sm">
        <tbody>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">ID</td>
                <td class="py-2 px-4">{student_id}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Name</td>
                <td class="py-2 px-4">{name}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Study Program</td>
                <td class="py-2 px-4">{study_program}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Current Semester</td>
                <td class="py-2 px-4">{current_semester}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">GPA</td>
                <td class="py-2 px-4">{gpa}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Entry Year</td>
                <td class="py-2 px-4">{entry_year}</td>
            </tr>
        </tbody>
    </table>
</div>