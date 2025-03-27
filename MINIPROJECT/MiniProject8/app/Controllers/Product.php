<?php

namespace App\Controllers;

use App\Libraries\DataParams;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use Codeigniter\files\File;
use Myth\Auth\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $productImageModel;
    protected $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productImageModel = new ProductImageModel();
        $this->userModel = new UserModel();
    }

    /* Public */
    public function index()
    {
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_products'),
            'perPage' => $this->request->getGet('perPage'),
            'category' => $this->request->getGet('category'),
            'price' => $this->request->getGet('price'),
        ]);

        $results = $this->productModel->getFilteredProductsForPublic($params);

        $data = [
            'page_title' => 'Product List',
            'products' => $results['products'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'category' => $this->productModel->getAllCategories(),
            'price' => $this->productModel->getRangePrice(),
            'baseUrl' => base_url('/'),
        ];
        
        return view('pages/public/product/v_index', $data);
    }

    public function productDetailForUser($id)
    {
        $product = $this->productModel->getProductsWithCategoryAndImage()->find($id);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'page_title' => 'Product Detail',
            'product' => $product,
        ];
        return view('pages/public/product/v_product_detail', $data);
    }


    /* Admin */
    public function indexAdmin()
    {
        $params = new DataParams([
            'search' => $this->request->getGet('search'),
            'sort' => $this->request->getGet('sort'),
            'order' => $this->request->getGet('order'),
            'page' => $this->request->getGet('page_products'),
            'perPage' => $this->request->getGet('perPage'),
            'category' => $this->request->getGet('category'),
            'price' => $this->request->getGet('price'),
        ]);

        $results = $this->productModel->getFilteredProducts($params);

        $data = [
            'page_title' => 'Product List',
            'products' => $results['products'],
            'pager' => $results['pager'],
            'total' => $results['total'],
            'params' => $params,
            'category' => $this->productModel->getAllCategories(),
            'price' => $this->productModel->getRangePrice(),
            'baseUrl' => base_url('product'),
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_index', $data);
    }

    public function create()
    {
        $categoryList = array_map(fn($category) => $category->toArray(), $this->categoryModel->findAll());

        $data = [
            'page_title' => 'Create Product',
            'categoryList' => $categoryList,
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_create', $data);
    }

    public function store()
    {
        $productData = $this->request->getPost();

        $productData['status'] = 'Active';
        $productData['is_new'] = true;
        $productData['is_sale'] = true;

        $product = new \App\Entities\Product($productData);

        $rules = $this->productModel->getValidationRules();
        $messages = $this->productModel->getValidationMessages();
        
        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan produk dan dapatkan ID
        $productId = $this->productModel->insert($product, true);

        $file = $this->request->getFile('image');
        
        if($file && $file->isValid()){
            $validationRules = [
                'image' => [
                    'label' => 'Image',
                    'rules' => [
                        'uploaded[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/png,image/webp]',
                        'max_size[image,5120]',
                    ],
                    'errors' => [
                        'uploaded' => 'Product image is required',
                        'mime_in' => 'File must be in .jpg, .jpeg, .png, .webP format',
                        'max_size' => 'File size must be less than 5MB',
                    ]
                ]
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            if (!$file->hasMoved()) {
                $newName = $file->getRandomName();
                $this->createImageVersions($file, $productId, $newName);

                // Simpan path gambar ke database
                $this->productImageModel->save([
                    'product_id' => $productId,
                    'image_path' => $newName,
                    'is_primary' => true,
                    'created_at'  => date('Y-m-d H:i:s')
                ]);
            }
        }

        $email = service('email');

        $users = $this->userModel->getAllUserWithUserAccount()->whereIn('role', ['administrator', 'product_manager'])->findAll();
        $userEmails = array_map(fn($user) => $user->email, $users);

        $email->setTo($userEmails);
        $email->setSubject('New Product Added');
        $email->setCC($userEmails);

        $categoryId = $productData['category_id'] ?? null;

        if ($categoryId) {
            $category = $this->categoryModel->find($categoryId);
            $categoryName = $category ? $category->name : 'Unknown';
        } else {
            $categoryName = 'Unknown';
        }

        $imagePath = base_url("productImage/$productId/$newName");
        $productLink = base_url("product-detail/$productId");

        $data = [
            'title' => 'New Product Added',
            'name'  => 'Product Manager',
            'content' => 'New product has been added.',
            'features' => [
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'category' => $categoryName,
                'link' => $productLink
            ]
        ];

        $attachments = [
            WRITEPATH . "uploads/products/thumbnail/$productId/$newName"
        ];

        foreach ($attachments as $attachment) {
            if(file_exists($attachment)) {
                $email->attach($attachment);
            }
        }

        $email->setMessage(view('email/v_email_template', $data));

        if(!$email->send()) {
            return redirect()->to(base_url('product'))->with('message', 'Product Added Successfully. Email failed to send.');
        }
    
        return redirect()->to(base_url('product'))->with('message', 'Product Added Successfully. Email sent.');
    }

    private function createImageVersions($file, $productId, $newName)
    {
        // Buat folder jika belum ada
        $paths = [
            'original'  => WRITEPATH . "uploads/products/original/$productId/",
            'thumbnail' => WRITEPATH . "uploads/products/thumbnail/$productId/",
            'medium'    => WRITEPATH . "uploads/products/medium/$productId/",
        ];

        foreach ($paths as $path) {
            if (!is_dir($path)) mkdir($path, 0777, true);
        }

        // Path lengkap file
        $originalFile  = $paths['original'] . $newName;
        $thumbnailFile = $paths['thumbnail'] . $newName;
        $mediumFile    = $paths['medium'] . $newName;

        $image = \Config\Services::image();

        // Simpan original dengan watermark
        $image->withFile($file->getTempName())
                ->resize(1000, 1000, true, 'width')
                ->text('My Watermark', [
                    'color'      => '#ffffff',
                    'opacity'    => 0.8,
                    'withShadow' => true,
                    'hAlign'     => 'center',
                    'vAlign'     => 'buttom',
                    'fontSize'   => 50
                ])
                ->save($originalFile, 80);
    
        // Buat medium dengan watermark
        $image->withFile($originalFile)
                ->resize(500, 500, true, 'width')
                ->text('My Watermark', [
                    'color'      => '#ffffff',
                    'opacity'    => 0.8,
                    'withShadow' => true,
                    'hAlign'     => 'center',
                    'vAlign'     => 'buttom',
                    'fontSize'   => 50
                ])
                ->save($mediumFile, 80);

        // Buat thumbnail tanpa watermark
        $image->withFile($originalFile)
                ->resize(150, 150, true, 'width')
                ->save($thumbnailFile, 80);
    }

    public function productImage($id, $filename)
    {
        $filePath = WRITEPATH . "uploads/products/thumbnail/" . $id . "/" . $filename;
        if (file_exists($filePath)) {
            return $this->response->setContentType(mime_content_type($filePath))->setBody(file_get_contents($filePath));
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    public function show($id)
    {
        $product = $this->productModel->getProductsWithCategoryAndImage()->find($id);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'page_title' => 'Product Detail',
            'product' => $product,
            'hideHeader' => true
        ];
        return view('pages/admin/product/v_detail', $data);
    }

    public function edit($id)
    {
        $product = $this->productModel->getProductsWithCategoryAndImage()->find($id);
        if ($product == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $categoryList = array_map(fn($category) => $category->toArray(), $this->categoryModel->findAll());
        
        $data = [
            'page_title' => 'Edit Product',
            'product' => $product,
            'categoryList' => $categoryList,
            'hideHeader' => true
        ];
        
        return view('pages/admin/product/v_edit', $data);
    }

    public function update($id)
    {
        $product = new \App\Entities\Product($this->request->getPost());
        
        $rules = $this->productModel->getValidationRules();
        $messages = $this->productModel->getValidationMessages();
        
        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->update($id, $product);
        
        return redirect()->to(base_url('product'))->with('message', 'Product Updated Successfully.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $this->productModel->delete($id);
        return redirect()->to(base_url('product'))->with('message', 'Product Deleted Successfully.');
    }

    /* Export Excel */
    public function exportProductExcel()
    {
        $category = $this->request->getPost('category');

        $results = $this->productModel->exportProductExcel($category);
        // dd($results);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN PRODUK');
        $sheet->mergeCells('A1:g1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Category: ' . ($category ? $this->categoryModel->find($category)->name : 'All Category'));
        $sheet->mergeCells('A3:D3');
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);

        $headers = [
            'A5' => 'NO',
            'B5' => 'PRODUCT ID',
            'C5' => 'PRODUCT NAME',
            'D5' => 'CATEGORY',
            'E5' => 'PRICE',
            'F5' => 'STOCK',
            'G5' => 'DATE ADDED',
        ];
        
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        
        $row = 6;
        $no = 1;
        foreach ($results as $result) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $result->id);
            $sheet->setCellValue('C' . $row, $result->name);
            $sheet->setCellValue('D' . $row, $result->category_name);
            $sheet->setCellValue('E' . $row, $result->price);
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('"Rp." #,##0');
            $sheet->setCellValue('F' . $row, $result->stock);
            $sheet->setCellValue('G' . $row, $result->created_at);
            $row++;
            $no++;
        }

        foreach ($headers as $cell => $value) {
            $sheet->getColumnDimension(substr($cell, 0, 1))->setAutoSize(true);
        }
        
        // Buat border untuk seluruh tabel
        $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        ];
        
        $sheet->getStyle('A5:G' . ($row - 1))->applyFromArray($styleArray);
        
        $filename = 'Product_List_Report_' . date('Y-m-d-His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}