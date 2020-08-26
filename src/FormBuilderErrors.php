<?php

namespace Salabun;

use Salabun\Forms;

/**
 *  Опис помилок, які можуть виникати під час генерації форм
 */

class FormBuilderErrors
{
    /**
     *  Перелік помилок:
     */
    static $errors = [
        10 => 'Хибне значення параметру debug! Встановлюю по-дефолту true. Доступні значання: true, false.',
        
        21 => 'Не вказано параметр creating_method! Встановлюю по-дефолту HTML. Доступні значання: HTML, PHP, Blade.',
        22 => 'Хибне значення параметру creating_method! Встановлюю по-дефолту HTML. Доступні значання: HTML, PHP, Blade.',
        
        30 => 'У вхідних параметрах передано зайвий параметр: ',
        31 => 'Відсутній обов\'язковий параметр: ',
        
        100 => 'Хибне значення обов\'язкового параметру name.',
        
        500 => 'Невідомий код помилки.',
    ];
    
    /**
     *  Отримати текст помилки:
     */
	public static function error($int) 
	{
        if(array_key_exists($int, self::$errors)) {
            return self::$errors[$int];
        } else {
            return self::$errors[500];
        }
	}
    
}