<?php

namespace Salabun;

use Salabun\Forms;
use Salabun\FormBuilderErrors;

/**
 *  Цей пакет будує HTML форми.
 */

class FormBuilder
{
    
    /**
     *  Доступні методи генерації:
     */
    static $creatingMethods = [
        'HTML' => 'getHTML',
        'Blade' => 'getBlade',
        'PHP' => 'getPHP',
    ];
    
    public function __construct() 
	{

	}
    
	public static function all() 
	{
        return new FormParams;
	}

    
    /**
     *  Генерація hidden:
     */
	public static function hidden($params = []) 
	{
        // TODO
	}
    
    /**
     *  Генерація select:
     */
	public static function select($params = []) 
	{
        return (new Forms\Select($params))->toString();
	}
    
    
}