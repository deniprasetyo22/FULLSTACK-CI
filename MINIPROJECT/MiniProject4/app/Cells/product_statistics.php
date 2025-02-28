<div class="p-4 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Top Sales</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="py-2 px-4 text-left">No</th>
                    <th class="py-2 px-4 text-left">Product Nme</th>
                    <th class="py-2 px-4 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($topSales)): ?>
                <?php foreach ($topSales as $index => $sale): ?>
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4"><?= $index + 1 ?></td>
                    <td class="py-2 px-4"><?= esc($sale['product_name']) ?></td>
                    <td class="py-2 px-4 font-medium"><?= esc($sale['total_sold']) ?> Sold</td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3" class="py-2 px-4 text-center text-red-500">No data available</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>