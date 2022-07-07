<?php
require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'adbstractstrictdata.php';

class WrongDeclaration extends AbstractStrictData {
	protected $data;
}

$data = new WrongDeclaration;
// PHP Fatal error:  Uncaught InvalidArgumentException: Property "data" can not be NULL in class "WrongDeclaration" constructor.