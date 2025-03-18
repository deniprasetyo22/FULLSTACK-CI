<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php foreach ($errors as $error): ?>
<li><?= esc($error) ?></li>
<?php endforeach ?>

<?= form_open_multipart('upload', ['id' => 'upload-form', 'class' => 'pristine-validate']) ?>
<div class="mb-4">
    <label for="userFile" class="block text-sm font-medium text-gray-700">
        Pilih Gambar (JPG, JPEG, PNG, GIF - Max 5MB):
    </label>

    <input type="file" name="userfile" id="userfile" required
        class="mt-2 block w-full border border-gray-300 rounded-lg shadow-sm p-2 text-sm text-gray-900 focus:ring focus:ring-blue-300"
        data-pristine-required-message="Silakan pilih file untuk diunggah" />

    <div id="file-type-error" class="text-red-500 text-sm mt-2 hidden">
        File harus berupa gambar (JPG, JPEG, PNG, GIF)
    </div>
    <div id="file-size-error" class="text-red-500 text-sm mt-2 hidden">
        Ukuran file tidak boleh melebihi 5MB
    </div>

    <img id="image-preview" class="mt-4 hidden w-full max-w-xs rounded-lg shadow-md" src="#" alt="Image Preview" />
</div>

<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
    Upload
</button>

</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("upload-form");
    var pristine = new Pristine(form);

    var fileInput = document.getElementById('userfile');
    var fileTypeError = document.getElementById('file-type-error');
    var fileSizeError = document.getElementById('file-size-error');
    var imagePreview = document.getElementById('image-preview');

    var maxSize = 5 * 1024 * 1024;
    var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    var allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif'];

    pristine.addValidator(fileInput, function(value) {
        fileTypeError.style.display = 'none';
        fileSizeError.style.display = 'none';
        imagePreview.style.display = 'none';


        if (fileInput.files.length === 0) {
            return true;
        }

        var file = fileInput.files[0];
        var validType = allowedTypes.includes(file.type);

        if (!validType) {
            var fileName = file.name.toLowerCase();
            validType = allowedExtensions.some(function(ext) {
                return fileName.endsWith(ext);
            });
        }
        if (!validType) {
            fileTypeError.style.display = 'block';
            return false;
        }

        if (file.size > maxSize) {
            fileSizeError.style.display = 'block';
            return false;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(file);


        return true;
    }, "Validasi file gagal", 5, false);


    form.addEventListener('submit', function(e) {
        var valid = pristine.validate();
        if (!valid) {
            e.preventDefault();
        }
    });


    fileInput.addEventListener('change', function() {
        fileTypeError.style.display = 'none';
        fileSizeError.style.display = 'none';
        pristine.validate(fileInput);
    });
});
</script>


<?= $this->endSection(); ?>