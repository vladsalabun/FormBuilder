<?php

namespace Salabun;

/**
 *  Параметри полів по замочуванню:
 */
class FormParams
{

    /**
     *  Класи для блоків форм:
     */
    static $formclasses = [
        'form-label' => 'form-label',
        'form-content' => 'form-content',
        'form-error' => 'form-error',
    ];   
    
    public function __construct() 
	{
        /**
         *  Це перелік типів форм, які я можу генерувати
         *  І їхні дефолтні параметри
         */
        $this->formTypes = 
        [
            'hidden' => FormParams::hiddenParams(),
            'text' => FormParams::textParams(),
            'number' => FormParams::numberParams(),
            'textarea' => FormParams::textareaParams(),
            'radio' => FormParams::radioParams(),
            'select' => FormParams::selectParams(), // ГОТОВО!
            'checkbox' => FormParams::checkboxParams(),
            'youtube_video' => FormParams::youtube_videoParams(),
            'datepicker' => FormParams::datepickerParams(),
            'tempus_datetimepicker' => FormParams::tempus_datetimepickerParams(),
            'file' => FormParams::fileParams(),
            'files' => FormParams::filesParams(),
            'image' => FormParams::imageParams(),
            'images' => FormParams::imagesParams(),
        ];
        
        // TODO: виписати унікальні назви параметрів та їхніх дефолтних значень, та створити для них поля в таблиці генератора
        
        $this->defaultParams = [];
        
        
    }
    
	public static function all() 
	{
        return new FormParams;
    }
    
	public static function hiddenParams() 
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
    
	public static function textParams() 
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

	public static function numberParams() 
	{
        return [];
    }
    
	public static function textareaParams() 
	{
        return [];
    }

	public static function radioParams() 
	{
        return [];
    }

	public static function selectParams() 
	{
        return 
        [
            "required" => [
                "name" => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
                "selected_value" => null,
                "values" => [],
            ],
            "optional" => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function checkboxParams()
	{
        return [];
    }
    
	public static function youtube_videoParams()
	{
        return [];
    } 
        
	public static function datepickerParams()
	{
        return [];
    } 
    
	public static function tempus_datetimepickerParams()
	{
        return [];
    }
    
	public static function fileParams()
	{
        return [];
    }
    
	public static function filesParams()
	{
        return [];
    }
            
	public static function imageParams()
	{
        return [];
    }  
       
	public static function imagesParams()
	{
        return [];
    }    
    
    
}