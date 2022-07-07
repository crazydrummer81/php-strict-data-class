<?php
require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'adbstractstrictdata.php';

class StrictResponse extends AbstractStrictData {
  protected $message = 'Hello!';
  protected $statusCode = 200;
}

$response = new StrictResponse;

var_dump($response);
// object(StrictResponse)#1 (2) {
  //   ["message":protected]=>     
  //   string(6) "Hello!"
  //   ["statusCode":protected]=>  
  //   int(200)
  // }
  
var_dump($response->message);
// string(6) "Hello!"

var_dump($response->notDeclaredProperty);
// PHP Fatal error:  Uncaught InvalidArgumentException: Class "StrictResponse" does not have "notDeclaredProperty" property
	
$response->message = 'Bye!';
var_dump($response);
// object(StrictResponse)#1 (2) {
//   ["message":protected]=>     
//   string(4) "Bye!"
//   ["statusCode":protected]=>  
//   int(200)
// }

$response->status = 'success';
// PHP Fatal error:  Uncaught InvalidArgumentException: Class "AbstractStrictData" does not have "status" property ...

$response->statusCode = '200';
// PHP Fatal error:  Uncaught InvalidArgumentException: Object property "statusCode" must be type "integer", "string" given.

$responseArr = $response->toArray();
var_dump($responseArr);
// array(2) {
//   ["message"]=>
//   string(4) "Bye!"
//   ["statusCode"]=>
//   int(200)
// }

$json = $response->toJson(JSON_PRETTY_PRINT);
var_dump($json);
// string(48) "{
// 	"message": "Bye!",
// 	"statusCode": 200
// }"