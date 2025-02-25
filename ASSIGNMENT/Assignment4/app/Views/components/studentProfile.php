<h2 class="text-2xl font-semibold mb-4 text-center my-4">{studentName}</h2>

<!-- Academic Status -->
<div class="mb-6">
    {!academic_status!}
</div>

<!-- Main Student Info -->
<div class="overflow-x-auto mb-6">
    <table class="min-w-full bg-white border border-gray-200">
        <tbody>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">ID</td>
                <td class="py-2 px-4">{studentId}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Name</td>
                <td class="py-2 px-4">{studentName}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Program Study</td>
                <td class="py-2 px-4">{programStudy}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">Current Semester</td>
                <td class="py-2 px-4">{currentSemester}</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4 font-bold">GPA</td>
                <td class="py-2 px-4">{gpa}</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Personal Information -->
<div class="mb-6">
    <h3 class="text-xl font-semibold mb-2">Personal Information</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <tbody>
                {personal_information}
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Date of Birth</td>
                    <td class="py-2 px-4">{DOB}</td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Gender</td>
                    <td class="py-2 px-4">{Gender}</td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4 font-bold">Email</td>
                    <td class="py-2 px-4">{Email}</td>
                </tr>
                {/personal_information}
            </tbody>
        </table>
    </div>
</div>


<!-- Course Enrollments -->
<div class="mb-6">
    <h3 class="text-xl font-semibold mb-2">Course Enrollments</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-2 px-4 text-left">Course Code</th>
                    <th class="py-2 px-4 text-left">Course Name</th>
                </tr>
            </thead>
            <tbody>
                {course_enrollments}
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{course_code}</td>
                    <td class="py-2 px-4">{course_name}</td>
                </tr>
                {/course_enrollments}
            </tbody>
        </table>
    </div>
</div>

<!-- Latest Course Grades -->
<div class="mb-6">
    {!latest_course_grades!}
</div>