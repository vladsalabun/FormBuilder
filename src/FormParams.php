<?php

namespace Salabun;

/**
 *  Параметри полів по замочуванню:
 */
class FormParams
{
	public function __construct() 
	{
        /**
         *  Це перелік типів форм, які я можу генерувати
         *  І їхні дефолтні параметри
         */
        $this->formTypes = 
        [
            'hidden' => FormParams::hidden(),
            'text',
            'number',
            'textarea',
            'radio',
            'select',
            'checkbox',
            'youtube_video',
            'datepicker',
            'tempus_datetimepicker',
            'file',
            'files',
            'image',
            'images',
        ];
        
        // TODO: виписати унікальні назви параметрів та їхніх дефолтних значень, та створити для них поля в таблиці генератора
        
        $this->formParams = [];
        
        
    }
    
	public static function all() 
	{
        return new FormParams;
    }
    
	public static function hidden() 
	{
        return 
        [
            'required' => [
                'value',
                'name',
                'id',
            ],
            'optional' => [
            
            ]
        ];
    }
    
	public static function text() 
	{
        return 
        [
            'required' => [
                'value',
                'name',
                'id',
            ],
            'optional' => [
                'old_value',
            ]
        ];
    }

}