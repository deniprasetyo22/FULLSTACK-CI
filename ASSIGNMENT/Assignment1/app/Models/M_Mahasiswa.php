<?php 
namespace App\Models;

use App\Entities\Mahasiswa;

class M_Mahasiswa{
    private $students = [];

    public function __construct()
    {
        $this->students[] = new Mahasiswa('101', 'John Doe', 'Computer Science');
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
                return true;
            }
        }
        return false;
    }
}
?>