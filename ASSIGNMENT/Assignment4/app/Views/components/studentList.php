<h2 class="text-2xl font-semibold text-center my-4">{page_title}</h2>

<div class="overflow-x-auto mb-4">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">NIM</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Program Study</th>
                <th class="border border-gray-300 px-4 py-2">Semester</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Entry Year</th>
                <th class="border border-gray-300 px-4 py-2">GPA</th>
            </tr>
        </thead>
        <tbody>
            {students}
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2 text-center">{id}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{studentId}</td>
                <td class="border border-gray-300 px-4 py-2">{studentName}</td>
                <td class="border border-gray-300 px-4 py-2">{studyProgram}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{currentSemester}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{academicStatus}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{entryYear}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{gpa}</td>
            </tr>
            {/students}
        </tbody>
    </table>
</div>