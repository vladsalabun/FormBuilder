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
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function textParams() 
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "placeholder" => "",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }

	public static function numberParams() 
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function textareaParams() 
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }

	public static function radioParams() 
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
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function youtube_videoParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    } 
        
	public static function datepickerParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    } 
    
	public static function tempus_datetimepickerParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function fileParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
    
	public static function filesParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }
            
	public static function imageParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }  
       
	public static function imagesParams()
	{
        return 
        [
            'required' => [
                'name' => "name_" . rand(9999,99999),
                "id" => "id_" . rand(9999,99999),
            ],
            'optional' => [
                "label" => "Select",
                "class" => "form-control",
                "required" => false
            ]
        ];
    }    
    
    
}