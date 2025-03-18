<?php 

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Files\File;
use Myth\Auth\Controllers\AuthController as MythAuthController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Auth extends MythAuthController
{
    protected $auth;
    protected $config;
    protected $userModel;
    protected $groupModel;
    protected $studentModel;
    
    public function __construct()
    {
        parent::__construct();

        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->studentModel = new StudentModel();

        $this->auth = service('authentication');
    }

    public function login()
    {
        // Custom logic login
        return parent::login(); 
    }

    public function attemptLogin()
    {
        // Custom validation atau logic tambahan
        $result = parent::attemptLogin();
        return $this->redirectBasedOnRole();
    }

    private function redirectBasedOnRole()
    {
        $userId = user_id();

        if(!$userId){
            return redirect()->to('login');
        }
            
        $userGroups = $this->groupModel->getGroupsForUser($userId);
            
        foreach ($userGroups as $group) {
            if ($group['name'] === 'admin') {
                return redirect()->to('admin/dashboard');
            } else if ($group['name'] === 'lecturer') {
                return redirect()->to('lecturer/dashboard');
            } else if ($group['name'] === 'student') {
                return redirect()->to('student/dashboard');
            }
        }
    
        return redirect()->to('/');
    }

    public function attemptRegister()
    {
        // Jalankan registrasi bawaan
        $result = parent::attemptRegister();
        
        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {           
             // Tambahkan ke group student
            $studentGroup = $this->groupModel->where('name', 'student')->first();
            if ($studentGroup) {
                $this->groupModel->addUserToGroup($user->id, $studentGroup->id);
            }

            // Simpan data student
            $studentData = [
                'student_id'      => random_int(100000, 999999),
                'name'            => 'Update Your Name',
                'study_program'   => 'Update Your Program Study',
                'current_semester'=> 1,
                'academic_status' => 'Active',
                'entry_year'      => date('Y'),
                'gpa'             => 0.00,
                'user_id'         => $user->id
            ];
    
            // Simpan data student
            $this->studentModel->insert($studentData);

        }


        return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));



        // // Check if registration is allowed
        // if (! $this->config->allowRegistration) {
        //     return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
        // }

        // $users = model(UserModel::class);

        // // Validate basics first since some password rules rely on these fields
        // $rules = config('Validation')->registrationRules ?? [
        //     'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
        //     'email'    => 'required|valid_email|is_unique[users.email]',
        // ];

        // if (! $this->validate($rules)) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // // Validate passwords since they can only be validated properly here
        // $rules = [
        //     'password'     => 'required|strong_password',
        //     'pass_confirm' => 'required|matches[password]',
        // ];

        // if (! $this->validate($rules)) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // // Save the user
        // $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        // $user              = new UserModel($this->request->getPost($allowedPostFields));

        // $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // if (! $users->save($user)) {
        //     return redirect()->back()->withInput()->with('errors', $users->errors());
        // }

        // // Tambahkan user ke grup student jika registrasi sukses
        // $studentGroup = $this->groupModel->where('name', 'student')->first();
        // if ($studentGroup) {
        //     $this->groupModel->addUserToGroup($users->insertID(), $studentGroup->id);
        // }

        // if ($this->config->requireActivation !== null) {
        //     $activator = service('activator');
        //     $sent      = $activator->send($user);

        //     if (! $sent) {
        //         return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        //     }

        //     // Success!
        //     return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
        // }

        // // Success!
        // return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
    }

    public function sendEmail()
    {
        $email = service('email');

        /* Single recipient */
        // $email->setTo('deni123@yopmail.com');

        /* Multi recipient */
        $email->setTo('deni123@yopmail.com', 'deni12345@yopmail.com');
        $ccList = [
            'deni123@yopmail.com',
            'deni12345@yopmail.com'
        ];
        $email->setCC($ccList);

        $email->setSubject('Email Test Dengan Template HTML');

        $data = [
            'title' => 'Pemberitahuan Penting',
            'name' => 'John Doe',
            'content' => 'Ini adalah isi email yang akan dikirimkan.',
            'features' => [
                'Fitur 1: Informasi penting',
                'Fitur 2: Detail produk',
                'Fitur 3: Cara penggunaan'
            ]
        ];

        $message = view('email/v_email_template', $data); // Isi konten email
        $email->setMessage($message);
        
        // Path file di server - pastikan path yang benar
        $filePath = ROOTPATH . 'public/uploads/dokumen.pdf';
        $excelPath = ROOTPATH . 'public/uploads/laporan.xlsx';
        $imagePath = ROOTPATH . 'public/uploads/gambar.jpeg';
        
        // Tambahkan attachment (bisa lebih dari satu)
        if (file_exists($filePath)) {
            $email->attach($filePath);
        }
        
        if (file_exists($excelPath)) {
            $email->attach($excelPath);
        }
        
        if (file_exists($imagePath)) {
            $email->attach($imagePath);
        }

        if ($email->send()) {
            return redirect()->to('/email')->with('success', 'Email berhasil dikirim');
        } else {           
            $data = ['error' => $email->printDebugger()];
            return view('email_form', $data);
        }
    }

    public function uploadForm()
    {
        return view('v_test_upload_file', ['errors' => []]);
    }

    public function upload()
    {
        $validationRule = [
            /* Document */
            /* 'userfile' => [
                'label' => 'Dokumen',
                'rules' => [
                    'uploaded[userfile]',
                    'mime_in[userfile,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'max_size[userfile,5120]', // 5MB dalam KB (5 * 1024)
                ],
                'errors' => [
                    'uploaded' => 'Silakan pilih file untuk diunggah',
                    'mime_in' => 'File harus berformat PDF, DOC, atau DOCX',
                    'max_size' => 'Ukuran file tidak boleh melebihi 5MB'
                ]
            ] */

            /* Images */
            'userfile' => [
                'label' => 'Gambar',
                'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/png,image/gif]',
                        'max_size[userfile,5120]', // 5MB dalam KB (5 * 1024)
                        'max_dims[userfile,1024,1024]',
                ],
                'errors' => [
                    'uploaded' => 'Silakan pilih file gambar untuk diunggah',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in'  => 'File harus berformat JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh melebihi 5MB',
                    'max_dims' => 'Ukuran gambar tidak boleh melebihi 1024x1024'
                ]
            ]
        ];

        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('v_test_upload_file', $data);
        }

        $userFile = $this->request->getFile('userfile');

        if (! $userFile->hasMoved()) {
            // $newName = $img->getName();
            $newName = $userFile->getRandomName();
            // $img->move(WRITEPATH . 'uploads', $newName);
            // $filepath= WRITEPATH . 'uploads/' . $newName;

            $userFile->move(WRITEPATH . 'uploads/original', $newName);
            $filepath = WRITEPATH . 'uploads/original/' . $newName;
            $this->createImageVersions($filepath, $newName);

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return view('v_success_page', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];

        return view('v_test_upload_file', $data);
    }

    private function createImageVersions($filePath, $fileName)
    {
        $image = service('image');
            
        $image->withFile($filePath)
                ->fit(100, 100, 'center')
                ->save(WRITEPATH . 'uploads/thumbnail/' . $fileName);
            
        $image->withFile($filePath)
                ->fit(300, 300, 'center')
                ->save(WRITEPATH . 'uploads/medium/' . $fileName);
                    
        // Jika ingin menggunakan resize (mempertahankan ratio) daripada fit:
        $image->withFile($filePath)
                ->resize(300, 300, true, 'height')
                ->save(WRITEPATH . 'uploads/medium/' . $fileName);    

        $image->withFile($filePath)
                ->text('Copyright 2025 My Photo Co', [
                    'color'      => '#fff',
                    'opacity'    => 0.5,
                    'withShadow' => true,
                    'hAlign'     => 'center',
                    'vAlign'     => 'bottom',
                    'fontSize'   => 20,
                ])
                ->save(WRITEPATH . 'uploads/medium/' . $fileName);
    }

}

?>