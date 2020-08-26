<?php

namespace Salabun\Forms;

use Salabun\CodeWriter;
use Salabun\FormParams;
use Salabun\FormBuilder;
use Salabun\FormBuilderErrors;

/**
 *  Select:
 */
class Select
{      
    
    /**
     *  Обов'язкові параметри:
     */
    public $requiredParams = [];
    
    /**
     *  Додаткові параметри:
     */
    public $optionalParams = [];
    
    /**
     *  Вхідні параметри:
     */
    public $incomingParams = [];

    /**
     *  Масив помилок, які виникли під час генерації:
     */
    public $errors = [];
    
    /**
     *  Параметри для Blade:
     */ 
    public $version = 4;
    public $prefix = 'control_panel';
    public $templatesFolder = 'templates';
    
    /**
     *  Конструктор:
     */
    public function __construct($param = []) 
	{
        // Дізнаюсь дефолтні параметри:
        $this->requiredParams = FormParams::selectParams()['required'];
        $this->optionalParams = FormParams::selectParams()['optional'];
        
        $this->incomingParams = $param;
        $this->checkIncomingParams();
        
        
       

        $this->params = [];
              
    }
    
    /**
     *  Перевірка вхідних параметрів:
     */
	public function checkIncomingParams()
	{
        $this->checkCreatingMethod();
        $this->checkDebug();
        $this->checkUnnecessaryParams();
        $this->checkRequiredParams();

       
        var_dump($this);
        die();
    }
    
    /**
     *  Перевіряю параметри способу генерації:
     */
	public function checkCreatingMethod()
	{
        if(isset($this->incomingParams['creating_method'])) {
            if(!array_key_exists($this->incomingParams['creating_method'], FormBuilder::$creatingMethods)) {
                $this->incomingParams['creating_method'] = 'HTML';
                $this->errors[22] = FormBuilderErrors::error(22); 
            }
        } else {
            $this->incomingParams['creating_method'] = 'HTML';
            $this->errors[21] = FormBuilderErrors::error(21);
        }  
    }
    
    /**
     *  Перевіряю параметри дебагу:
     */
	public function checkDebug()
	{
        if(isset($this->incomingParams['debug'])) {
            if($this->incomingParams['debug'] !== true) {
                $this->incomingParams['debug'] = true;
                $this->errors[10] = FormBuilderErrors::error(10); 
            }
        } else {
            $this->incomingParams['debug'] = false;
        }  
    }

    /**
     *  Перевіряю зайві параметри:
     */
	public function checkUnnecessaryParams()
	{        
        // Копіюю вхідні параметри:
        $tmpParams = $this->incomingParams;
        
        // Збираю всі необхідні параметри в один масив:
        $allParams = [
            'creating_method' => null,
            'debug' => null
        ];
        
        $allParams = array_merge($allParams, $this->requiredParams);
        $allParams = array_merge($allParams, $this->optionalParams);

        // Видаляю необхідні параметри, щоб залишити тільки зайві:
        foreach($tmpParams as $param => $value) {
            
            if(array_key_exists($param, $allParams)) {
                unset($tmpParams[$param]);
            }

        }
        
        // Повідомляю про зайві параметри:
        foreach($tmpParams as $param => $value) {
            if(is_string($param)) {
                $this->errors[30][] = FormBuilderErrors::error(30) . $param;
            } else {
                if(is_string($value)) {
                    $this->errors[30][] = FormBuilderErrors::error(30) . $value;
                } else {
                    if(is_int($param)) {
                        $this->errors[30][] = FormBuilderErrors::error(30) . $param;
                    } else { 
                        $this->errors[30][] = FormBuilderErrors::error(30) . ' (не строка)';
                    }
                }
            }
            // Видаляю зайві параметри:
            unset($this->incomingParams[$param]);
        }
    }
    
    /**
     *  Перевіряю обов'язкові параметри:
     */
	public function checkRequiredParams()
	{
        foreach($this->requiredParams as $param => $value) {
            
            // Якщо обов'язковий параметр не вказано:
            if(!array_key_exists($param, $this->incomingParams)) {
                
                // Встановлюю дефолтне значення:
                $this->incomingParams[$param] = $value;
                $this->errors[31][] = FormBuilderErrors::error(31) . $param;
                
            } else {
                var_dump('check ' . $param);
                // Якщо є, то активую метод:
                $this->incomingParams[$param] = $this->$param($this->incomingParams[$param]);
                
            }
        }
    }
    
    /**
     *  Перевірка параметру name:
     */
    public function name($value) 
	{
        if(is_string($value)) {
            return $value;
        } else {
            $this->errors[100][] = FormBuilderErrors::error(100) . ' (не строка)';
            return $this->requiredParams['name'];
        }
    }
    
    /**
     *  Перевірка параметру id:
     */
    public function id($value) 
	{
        if(is_string($value)) {
            return $value;
        } else {
            $this->errors[100][] = FormBuilderErrors::error(100) . ' (не строка)';
            return 'column_' . $this->requiredParams['name'];
        }
    }
    
    
    
    /**
     *  
     */
	public function toString()
	{
        if($this->incomingParams['creating_method'] == 'HTML') {
            return $this->getHTML();
        } else if($this->incomingParams['creating_method'] == 'Blade') {
            return $this->getBlade();
        } else if($this->incomingParams['creating_method'] == 'PHP') {
            return $this->getPHP();
        } else {
            return 'Невірно вказаний параметр creating_method! Можливі значення HTML, PHP, Blade.';
        }
    }


    
    /**
     *  Версія форм:
     */
	public function version($string) 
	{
        $this->version = $string;
        return $this;
    }
    
	public function prefix($string) 
	{
        $this->prefix = $string;
        return $this;
    }
    
	public function templatesFolder($string) 
	{
        $this->templatesFolder = $string;
        return $this;
    }
    
    
    public function value() 
	{
        if($this->params['value'] == null) {
            return '';
        }
    }
    
    public function getHTML() 
	{
        $this->codeWriter = new CodeWriter;
        
        $this
            ->codeWriter
            ->lines([
'<!---- SELECT FIELD: form_type ---->
<div class="form-group">
    <label class="form-label"></label>
                     
    <select name="form_type" id="column_form_type" class="form-control" default-selected-value="">
        <option value="hidden">hidden</option>
    </select>

    <small id="form_type_js_error" class="form-text text-danger" style="display: none;"></small>
</div>
<!---- /SELECT FIELD: form_type ---->'
             ]);

        return trim($this->codeWriter->getCode());
    }
    
    public function getBlade() 
	{
        $this->codeWriter = new CodeWriter;

        $this
            ->codeWriter
            ->line('blade select');

        return trim($this->codeWriter->getCode());
    }
    
    public function getPHP() 
	{
        $this->codeWriter = new CodeWriter;

        $this
            ->codeWriter
            ->line('php select');

        return trim($this->codeWriter->getCode());
    }
    
}