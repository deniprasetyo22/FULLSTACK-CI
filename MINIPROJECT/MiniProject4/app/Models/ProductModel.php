<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = \App\Entities\Product::class;
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'description', 'price', 'stock', 'category_id', 'status', 'is_new', 'is_sale'];
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name'  => 'required|min_length[3]',
        'price' => 'required|numeric|greater_than[0]',
        'stock' => 'required|integer|greater_than_equal_to[0]',
        'category_id' => 'required',
        'description' => 'required'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama produk wajib diisi.',
            'min_length' => 'Nama produk minimal 3 karakter.'
        ],
        'price' => [
            'required' => 'Harga wajib diisi.',
            'numeric' => 'Harga harus berupa angka.',
            'greater_than' => 'Harga harus lebih dari 0.'
        ],
        'stock' => [
            'required' => 'Stok wajib diisi.',
            'integer' => 'Stok harus berupa angka bulat.',
            'greater_than_equal_to' => 'Stok tidak boleh negatif.'
        ],
        'category_id' => [
            'required' => 'Kategori wajib dipilih.'
        ],
        'description' => [
            'required' => 'Deskripsi wajib diisi.'
        ]
    ];

    public function getProductsWithCategory()
    {
        return $this->select('products.*, categories.name as category_name')
                    ->join('categories', 'categories.id = products.category_id')
                    ->findAll();
    }

    public function getProductsWithCategoryAndImage()
    {
        return $this->select('products.*, categories.name as category_name, product_images.image_path as image_url')
            ->join('categories', 'categories.id = products.category_id')
            ->join('product_images', 'product_images.product_id = products.id AND product_images.is_primary = 1', 'left') // Hanya gambar utama
            ->orderBy('products.created_at', 'desc')
            ->groupBy('products.id');
    }


    public function findActiveProducts()
    {
        return $this->where('status', 'active')->findAll();
    }

    public function getLowStockProducts(int $threshold = 10)
    {
        return $this->where('stock <', $threshold)->findAll();
    }

    public function getProductsByCategory(int $categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function countTotalProducts(): int
    {
        return $this->countAllResults();
    }

    public function getProductStatistics(): array
    {
        $totalProducts = $this->countAllResults();
        $activeProducts = $this->where('status', 'active')->countAllResults();
        $outOfStock = $this->where('stock', 0)->countAllResults();
        $onSale = $this->where('is_sale', 1)->countAllResults();

        return [
            'total_products' => $totalProducts,
            'active_products' => $activeProducts,
            'out_of_stock' => $outOfStock,
            'on_sale' => $onSale
        ];
    }
}