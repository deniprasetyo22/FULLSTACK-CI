<div class="p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-4 pb-4">{page_title}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Users -->
        <div class="bg-blue-600 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Users</h3>
            <p class="text-3xl font-bold mt-2">{total_users}</p>
        </div>

        <!-- Active Users -->
        <div class="bg-indigo-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Active Users</h3>
            <p class="text-3xl font-bold mt-2">{active_users}</p>
        </div>

        <!-- New Users This Month -->
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">New Users This Month</h3>
            <p class="text-3xl font-bold mt-2">{new_users_this_month}</p>
        </div>

        <!-- Growth Percentage -->
        <div class="bg-pink-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">User Growth</h3>
            <p class="text-3xl font-bold mt-2">{growth_percentage}%</p>
        </div>

        <!-- Total Products -->
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Total Products</h3>
            <p class="text-3xl font-bold mt-2">{total_products}</p>
        </div>

        <!-- Active Products -->
        <div class="bg-teal-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Active Products</h3>
            <p class="text-3xl font-bold mt-2">{active_products}</p>
        </div>

        <!-- Out of Stock Products -->
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">Out of Stock</h3>
            <p class="text-3xl font-bold mt-2">{out_of_stock}</p>
        </div>

        <!-- On Sale Products -->
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold">On Sale Products</h3>
            <p class="text-3xl font-bold mt-2">{on_sale}</p>
        </div>
    </div>
</div>