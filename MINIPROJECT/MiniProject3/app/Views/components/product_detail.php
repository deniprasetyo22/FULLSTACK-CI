<div class="container mx-auto p-6 md:w-1/2">
    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
        <div class="relative mb-5 top-2 left-2">
            <a href="/" class="flex items-center text-blue-500 hover:text-blue-600">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Back
            </a>
        </div>
        <h1 class="text-2xl font-bold text-center pt-6">Product Detail</h1>
        <div class="p-4">
            <table class="border border-collapse md:w-1/2 mx-auto my-12">
                <tbody>
                    <tr>
                        <td class="font-bold border p-4">Product Name:</td>
                        <td class="border p-4">{name}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Category:</td>
                        <td class="border p-4">{category}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Price:</td>
                        <td class="border p-4">Rp.{price}</td>
                    </tr>
                    <tr>
                        <td class="font-bold border p-4">Stock:</td>
                        <td class="border p-4">{stock}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>