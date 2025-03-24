<?php

namespace App\Controllers;

use App\Models\StudentGradeModel;
use App\Models\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment as Alignment;
use TCPDF;

class Dashboard extends BaseController
{
    protected $studentGradeModel;
    protected $studentModel;
    protected $enrollmentsData;
    // protected $studentsData;

    public function __construct()
    {
        $this->studentGradeModel = new StudentGradeModel();
        $this->studentModel = new StudentModel();
        $this->enrollmentsData = [
            (object)[
                'id' => 1,'student_id' => '181001', 'name' => 'Agus Setiawan',
                'study_program' => 'Teknik Informatika', 'current_semester' => 5,
                'course_code' => 'IF4101', 'course_name' => 'Pe mrograman Web', 'credits' => 3, 
                'course_semester' => 4, 'academic_year' => '2023/2024', 
                'enrollment_semester' => 'Ganjil', 'status' => 'Aktif'
            ],
            (object)[
                'id' => 2, 'student_id' => '181001', 'name' => 'Agus Setiawan',
                'study_program' => 'Teknik Informatika', 'current_semester' => 5,
                'course_code' => 'IF4102','course_name' => 'Basis Data Lanjut', 'credits' => 3,
                'course_semester' => 4, 'academic_year' => '2023/2024',
                'enrollment_semester' => 'Ganjil', 'status' => 'Aktif'
            ],
            (object)[
                'id' => 3, 'student_id' => '182002', 'name' => 'Budi Santoso',
                'study_program' => 'Sistem Informasi', 'current_semester' => 4,
                'course_code' => 'SI3201', 'course_name' => 'Analisis Sistem Informasi',
                'credits' => 4, 'course_semester' => 3, 'academic_year' => '2023/2024',
                'enrollment_semester' => 'Ganjil','status' => 'Aktif'
            ],
        ];
    }

    /* Admin Dashboard */
    public function adminDashboard()
    {
        $data = [
            'hideHeader'=>true
        ];
        
        return view('pages/dashboard/v_admin_dashboard', $data);
    }

    private function filterData($student_id = '', $name = '')
    {
        return $this->enrollmentsData;
    }

    public function enrollmentExcel()
    {
        $student_id = $this->request->getVar('student_id');
        $name = $this->request->getVar('name');
                
        $enrollments = $this->filterData($student_id, $name);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN ENROLLMENT MATA KULIAH');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Filter:');
        $sheet->setCellValue('B3', 'Student ID: ' . ($student_id ?? 'Semua'));
        $sheet->setCellValue('D3', 'Nama: ' . ($name ?? 'Semua'));
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);

        $headers = [
            'A5' => 'NO',
            'B5' => 'NIM',
            'C5' => 'NAMA MAHASISWA',
            'D5' => 'PROGRAM STUDI',
            'E5' => 'SEMESTER',
            'F5' => 'KODE MK',
            'G5' => 'NAMA MATA KULIAH',
            'H5' => 'SKS',
            'I5' => 'TAHUN AKADEMIK',
            'J5' => 'STATUS'
        ];
        
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        
        $row = 6;
        $no = 1;
        foreach ($enrollments as $enrollment) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $enrollment->student_id);
            $sheet->setCellValue('C' . $row, $enrollment->name);
            $sheet->setCellValue('D' . $row, $enrollment->study_program);
            $sheet->setCellValue('E' . $row, $enrollment->current_semester);
            $sheet->setCellValue('F' . $row, $enrollment->course_code);
            $sheet->setCellValue('G' . $row, $enrollment->course_name);
            $sheet->setCellValue('H' . $row, $enrollment->credits);
            $sheet->setCellValue('I' . $row, $enrollment->academic_year . ' - ' . $enrollment->enrollment_semester);
            $sheet->setCellValue('J' . $row, $enrollment->status);
                    
            $row++;
            $no++;
        }

        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        
        // Buat border untuk seluruh tabel
        $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        ];
        
        $sheet->getStyle('A5:J' . ($row - 1))->applyFromArray($styleArray);
        
        $filename = 'Laporan_Mata_Kuliah_Enrol_' . date('Y-m-d-His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    /* Report */
    public function studentsbyprogramForm()
    {
        $student_id = $this->request->getVar('student_id');
        $name = $this->request->getVar('name');
        
        $filteredData = $this->filterData($student_id, $name);

        $study_programs = $this->studentModel->getAllStudyProgram();
        $entry_years = $this->studentModel->getAllEntryYear();
                
        $data = [
            'title1' => 'Laporan Mahasiswa Per Program Studi',
            'title2' => 'Laporan Enrollment Mata Kuliah',
            'enrollments' => $filteredData,
            'filters' => [
                'student_id' => $student_id,
                'name' => $name
            ],
            'study_programs' => $study_programs,
            'entry_years' => $entry_years,
            'hideHeader' => true
        ];
                
        return view('pages/dashboard/v_admin_report', $data);
    }

    public function studentsbyprogramPdf()
    {
        $studentsData = $this->studentModel->findAll();

        $studyProgram = $this->request->getVar('study_program');
        $entryYear = $this->request->getVar('entry_year');
        
        // Filter data sesuai dengan input pengguna
        $filteredStudents = array_filter($studentsData, function($student) use ($studyProgram, $entryYear) {
            return (empty($studyProgram) || $student->study_program == $studyProgram) && (empty($entryYear) || $student->entry_year == $entryYear);
        });

        // Generate PDF
        $pdf = $this->initTcpdf();
        // $this->generatePdfContent($pdf, $filteredStudents, $studyProgram, $entryYear);
        $this->generatePdfHtmlContent($pdf, $filteredStudents, $studyProgram, $entryYear);

        // Output PDF
        $filename = 'laporan_mahasiswa_' . date('Y-m-d') . '.pdf';
        $pdf->Output($filename, 'I');
        exit;
    }

    private function initTcpdf()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        
        $pdf->SetCreator('CodeIgniter 4');
        $pdf->SetAuthor('Administrator');
        $pdf->SetTitle('Laporan Mahasiswa');
        $pdf->SetSubject('Laporan Data Mahasiswa');
        
        $pdf->SetHeaderData('', 0, 'UNIVERSITAS XYZ', '', [0, 0, 0], [0, 64, 128]);
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);
        
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 8]);
        
        $pdf->SetMargins(15, 20, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        
        $pdf->SetAutoPageBreak(true, 25);
        
        $pdf->SetFont('helvetica', '', 10);
        
        $pdf->AddPage();
        
        return $pdf;
    }

    public function generatePdfHtmlContent($pdf, $students, $studyProgram, $entryYear)
    {
        // Set title and filters info
        $title = 'LAPORAN DATA MAHASISWA';
        
        if (!empty($studyProgram)) {
            $title .= ' - PROGRAM STUDI: ' . $studyProgram;
        }
        
        if (!empty($entryYear)) {
            $title .= ' - TAHUN MASUK: ' . $entryYear;
        }

        $html = '<h2 style="text-align:center;">'. $title .'</h2>
        <table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
            <thead>
            <tr style="background-color:#CCCCCC; font-weight:bold; text-align:center;">
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Tahun Masuk</th>
                <th>IPK</th>
            </tr>
            </thead>
            <tbody>';
        
            $no = 1;
            foreach ($students as $student) {
            $html .= '
            <tr>
                <td style="text-align:center;">' . $no . '</td>
                <td>' . $student->student_id . '</td>
                <td>' . $student->name . '</td>
                <td>' . $student->study_program . '</td>
                <td style="text-align:center;">' . $student->current_semester . '</td>
                <td style="text-align:center;">' . $student->academic_status . '</td>
                <td style="text-align:center;">' . $student->entry_year . '</td>
                <td style="text-align:center; font-weight:bold;">' . $student->gpa . '</td>
            </tr>';
            $no++;
            }
            
        $html .= '
            </tbody>
            </table>
            
            <p style="margin-top:30px; text-align:left;">      
                <b> Total Mahasiswa: ' . count($students) . '</b> 
            </p>
    
            <p style="margin-top:30px; text-align:right;">    
                <i>Tanggal Cetak: ' . date('d-m-Y H:i:s') .  '</i><br> 
            </p>';
            $pdf->writeHTML($html, true, false, true, false, '');        
    }

    // private function generatePdfContent($pdf, $students, $studyProgram, $entryYear)
    // {
    //     $title = 'LAPORAN DATA MAHASISWA';
        
    //     if (!empty($studyProgram)) {
    //         $title .= ' - PROGRAM STUDI: ' . $studyProgram;
    //     }
        
    //     if (!empty($entryYear)) {
    //         $title .= ' - TAHUN MASUK: ' . $entryYear;
    //     }
        
    //     $pdf->SetFont('helvetica', 'B', 14);
    //     $pdf->Cell(0, 10, $title, 0, 1, 'C');
    //     $pdf->Ln(5);
        
    //     $pdf->SetFont('helvetica', 'I', 8);
    //     $pdf->Cell(0, 5, 'Tanggal Cetak: ' . date('d-m-Y H:i:s'), 0, 1, 'R');
    //     $pdf->Ln(5);
        
    //     $pdf->SetFont('helvetica', 'B', 9);
    //     $pdf->SetFillColor(220, 220, 220);
        
    //     $pdf->Cell(10, 7, 'No', 1, 0, 'C', 1);
    //     $pdf->Cell(30, 7, 'NIM', 1, 0, 'C', 1);
    //     $pdf->Cell(60, 7, 'Nama Mahasiswa', 1, 0, 'C', 1);
    //     $pdf->Cell(50, 7, 'Program Studi', 1, 0, 'C', 1);
    //     $pdf->Cell(20, 7, 'Semester', 1, 0, 'C', 1);
    //     $pdf->Cell(30, 7, 'Status', 1, 0, 'C', 1);
    //     $pdf->Cell(25, 7, 'Tahun Masuk', 1, 0, 'C', 1);
    //     $pdf->Cell(15, 7, 'IPK', 1, 1, 'C', 1);

    //     // Table content
    //     $pdf->SetFont('helvetica', '', 9);
    //     $pdf->SetFillColor(255, 255, 255);
        
    //     $no = 1;
    //     foreach ($students as $student) {
    //         $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    //         $pdf->Cell(30, 6, $student->student_id, 1, 0, 'C');
    //         $pdf->Cell(60, 6, $student->name, 1, 0, 'L');
    //         $pdf->Cell(50, 6, $student->study_program, 1, 0, 'L');
    //         $pdf->Cell(20, 6, $student->current_semester, 1, 0, 'C');
    //         $pdf->Cell(30, 6, $student->academic_status, 1, 0, 'C');
    //         $pdf->Cell(25, 6, $student->entry_year, 1, 0, 'C');
    //         $pdf->Cell(15, 6, $student->gpa, 1, 1, 'C');
    //     }
        
    //     // Summary
    //     $pdf->Ln(5);
    //     $pdf->SetFont('helvetica', 'B', 10);
    //     $pdf->Cell(0, 7, 'Total Mahasiswa: ' . count($students), 0, 1, 'L');
    // }




    /* Lecturer Dashboard */
    public function lecturerDashboard()
    {
        return view('pages/dashboard/v_lecturer_dashboard', ['hideHeader'=>true]);
    }

    
    /* Student Dashboard */
    public function studentDashboard()
    {
        $creditsByGrade = $this->getCreditsByGrade();
        $creditComparison = $this->getCreditComparison();
        $gpaData = $this->getGpaPerSemester();
        
        return view('pages/dashboard/v_student_dashboard', [   
            'hideHeader'=>true,        
            'creditsByGrade' => json_encode($creditsByGrade),
            'creditComparison' => json_encode($creditComparison),
            'gpaData' => json_encode($gpaData),
        
        ]);
    }

    private function getCreditsByGrade()
    {  
        $currentUser = $this->studentModel->where('user_id', user()->id)->first();
        $getStudentGradeData = $this->studentGradeModel->getStudentGradesData()->where('enrollments.student_id', $currentUser->id)->findAll();
        $creditTotal = array_sum(array_column($getStudentGradeData, 'credits'));

        $dummyGradeCredits = [
            ['grade_letter' => 'A', 'credits' => 45],
            ['grade_letter' => 'B+', 'credits' => 20],
            ['grade_letter' => 'B', 'credits' => 32],
            ['grade_letter' => 'C', 'credits' => 8],
            ['grade_letter' => 'C', 'credits' => 18],
            ['grade_letter' => 'D', 'credits' => 6]
        ];
    
        $backgroundColors = [
            'A' => 'rgb(54, 162, 235)',    // Biru untuk A
            'B+' => 'rgb(75, 192, 192)',    // Cyan untuk B+
            'B' =>'rgb(153, 102, 255)',   // Ungu untuk B
            'C+' =>'rgb(255, 205, 86)',    // Kuning untuk C+
            'C' =>'rgb(255, 159, 64)',    // Oranye untuk C
            'D' =>'rgb(255, 99, 132)'     // Merah untuk D
        ];

        foreach ($dummyGradeCredits as $row) {
            $gradeLabels[] = $row['grade_letter'] . ' = '. $row['credits'] . ' Credits';
            $creditCounts[] = (int)$row['credits'];
            $colors[] = $backgroundColors[$row['grade_letter']];
        }
        
        return [
            'labels' => $gradeLabels,
            'datasets' => [
                [
                    'label' => 'Credits by Grade',
                    'data' => $creditCounts,
                    'backgroundColor' => $colors,
                    'hoverOffset' => 4
                ]
            ]
        ];
    }

    private function getCreditComparison()
    {
        $dummyCredits = [
            ['semester' => 1, 'credits_taken' => 20, 'credits_required' => 20],
            ['semester' => 2, 'credits_taken' => 19, 'credits_required' => 22],
            ['semester' => 3, 'credits_taken' => 22, 'credits_required' => 24],
            ['semester' => 4, 'credits_taken' => 20, 'credits_required' => 22],
            ['semester' => 5, 'credits_taken' => 18, 'credits_required' => 20],
            ['semester' => 6, 'credits_taken' => 16, 'credits_required' => 18]
        ];

        foreach ($dummyCredits as $row) {
            $labels[] = 'Semester ' . $row['semester'];
            $creditsTaken[] = (int)$row['credits_taken'];
            $creditsRequired[] = (int)$row['credits_required'];
        }
    
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Credits Taken',
                    'data' => $creditsTaken,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Credits Required',
                    'data' => $creditsRequired,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    private function getGpaPerSemester()
    {
        $dummyGpaData = [
            ['semester' => 1, 'semester_gpa' => 3.45],
            ['semester' => 2, 'semester_gpa' => 2.52],
            ['semester' => 3, 'semester_gpa' => 3.21],
            ['semester' => 4, 'semester_gpa' => 2.68],
            ['semester' => 5, 'semester_gpa' => 3.75],
            ['semester' => 6, 'semester_gpa' => 2.82],
            ['semester' => 7, 'semester_gpa' => 3.41],
            ['semester' => 8, 'semester_gpa' => 2.95],
        ];
        foreach ($dummyGpaData as $row) {
            $semesters[] = 'Semester ' . $row['semester'];
            $gpaData[] = round($row['semester_gpa'], 2);
        }
        
        return [
            'labels' => $semesters,
            'datasets' => [
                [
                    'label' => 'GPA',
                    'data' => $gpaData,
                    'borderColor'=> 'rgba(75, 192, 192, 1)',
                    'tension'=> 0.1,                  
                    'fill' => false
                ]
            ]
        ];
    }

}

?>