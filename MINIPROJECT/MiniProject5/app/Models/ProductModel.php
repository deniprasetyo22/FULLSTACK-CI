<?php

namespace App\Models;

use App\Libraries\DataParams;
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
            'required' => 'Product name is required.',
            'min_length' => 'Product name must be at least 3 characters long.'
        ],
        'price' => [
            'required' => 'Price is required.',
            'numeric' => 'Price must be a number.',
            'greater_than' => 'Price must be greater than 0.'
        ],
        'stock' => [
            'required' => 'Stock is required.',
            'integer' => 'Stock must be a whole number.',
            'greater_than_equal_to' => 'Stock cannot be negative.'
        ],
        'category_id' => [
            'required' => 'Category must be selected.'
        ],
        'description' => [
            'required' => 'Description is required.'
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
            ->join('product_images', 'product_images.product_id = products.id AND product_images.is_primary IS TRUE', 'left');
    }
    


    public function findActiveProducts()
    {
        return $this->where('status', 'Active')->findAll();
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
        $activeProducts = $this->where('status', 'Active')->countAllResults();
        $outOfStock = $this->where('stock', 0)->countAllResults();
        $onSale = $this->where('is_sale', 1)->countAllResults();

        return [
            'total_products' => $totalProducts,
            'active_products' => $activeProducts,
            'out_of_stock' => $outOfStock,
            'on_sale' => $onSale
        ];
    }

    public function getFilteredProducts(DataParams $params)
    {
        $query = $this->getProductsWithCategoryAndImage();
        
        //Search
        if (!empty($params->search)) {
            $query->groupStart()
            ->where('CAST(products.id as TEXT) LIKE', "%$params->search%")
            ->orWhere('CAST(products.price as TEXT) LIKE', "%$params->search%")
            ->orWhere('CAST(products.stock as TEXT) LIKE', "%$params->search%")
            ->orLike('products.name', $params->search, 'both', null, true)
            ->orLike('products.description', $params->search, 'both', null, true)
            ->orLike('products.status', $params->search, 'both', null, true)
            ->orLike('categories.name', $params->search, 'both', null, true)
            ->groupEnd();
        }

        //Filter
        if (!empty($params->category)) {
            $this->where('category_id', $params->category);
        }
        if (!empty($params->price)) {
            [$min, $max] = explode('-', $params->price);
            $this->where('price >=', $min);
            $this->where('price <=', $max);
        }

        //Sorting
        $allowedSortColumns = ['price', 'name', 'created_at'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';
        
        $this->orderBy($sort, $order);
        
        $result = [
            'products' => $this->paginate($params->perPage ?? 5, 'products', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];
        return $result;
    }

    public function getFilteredProductsForPublic(DataParams $params)
    {
        $query = $this->getProductsWithCategoryAndImage();
        
        //Search
        if (!empty($params->search)) {
            $query->groupStart()
            ->like('products.name', $params->search, 'both', null, true)
            ->orLike('categories.name', $params->search, 'both', null, true)
            ->groupEnd();
        }

        //Filter
        if (!empty($params->category)) {
            $this->where('category_id', $params->category);
        }
        if (!empty($params->price)){
            [$min, $max] = explode('-', $params->price);
            $this->where('price >=', $min)->where('price <=', $max);
        }
        

        //Sorting
        $allowedSortColumns = ['price', 'name', 'created_at'];
        $sort = in_array($params->sort, $allowedSortColumns) ? $params->sort : 'id';
        $order = ($params->order === 'desc') ? 'desc' : 'asc';
        
        $this->orderBy($sort, $order);
        
        $result = [
            'products' => $this->paginate($params->perPage ?? 4, 'products', $params->page),
            'pager' => $this->pager,
            'total' => $this->countAllResults(false)
        ];
        return $result;
    }

    public function getAllCategories()
    {
        return $this->select('categories.id, categories.name')
                            ->join('categories', 'categories.id = products.category_id')
                            ->distinct()
                            ->findAll();
    }

    public function getRangePrice()
    {
        return [
            "0-20000",
            "20000-40000",
            "40000-60000",
            "60000-80000",
            "80000-100000",
        ];
    }    

}