<?php 
namespace App\Models;

use App\Entities\Mahasiswa;

class M_Mahasiswa{
    private $students = [];

    public function __construct()
    {
        $this->students = [
            new Mahasiswa('101', 'John Doe', 'Computer Science'),
            new Mahasiswa('102', 'Jane Smith', 'Information Systems'),
            new Mahasiswa('103', 'Michael Johnson', 'Software Engineering')
        ];
    }

    public function getAllStudents()
    {
        return $this->students;
    }

    public function getStudentByNIM($nim)
    {
        foreach($this->students as $student){
            if($student->getNIM() == $nim){
                return $student;
            }
        }
        return null;
    }

    public function addStudent(Mahasiswa $mahasiswa)
    {
        $this->students[] = $mahasiswa;
    }

    public function updateStudent(Mahasiswa $mahasiswa)
    {
        foreach($this->students as $key => $student){
            if($student->getNIM() == $mahasiswa->getNIM()){
                $this->students[$key] = $mahasiswa;
                return true;
            }
        }
        return false;
    }

    public function deleteStudent($nim)
    {
        foreach($this->students as $key => $student){
            if($student->getNIM() == $nim){
                unset($this->students[$key]);
                $this->students = array_values($this->students); // Reset array keys
                return true;
            }
        }
        return false;
    }
}
?>