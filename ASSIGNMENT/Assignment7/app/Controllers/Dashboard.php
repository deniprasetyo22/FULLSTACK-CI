<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function adminDashboard()
    {
        return view('pages/dashboard/v_admin_dashboard', ['hideHeader'=>true]);
    }

    public function lecturerDashboard()
    {
        return view('pages/dashboard/v_lecturer_dashboard', ['hideHeader'=>true]);
    }

    public function studentDashboard()
    {
        return view('pages/dashboard/v_student_dashboard', ['hideHeader'=>true]);
    }
}

?>