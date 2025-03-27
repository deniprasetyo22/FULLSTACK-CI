<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>Add Product<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-4 h-full">
    <div class="mx-auto bg-white p-6 rounded-lg shadow">
        <div class="relative mb-5">
            <a href="<?= url_to('product') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-xl font-bold text-center">Add New Product</h2>
        </div>

        <form action="<?= url_to('store_product') ?>" method="post" id="formData" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="name" class="block font-medium">Product Name</label>
                <input type="text" id="name" name="name" placeholder="Product Name" value="<?= old('name') ?>"
                    data-pristine-required data-pristine-required-message="Product name is required"
                    data-pristine-minLength="3"
                    data-pristine-minLength-message="Product name must be at least 3 characters"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.name')): ?>
                <p class="text-sm text-red-500"><?= session('errors.name') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Description</label>
                <textarea id="description" rows="4" name="description" placeholder="Description" data-pristine-required
                    data-pristine-required-message="Product description is required"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.description') ? 'border-red-500' : 'border-gray-300' ?>"><?= old('description') ?></textarea>
                <?php if(session('errors.description')): ?>
                <p class="text-sm text-red-500"><?= session('errors.description') ?></p>
                <?php endif; ?>
            </div>


            <div class="mb-4">
                <label for="price" class="block font-medium">Price</label>
                <input type="text" id="price" name="price" placeholder="Price" value="<?= old('price') ?>"
                    data-pristine-required data-pristine-required-message="Product price is required"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.price') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.price')): ?>
                <p class="text-sm text-red-500"><?= session('errors.price') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" id="stock" name="stock" placeholder="Stock" value="<?= old('stock') ?>"
                    data-pristine-required data-pristine-required-message="Product stock is required"
                    data-pristine-min="0" data-pristine-min-message="Stock cannot be negative"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.stock') ? 'border-red-500' : 'border-gray-300' ?>">
                <?php if(session('errors.stock')): ?>
                <p class="text-sm text-red-500"><?= session('errors.stock') ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-medium">Category</label>
                <select name="category_id" id="category_id" data-pristine-required
                    data-pristine-required-message="Product category is required"
                    class="w-full border border-gray-300 rounded p-2 <?= session('errors.category_id') ? 'border-red-500' : 'border-gray-300'  ?>">
                    <option value="" disabled selected>-- Choose Category --</option>
                    <?php foreach ($categoryList as $category) : ?>
                    <option value="<?= esc($category['id']) ?>"
                        <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                        <?= esc($category['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if(session('errors.category_id')): ?>
                <p class="text-sm text-red-500"><?= session('errors.category_id') ?></p>
                <?php endif; ?>
            </div>

            <div id="file-input-container" class="space-y-4">
                <div class="file-input-wrapper mb-4">
                    <label for="image" class="block font-medium">Product Image</label>
                    <input type="file" name="image[]" data-pristine-required
                        data-pristine-required-message="Product image is required"
                        class="file-input w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-1 focus:ring-blue-500 <?= session('errors.image') ? 'border-red-500' : 'border-gray-300' ?>">
                    <img class="image-preview hidden w-full max-w-xs rounded-lg shadow-md mt-2" src="#" alt="Preview">
                    <div class="file-type-error text-red-500 text-sm hidden">File must be in .jpg, .jpeg, .png, .webp
                        format</div>
                    <div class="file-size-error text-red-500 text-sm hidden">File size must be less than 5MB</div>
                    <div class="file-dimension-error text-red-500 text-sm hidden">Minimum dimension must be 600px X
                        600px.</div>
                </div>
            </div>
            <button type="button" id="add-image-button"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Add More Image
            </button>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded cursor-pointer">
                    <i class="fa-solid fa-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("price").addEventListener("input", function(e) {
    let value = e.target.value.replace(/[^\d]/g, ""); // Hanya angka
    if (value !== "") {
        e.target.value = "Rp. " + new Intl.NumberFormat("id-ID").format(value);
    } else {
        e.target.value = "Rp. 0";
    }
});

// Saat form dikirim, ubah format harga menjadi angka tanpa "Rp." dan "."
document.querySelector("form").addEventListener("submit", function(e) {
    let hargaInput = document.getElementById("price");
    hargaInput.value = hargaInput.value.replace(/\D/g, ""); // Hanya angka
});
</script>

<script>
let pristine;
window.onload = function() {
    let form = document.getElementById("formData");

    var pristine = new Pristine(form, {
        classTo: 'mb-4',
        errorClass: 'is-invalid',
        successClass: 'is-valid',
        errorTextParent: 'mb-4',
        errorTextTag: 'div',
        errorTextClass: 'text-red-500 text-sm'
    });

    // var fileTypeError = document.getElementById("file-type-error");
    // var fileSizeError = document.getElementById("file-size-error");
    // var imagePreview = document.getElementById("image-preview");
    // var fileDimensionError = document.getElementById("file-dimension-error");

    var maxFileSize = 5 * 1024 * 1024; // 5MB
    var allowedExtensions = ["jpg", "jpeg", "png", "webp"];
    var allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
    // var maxDimension = 600;
    var maxWidth = 600;
    var maxHeight = 600;

    function handleImagePreview(input) {
        let file = input.files[0];
        let fileWrapper = input.closest(".file-input-wrapper");
        let imgPreview = fileWrapper.querySelector(".image-preview");
        let fileTypeError = fileWrapper.querySelector(".file-type-error");
        let fileSizeError = fileWrapper.querySelector(".file-size-error");
        let fileDimensionError = fileWrapper.querySelector(".file-dimension-error");

        fileTypeError.classList.add("hidden");
        fileSizeError.classList.add("hidden");
        fileDimensionError.classList.add("hidden");
        imgPreview.classList.add("hidden");

        if (file) {
            let fileName = file.name;
            let fileExtension = fileName.split('.').pop().toLowerCase();
            let fileType = file.type;
            let fileSize = file.size;

            if (!allowedExtensions.includes(fileExtension)) {
                fileTypeError.classList.remove("hidden");
                return;
            }

            if (fileSize > maxFileSize) {
                fileSizeError.classList.remove("hidden");
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                let img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    if (img.width < maxWidth || img.height < maxHeight) {
                        fileDimensionError.classList.remove("hidden");
                    } else {
                        imgPreview.src = e.target.result;
                        imgPreview.classList.remove("hidden");
                    }
                };
            };
            reader.readAsDataURL(file);
        }
    }

    document.querySelectorAll(".file-input").forEach(input => {
        input.addEventListener("change", function() {
            handleImagePreview(this);
        });
    });

    document.getElementById("add-image-button").addEventListener("click", function() {
        let fileContainer = document.getElementById("file-input-container");

        let fileWrapper = document.createElement("div");
        fileWrapper.classList.add("file-input-wrapper", "mb-2");

        let inputFile = document.createElement("input");
        inputFile.type = "file";
        inputFile.name = "image[]";
        inputFile.classList.add("file-input", "w-full", "border", "border-gray-300", "rounded", "p-2",
            "focus:outline-none", );

        let imgPreview = document.createElement("img");
        imgPreview.classList.add("image-preview", "hidden", "w-full", "max-w-xs", "rounded-lg", "shadow-md",
            "mt-2");
        imgPreview.src = "#";

        let fileTypeError = document.createElement("div");
        fileTypeError.classList.add("file-type-error", "text-red-500", "text-sm", "hidden");
        fileTypeError.textContent = "File must be in .jpg, .jpeg, .png, .webp format";

        let fileSizeError = document.createElement("div");
        fileSizeError.classList.add("file-size-error", "text-red-500", "text-sm", "hidden");
        fileSizeError.textContent = "File size must be less than 5MB";

        let fileDimensionError = document.createElement("div");
        fileDimensionError.classList.add("file-dimension-error", "text-red-500", "text-sm", "hidden");
        fileDimensionError.textContent = "Minimum dimension must be 600px X 600px.";

        let removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.classList.add("ml-2", "px-2", "py-1", "bg-red-500", "text-white", "rounded",
            "hover:bg-red-600");
        removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
        removeBtn.addEventListener("click", function() {
            fileContainer.removeChild(fileWrapper);
        });

        inputFile.addEventListener("change", function() {
            handleImagePreview(this);
        });

        fileWrapper.appendChild(inputFile);
        fileWrapper.appendChild(imgPreview);
        fileWrapper.appendChild(fileTypeError);
        fileWrapper.appendChild(fileSizeError);
        fileWrapper.appendChild(fileDimensionError);
        fileWrapper.appendChild(removeBtn);
        fileContainer.appendChild(fileWrapper);
    });



    form.addEventListener('submit', function(e) {
        var valid = pristine.validate();
        if (!valid) {
            e.preventDefault();
        }
    });

};
</script>

<?= $this->endSection() ?>