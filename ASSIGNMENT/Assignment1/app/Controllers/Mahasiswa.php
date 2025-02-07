<?php

namespace App\Controllers;

use App\Entities\Mahasiswa as EntitiesMahasiswa;
use App\Models\M_Mahasiswa;

class Mahasiswa extends BaseController
{
    private $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new M_Mahasiswa();
    }

    public function index()
    {
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
        $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $jurusan = $this->request->getPost('jurusan');

        $mahasiswa = new EntitiesMahasiswa($nim, $nama, $jurusan);
        $this->mahasiswaModel->addStudent($mahasiswa);

        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
        // $data['students'] = $this->mahasiswaModel->getAllStudents();
        // return view('mahasiswa/index', $data);
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

        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui.');

        // $data['students'] = $this->mahasiswaModel->getAllStudents();
        // return view('mahasiswa/index', $data);
    }

    public function delete($nim)
    {
        if ($this->mahasiswaModel->deleteStudent($nim)) {
            return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
        }
        return redirect()->to('/mahasiswa')->with('error', 'Mahasiswa tidak ditemukan.');

        // $data['students'] = $this->mahasiswaModel->getAllStudents();
        // return view('mahasiswa/index', $data);
    }
}

?>