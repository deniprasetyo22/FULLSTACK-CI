<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>
<div class="container mx-auto p-6 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 h-full">
    <form action=" <?= url_to('store-role') ?>" method="POST" id="formData">
        <div class="relative mb-5">
            <a href="<?= url_to('role') ?>"
                class="absolute left-0 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 rounded flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Add Role</h2>
        </div>
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" data-pristine-required data-pristine-required-message="Name is required"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?>"
                value="<?= old('name') ?>">
            <?php if(session('errors.name')): ?>
            <p class="text-sm text-red-500"><?= session('errors.name') ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <input type="text" name="description" data-pristine-required
                data-pristine-required-message="Description is required"
                class="border rounded w-full py-2 px-3 text-gray-700 <?= session('errors.description') ? 'border-red-500' : 'border-gray-300' ?>"
                value="<?= old('description') ?>">
            <?php if(session('errors.description')): ?>
            <p class="text-sm text-red-500"><?= session('errors.description') ?></p>
            <?php endif; ?>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                <i class="fa-solid fa-save"></i>
                <span>Submit</span>
            </button>
        </div>
    </form>
</div>

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


    form.addEventListener('submit', function(e) {
        var valid = pristine.validate();
        if (!valid) {
            e.preventDefault();
        }
    });

};
</script>
<?= $this->endSection() ?>