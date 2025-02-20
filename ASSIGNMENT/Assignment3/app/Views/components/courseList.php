<h2 class="text-2xl font-semibold mb-4 text-center my-4">{page_title}</h2>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="py-2 px-4 text-left">Course Code</th>
                <th class="py-2 px-4 text-left">Course Name</th>
            </tr>
        </thead>
        <tbody>
            {content}
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4">{course_code}</td>
                <td class="py-2 px-4">{course_name}</td>
            </tr>
            {/content}
        </tbody>
    </table>
</div>