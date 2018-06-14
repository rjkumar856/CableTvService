<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'error';
$route['translate_uri_dashes'] = FALSE;

$route['about-us'] = "page/about";
$route['internet-packs'] = "page/internet_packs";
$route['cable-pack'] = "page/cable_pack";
$route['contact-us'] = "page/contact";

$route['contact-form-submission'] = "form/contact";
$route['contact-home-submission'] = "form/contacthome";
$route['new-connection-submission'] = "form/newconnection";

$route['login-page-submission'] = "login/submission_page";
$route['login-submission'] = "login/submission";
$route['login'] = "login/page";
$route['logout'] = "login/logout";
$route['forgot_password'] = "login/forgot_password";

$route['my-account'] = "account";
$route['my-package'] = "account/my_package";
$route['change-password'] = "account/change_password";
$route['change-password-submission'] = "account/change_password_submission";
$route['pay-bill'] = "account/pay_bill";
$route['my-view-bill'] = "account/view_bill";
$route['payment-success'] = "account/payment_success";
$route['my-complaint'] = "account/my_complaint";
$route['view-complaint'] = "account/view_complaint";
$route['new-complaint-submission'] = "account/complaint_submission";

