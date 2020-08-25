<?php

namespace Salabun;

/**
 *  Цей пакет будує HTML форми.
 */

class FormBuilder
{
	public function __construct() 
	{
	}
    
	public static function all() 
	{
        return new FormParams;
	}

}