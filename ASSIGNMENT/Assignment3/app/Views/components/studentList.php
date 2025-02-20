<h2 class="text-2xl font-semibold mb-4 text-center my-4">{page_title}</h2>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Program Study</th>
                <th class="py-2 px-4 text-left">Semester</th>
                <th class="py-2 px-4 text-left">GPA</th>
                <th class="py-2 px-4 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            {students}
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4">{studentId}</td>
                <td class="py-2 px-4">{studentName}</td>
                <td class="py-2 px-4">{programStudy}</td>
                <td class="py-2 px-4">{currentSemester}</td>
                <td class="py-2 px-4">{gpa}</td>
                <td>
                    <a href="/student/{slug}" class="py-2 px-4">
                        <button class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded">Detail</button>
                    </a>
                </td>
            </tr>
            {/students}
        </tbody>
    </table>
</div>