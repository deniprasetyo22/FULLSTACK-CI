<?php

namespace App\Controllers\Mahasiswa;

use App\Entities\Mahasiswa as EntitiesMahasiswa;
use App\Models\M_Mahasiswa;
use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{
    private $mahasiswaModel;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->mahasiswaModel = new M_Mahasiswa();
        helper(['form', 'url', 'text', 'date']); //helper
    }

    public function index()
    {
        //url_helper
        $previousUrl = previous_url();
        $currentUrl = current_url();
        $data['students'] = $this->mahasiswaModel->getAllStudents();
        return view('mahasiswa/index', $data);
    }

    public function detail($nim)
    {
        $student = $this->mahasiswaModel->getStudentByNIM($nim);

        if (!$student) {
            return redirect()->to('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan.');
        }
        
        $data['student'] = $student;
        return view('mahasiswa/detail', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'jurusan' => $this->request->getPost('jurusan')
        ];
    
        $rules = [
            'nim' => 'required|integer',
            'nama' => 'required|max_length[10]',
            'jurusan' => 'required|max_length[10]',
        ];
    
        if (!$this->validateData($data, $rules)) {
            return view('mahasiswa/create', [
                'errors' => $this->validator->getErrors()
            ]);
        } else {
            $mahasiswa = new EntitiesMahasiswa($this->request->getPost());
            $this->mahasiswaModel->addStudent($mahasiswa);
            $data['students'] = $this->mahasiswaModel->getAllStudents();
        }
    
       // return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
        return view('mahasiswa/index', $data);
    }

    

    public function update($nim)
    {
        $student = $this->mahasiswaModel->getStudentByNIM($nim);

        if(!$student){
            return redirect()->to('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $data['student'] = $student;
        return view('mahasiswa/update', $data);
    }

    public function saveUpdate()
    {
        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $jurusan = $this->request->getPost('jurusan');

        $mahasiswa = new EntitiesMahasiswa($nim, $nama, $jurusan);
        $this->mahasiswaModel->updateStudent($mahasiswa);

        // return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui.');

        $data['students'] = $this->mahasiswaModel->getAllStudents();
        return view('mahasiswa/index', $data);
    }

    public function delete($nim)
    {
        if ($this->mahasiswaModel->deleteStudent($nim)) {
            // return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
            $data['students'] = $this->mahasiswaModel->getAllStudents();
            return view('mahasiswa/index', $data);
        }
        return redirect()->to('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan.');
        
    }

    /* Controller Untuk Routing Menggunakan Match */
    public function feature()
    {
        $type = $this->request->getMethod();
        if($type == 'GET')
        {
            return view('mahasiswa/create');
        }else if($type == 'POST')
        {
            // $nim = $this->request->getPost('nim');
            // $nama = $this->request->getPost('nama');
            // $jurusan = $this->request->getPost('jurusan');

            // $mahasiswa = new EntitiesMahasiswa($nim, $nama, $jurusan);
            // $this->mahasiswaModel->addStudent($mahasiswa);

            // // return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
            // $data['students'] = $this->mahasiswaModel->getAllStudents();
            // return view('mahasiswa/index', $data);
            $data = [
                'nim' => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
                'jurusan' => $this->request->getPost('jurusan')
            ];
        
            $rules = [
                'nim' => 'required|integer',
                'nama' => 'required|max_length[255]',
                'jurusan' => 'required|max_length[255]',
            ];
        
            if (!$this->validateData($data, $rules)) {
                return view('mahasiswa/create', [
                    'errors' => $this->validator->getErrors(),
                ]);    
            } else {
                $mahasiswa = new EntitiesMahasiswa($this->request->getPost());
                $this->mahasiswaModel->addStudent($mahasiswa);
                $data['students'] = $this->mahasiswaModel->getAllStudents();
            }
        
           // return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
            return view('mahasiswa/index', $data);
        }
    }

    public function show($year, $category)
    {
        echo "Berita tahun $year dan kategori $category";
    }

    public function profile($username)
    {
        echo "Menampilkan profile user $username";
    }

    public function products($slug)
    {
        echo "Detail Produk : $slug";
    }

    public function article($slug)
    {
        echo "Artikel : $slug";
    }

    public function price()
    {
        helper("product_helper");
        echo format_price(1000000);
    }
}

?>