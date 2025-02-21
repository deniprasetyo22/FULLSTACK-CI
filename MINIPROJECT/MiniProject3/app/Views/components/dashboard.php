<div class="p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-4 pb-4">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Users -->
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Users</h3>
            <p class="text-3xl font-bold mt-2">{total_users}</p>
        </div>

        <!-- Total Products -->
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Products</h3>
            <p class="text-3xl font-bold mt-2">{total_products}</p>
        </div>

        <!-- New Orders -->
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">New Orders</h3>
            <p class="text-3xl font-bold mt-2">{new_orders}</p>
        </div>

        <!-- Monthly Growth -->
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Monthly Growth</h3>
            <p class="text-3xl font-bold mt-2">{monthly_growth_percentage}%</p>
        </div>
    </div>
</div>