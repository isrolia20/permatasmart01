<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'LandingController';
$route['beranda'] = 'LandingController';
$route['test'] = 'LandingController';
$route['lesson'] = 'LandingController/leason';
$route['checkout'] = 'LandingController/leasonCheckout';
$route['payment'] = 'LandingController/payment';
$route['form'] = 'LandingController/form';
$route['login'] = 'AuthController';
$route['admin/login'] = 'AuthController/loginAdmin';
$route['register'] = 'AuthController/registerStudent';
$route['register/siswa'] = 'AuthController/registerStudent';
$route['register/tutor'] = 'AuthController/registerTutor';
$route['logout'] = 'AuthController/logout';

$route['admin/package'] = 'PackageController';
$route['admin/feature'] = 'FeatureController';
$route['admin/leason'] = 'LeasonController';
$route['admin/transaction'] = 'TransactionController';
$route['admin/faq'] = 'FaqController';
$route['admin/profile'] = 'UserController/profile';
$route['admin/user'] = 'UserController';
$route['admin/tutor'] = 'TutorController';
$route['admin/admin'] = 'AdminController';
$route['admin/student'] = 'StudentController';
$route['admin/student/add'] = 'StudentController/addStudent';
$route['admin'] = 'DashboardController';

$route['tutor/package'] = 'PackageControllerTutor';
$route['tutor/feature'] = 'FeatureControllerTutor';
$route['tutor/leason'] = 'LeasonControllerTutor';
$route['tutor/transaction'] = 'TransactionControllerTutor';
$route['tutor/faq'] = 'FaqControllerTutor';
$route['tutor/profile'] = 'UserControllerTutor/profile';
// $route['tutor/user'] = 'UserControllerTutor';
// $route['tutor/tutor'] = 'TutorControllerTutor';
// $route['tutor/admin'] = 'AdminControllerTutor';
// $route['tutor/student'] = 'StudentControllerTutor';
$route['tutor/student/add'] = 'StudentControllerTutor/addStudent';
$route['tutor'] = 'DashboardControllerTutor';

// $route['register/tutor'] = 'auth/register_tutor';
$route['forgot-password'] = 'auth/forgot_pw';
$route['reset-password'] = 'auth/reset_pw';
$route['test'] = 'dashboard/test';
$route['dashboard'] = 'DashboardController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;
