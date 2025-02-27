<h2 class="text-2xl font-semibold mb-4 text-center mb-4">{page_title}</h2>

<div class="overflow-x-auto">
    <table class="table-auto w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 py-2 px-4 text-left">ID</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Course Code</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Course Name</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Credits</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Semester</th>
            </tr>
        </thead>
        <tbody>
            {courses}
            <tr class="border-b hover:bg-gray-100">
                <td class="border border-gray-300 py-2 px-4">{id}</td>
                <td class="border border-gray-300 py-2 px-4">{code}</td>
                <td class="border border-gray-300 py-2 px-4">{name}</td>
                <td class="border border-gray-300 py-2 px-4">{credits}</td>
                <td class="border border-gray-300 py-2 px-4">{semester}</td>
            </tr>
            {/courses}
        </tbody>
    </table>
</div>