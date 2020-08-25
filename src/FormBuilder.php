<?php

namespace Salabun;

use Salabun\Forms;

/**
 *  Цей пакет будує HTML форми.
 */

class FormBuilder
{
	public function __construct() 
	{
        $method = 'getHTML';
	}
    
	public static function all() 
	{
        return new FormParams;
	}

    /**
     *  Генерація hidden:
     */
	public static function hidden($param = []) 
	{
        $formParams = new Forms\Hidden;
        return [$formParams, $param ];
	}
    
    /**
     *  Генерація select:
     */
	public static function select($param = []) 
	{
        return (new Forms\Select($param))->toString();
	}
    
    
}