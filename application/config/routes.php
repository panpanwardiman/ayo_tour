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
// Backend Url
// Auth Route
$route['at-admin/auth'] = 'auth';
$route['at-admin/auth/login'] = 'auth/login';
$route['at-admin'] = 'dashboard';

// Users Route
$route['at-admin/user'] = 'user';
$route['at-admin/user/create'] = 'user/create'; 
$route['at-admin/user/(:num)'] = 'user/edit/$1'; 
$route['at-admin/user/store'] = 'user/store';
$route['at-admin/user/update/(:num)'] = 'user/update/$1';
$route['at-admin/user/delete/(:num)'] = 'user/destroy/$1';
$route['at-admin/user/change_password'] = 'user/change_password';
$route['at-admin/user/update_password/(:num)'] = 'user/update_password/$1';

// Categories Route
$route['at-admin/category'] = 'category';
$route['at-admin/category/create'] = 'category/create'; 
$route['at-admin/category/(:num)'] = 'category/edit/$1';
$route['at-admin/category/store'] = 'category/store';
$route['at-admin/category/update/(:num)'] = 'category/update/$1';
$route['at-admin/category/delete/(:num)'] = 'category/destroy/$1/';

// Tags Route
$route['at-admin/tag'] = 'tags';
$route['at-admin/tag/create'] = 'tags/create'; 
$route['at-admin/tag/(:num)'] = 'tags/edit/$1';
$route['at-admin/tag/store'] = 'tags/store';
$route['at-admin/tag/update/(:num)'] = 'tags/update/$1';
$route['at-admin/tag/delete/(:num)'] = 'tags/destroy/$1';

// Service Route
$route['at-admin/service'] = 'service';
$route['at-admin/service/create'] = 'service/create'; 
$route['at-admin/service/(:num)'] = 'service/edit/$1';
$route['at-admin/service/store'] = 'service/store';
$route['at-admin/service/update/(:num)'] = 'service/update/$1';
$route['at-admin/service/delete/(:num)'] = 'service/destroy/$1';

// Slider Route
$route['at-admin/slider'] = 'slider';
$route['at-admin/slider/create'] = 'slider/create'; 
$route['at-admin/slider/(:num)'] = 'slider/edit/$1';
$route['at-admin/slider/store'] = 'slider/store';
$route['at-admin/slider/update/(:num)'] = 'slider/update/$1';
$route['at-admin/slider/delete/(:num)'] = 'slider/destroy/$1';

// Article Route
$route['at-admin/article'] = 'articles';
$route['at-admin/article/create'] = 'articles/create'; 
$route['at-admin/article/(:num)'] = 'articles/edit/$1';
$route['at-admin/article/store'] = 'articles/store';
$route['at-admin/article/update/(:num)'] = 'articles/update/$1';
$route['at-admin/article/delete/(:num)'] = 'articles/destroy/$1';

// Product Route
$route['at-admin/package'] = 'packages';
$route['at-admin/package/create'] = 'packages/create'; 
$route['at-admin/package/(:num)'] = 'packages/edit/$1';
$route['at-admin/package/store'] = 'packages/store';
$route['at-admin/package/update/(:num)'] = 'packages/update/$1';
$route['at-admin/package/delete/(:num)'] = 'packages/destroy/$1';

// Frontend Url
$route['default_controller'] = 'frontend_template';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
