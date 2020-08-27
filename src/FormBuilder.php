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
    
    /**
     *  Дефолтні параметри усіх форм:
     */
	public static function all() 
	{
        return new FormParams;
	}

    /**
     *  Список задач для будівельника форм:
     */
	public static function todo() 
	{
        return [
            'Яким способом генерувати old_value() та $errors для Laravel?'
        ];
	}
    
    
    /**
     *  Генерація hidden:
     */
	public static function hidden($params = []) 
	{
        // TODO
	}
    
    /**
     *  Генерація text:
     */
	public static function text($params = []) 
	{
        return (new Forms\Text($params))->toString();
	}
    
    /**
     *  Генерація select:
     */
	public static function select($params = []) 
	{
        return (new Forms\Select($params))->toString();
	}
    
    
}