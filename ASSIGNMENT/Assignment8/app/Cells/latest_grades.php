<div class="mb-6">
    <h3 class="text-xl font-semibold mb-2">Latest Course Grades</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-2 px-4 text-left">No</th>
                    <th class="py-2 px-4 text-left">Course Name</th>
                    <th class="py-2 px-4 text-left">Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($latestCourse)): ?>
                <?php foreach ($latestCourse as $index => $value): ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4"><?= $index + 1 ?></td>
                    <td class="py-2 px-4"><?= esc($value['course_name']) ?></td>
                    <td class="py-2 px-4 text-primary"><?= esc($value['grade']) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3" class="py-2 px-4 text-center text-red-500">No course grades available.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>