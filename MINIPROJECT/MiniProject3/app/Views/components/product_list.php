<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">Product List</h1>

    <!-- Cell Top Sales -->
    <div class="mb-6">
        {!product_statistics_cell!}
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {products}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative flex justify-between mb-8">
                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 rounded-xl">
                    <p>{is_new}</p>
                </div>
                <div class="absolute top-2 left-2 bg-green-500 text-white px-2 rounded-xl">
                    <p>{is_sale}</p>
                </div>
            </div>

            <div class="relative p-4">
                <h2 class="text-xl font-semibold mb-2">{name}</h2>
                <p class="text-gray-600 mb-1">Category: {category}</p>
                <p class="text-gray-800 font-bold mb-1">Price: Rp {price}</p>
            </div>

            <div class="p-4 bg-gray-100 text-center">
                <a href="product-detail/{slug}"
                    class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">
                    View
                </a>
            </div>
        </div>
        {/products}
    </div>
</div>