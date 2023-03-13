<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


//$app = new \Slim\App;

$app->get('/', function (Request $request, Response $reponse) {
    echo 'Home Employee working';
});

//get all employee
$app->get('/api/employee', function (Request $request, Response $reponse) {
   
    $db = new db();
    $ormdb = $db->connect();
    $employee = $ormdb->table('employee')->get();
    echo $employee;
});


//get a single user
$app->get('/api/employee/{emp_id}', function (Request $request, Response $reponse, array $args) {
    $emp_id = $request->getAttribute('emp_id');
    $db = new db();
    $ormdb = $db->connect();
    
    $employee = $ormdb->table('employee')->where('emp_id',$emp_id)->get(); 
    
    echo $employee;
});


//make a post request
$app->post('/api/employee/add', function (Request $request, Response $reponse, array $args) {
    $db = new db();
    $ormdb = $db->connect();

   // $emp_id = $request->getParsedBody()['emp_id'];
    $emp_name = $request->getParsedBody()['emp_name'];
    $emp_email = $request->getParsedBody()['emp_email'];
    $emp_password = $request->getParsedBody()['emp_password'];
    $emp_mobile= $request->getParsedBody()['emp_mobile'];
    $emp_DepDetails = $request->getParsedBody()['emp_DepDetails'];
   
    $ormdb->table('employee')->insert([/*'emp_id'=>$emp_id,*/'emp_name'=>$emp_name,'emp_email'=>$emp_email,'emp_password'=>$emp_password,'emp_mobile'=>$emp_mobile,'emp_DepDetails'=>$emp_DepDetails]);
    $employee = $ormdb->table('employee')->get();
    echo 'employee ' . $emp_name . ' added to database';
    
});

//make a update(PUT) request
$app->put('/api/employee/update/{emp_id}', function (Request $request, Response $reponse, array $args) {
    $db = new db();
    $ormdb = $db->connect();
    $emp_id = $request->getAttribute('emp_id');
    
    // $emp_id = $request->getParsedBody()['emp_id'];
    $emp_name = $request->getParsedBody()['emp_name'];
    $emp_email = $request->getParsedBody()['emp_email'];
    $emp_password = $request->getParsedBody()['emp_password'];
    $emp_mobile= $request->getParsedBody()['emp_mobile'];
    $emp_DepDetails = $request->getParsedBody()['emp_DepDetails'];
    
    $employee = $ormdb->table('employee')->where('emp_id',$emp_id);
    
    $new_employee_data = array(/*'emp_id'=>$emp_id,*/'emp_name'=>$emp_name,'emp_email'=>$emp_email,'emp_password'=>$emp_password,'emp_mobile'=>$emp_mobile,'emp_DepDetails'=>$emp_DepDetails);
    
    $employee->update($new_employee_data);
    
    echo 'employee ' . $emp_name . ' updated';

});


//make a delete request
$app->delete('/api/employee/delete/{emp_id}', function (Request $request, Response $reponse, array $args) {
    $emp_id = $request->getAttribute('emp_id');
    $db = new db();
    $ormdb = $db->connect();
    
    $ormdb->table('employee')->where('emp_id',$emp_id)->delete();
    
    echo 'ID number : ' .$emp_id . ' deleted successfully !';
 //   return $response;

});
 


//$app->run();