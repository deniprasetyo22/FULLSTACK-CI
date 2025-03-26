<?php

namespace App\Controllers;

use App\Libraries\DataParams;
use App\Models\EnrollmentModel;
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
    protected $enrollmentModel;

    public function __construct()
    {
        $this->studentGradeModel = new StudentGradeModel();
        $this->studentModel = new StudentModel();
        $this->enrollmentModel = new EnrollmentModel();
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

    /* Report */
    public function adminReport()
    {
        $search = $this->request->getGet('keyword');

        $params = new DataParams([
            'search' => $search,
        ]);

        $filteredData = $this->studentModel->getFilteredStudents($params);

        $study_programs = $this->studentModel->getAllStudyProgram();
        $entry_years = $this->studentModel->getAllEntryYear();

        $data = [
            'title1' => 'Laporan Mahasiswa Per Program Studi',
            'title2' => 'Laporan Enrollment Mata Kuliah',
            'enrollments' => $filteredData,
            'filters' => [
                'keyword' => $search,
            ],
            'study_programs' => $study_programs,
            'entry_years' => $entry_years,
            'hideHeader' => true
        ];
                
        return view('pages/dashboard/v_admin_report', $data);
    }

    public function enrollmentExcel()
    {
        $search = $this->request->getGet('keyword');

        $params = new DataParams([
            'search' => $search,
        ]);

        $enrollments = $this->studentModel->getFilteredStudents($params);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN ENROLLMENT MATA KULIAH');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $firstEnrollment = $enrollments[0] ?? null;
        $sheet->setCellValue('A3', 'Filter:');
        $sheet->setCellValue('B3', 'Student ID: ' . ($firstEnrollment ? $firstEnrollment->student_id : 'Semua'));
        $sheet->setCellValue('D3', 'Nama: ' . ($firstEnrollment ? $firstEnrollment->name : 'Semua'));
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
            $sheet->setCellValue('I' . $row, $enrollment->academic_year);
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
        
        $logoPath = 'test.jpg';
        $pdf->SetHeaderData($logoPath, 30, 'UNIVERSITAS XYZ', '', [0, 0, 0], [0, 64, 128]);
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
        $currentUser = $this->studentModel->where('user_id', user()->id)->first();
        $studentId = $currentUser->id;

        $creditDistributionByGrade = $this->creditDistributionByGrade($studentId);
        $creditComparison = $this->getCreditComparison($studentId);
        $gpaProgressPerSemester = $this->gpaProgressPerSemester($studentId);
        
        return view('pages/dashboard/v_student_dashboard', [   
            'hideHeader'=>true,        
            'creditDistributionByGrade' => json_encode($creditDistributionByGrade),
            'creditComparison' => json_encode($creditComparison),
            'gpaProgressPerSemester' => json_encode($gpaProgressPerSemester),
        
        ]);
    }

    private function creditDistributionByGrade($studentId)
    {  
        $grades = $this->studentGradeModel->getCreditDistrubutionByGrade($studentId);

        // Daftar warna untuk setiap grade
        $backgroundColors = [
            'A'  => 'rgb(54, 162, 235)',   // Biru
            'A-' => 'rgb(100, 200, 150)',  // Hijau Muda
            'B+' => 'rgb(75, 192, 192)',   // Cyan
            'B'  => 'rgb(153, 102, 255)',  // Ungu
            'B-' => 'rgb(120, 80, 200)',   // Ungu Gelap
            'C+' => 'rgb(255, 205, 86)',   // Kuning
            'C'  => 'rgb(255, 159, 64)',   // Oranye
            'D'  => 'rgb(255, 99, 132)',   // Merah
            'E'  => 'rgb(180, 60, 60)',    // Merah Gelap
        ];

        $gradeLabels = [];
        $creditCounts = [];
        $colors = [];

        foreach ($grades as $grade) {
            $gradeLetter = $grade['grade_letter'];
            $totalCredits = (int) $grade['total_credits'];

            $gradeLabels[] = $gradeLetter . ' = ' . $totalCredits . ' Credits';
            $creditCounts[] = $totalCredits;
            $colors[] = $backgroundColors[$gradeLetter] ?? 'rgb(200, 200, 200)'; // Default abu-abu jika tidak ada di daftar
        }

        return [
            'labels' => $gradeLabels,
            'datasets' => [
                [
                    'label' => 'Credits By Grade',
                    'data' => $creditCounts,
                    'backgroundColor' => $colors,
                    'hoverOffset' => 4
                ]
            ]
        ];
    }

    private function getCreditComparison($studentId)
    {
        $credits = $this->enrollmentModel->getCreditsTaken($studentId);
        // dd($credits);
        
        $creditsTakenMap = [];
        foreach ($credits as $credit) {
            $creditsTakenMap[$credit['semester']] = (int)$credit['credits'];
        }

        $dummyCredits = [
            ['semester' => 1, 'credits_required' => 20],
            ['semester' => 2, 'credits_required' => 22],
            ['semester' => 3, 'credits_required' => 24],
            ['semester' => 4, 'credits_required' => 22],
            ['semester' => 5, 'credits_required' => 20],
            ['semester' => 6, 'credits_required' => 18],
            ['semester' => 7, 'credits_required' => 18],
            ['semester' => 8, 'credits_required' => 18]
        ];

        $labels = [];
        $creditsTaken = [];
        $creditsRequired = [];

        foreach ($dummyCredits as $row) {
            $semester = $row['semester'];
            $labels[] = 'Semester ' . $semester;
            $creditsTaken[] = $creditsTakenMap[$semester] ?? 0;
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

    private function gpaProgressPerSemester($studentId)
    {
        $gpaProgress = $this->enrollmentModel->getGpaProgressPerSemester($studentId);

        $semesters = [];
        $gpaData = [];
        foreach ($gpaProgress as $row) {
            $semesters[] = 'Semester ' . $row['semester'];
            $gpaData[] = $row['gpa'];
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