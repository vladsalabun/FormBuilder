<?php

namespace Salabun\Forms;

use Salabun\CodeWriter;
use Salabun\FormParams;
use Salabun\FormBuilder;
use Salabun\FormBuilderErrors;

/**
 *  Основниий клас, який наслідують усі форми.
 */

class FormInterface
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
     *  Конструктор:
     */
    public function __construct($param = []) 
	{
        // Дізнаюсь дефолтні параметри:
        $this->requiredParams = FormParams::textParams()['required'];
        $this->optionalParams = FormParams::textParams()['optional'];
        
        $this->incomingParams = $param;
        $this->checkIncomingParams();   
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
        $this->checkOptionalParams();
    }
    
    /**
     *  Перевіряю параметри способу генерації:
     */
	public function checkCreatingMethod()
	{
        if(isset($this->incomingParams['creating_method'])) {
            if(!array_key_exists($this->incomingParams['creating_method'], FormBuilder::$creatingMethods)) {
                $this->incomingParams['creating_method'] = 'HTML';
                $this->errors[22][] = FormBuilderErrors::error(22); 
            }
        } else {
            $this->incomingParams['creating_method'] = 'HTML';
            $this->errors[21][] = FormBuilderErrors::error(21);
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
                $this->errors[10][] = FormBuilderErrors::error(10); 
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
                // Якщо є, то активую метод:
                $this->incomingParams[$param] = $this->$param($this->incomingParams[$param]);
                
            }
        }
    }
    
    /**
     *  Перевіряю додаткові параметри:
     */
	public function checkOptionalParams()
	{
        foreach($this->optionalParams as $param => $value) {
            
            // Якщо обов'язковий параметр не вказано:
            if(!array_key_exists($param, $this->incomingParams)) {
                
                // Встановлюю дефолтне значення:
                $this->incomingParams[$param] = $value;
                $this->errors[32][] = FormBuilderErrors::error(32) . $param;
                
            } else {
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
            $this->errors[101][] = FormBuilderErrors::error(101) . ' (не строка)';
            return 'column_' . $this->requiredParams['name'];
        }
    }
    
    /**
     *  Перевірка параметру placeholder:
     */
    public function placeholder($value) 
	{
        if(is_string($value) or is_int($value) or $value == null) {
            return $value;
        } else {
            $this->errors[107][] = FormBuilderErrors::error(107);
            return null;
        }
    }
        
    /**
     *  Перевірка параметру label:
     */
    public function label($value) 
	{
        if(is_string($value) or is_int($value) or $value == null) {
            return $value;
        } else {
            $this->errors[103][] = FormBuilderErrors::error(103);
            return null;
        }
    }
    
    /**
     *  Перевірка параметру class:
     */
    public function class($value) 
	{
        if(is_string($value) or $value == null) {
            return $value;
        } else {
            $this->errors[104][] = FormBuilderErrors::error(104);
            return null;
        }
    }
    
    /**
     *  Перевірка параметру required:
     */
    public function required($value) 
	{        
        if(is_bool($value)) {
            return $value;
        } else {
            if($value == 'true') {
                return true;
            } else if($value == 'false') {
                return false;
            } else {
                $this->errors[105][] = FormBuilderErrors::error(105);
                return false;
            }
        }
    }
    
    
    /**
     *  Перевірка параметру autocomplete:
     */
    public function autocomplete($value) 
	{        
        if($value == 'off' or $value == 'on') {
            return $value;
        } else {
            $this->errors[108][] = FormBuilderErrors::error(108);
            return $this->optionalParams['autocomplete'];
        }
    }
    
    /**
     *  Перевірка параметру minlength:
     */
    public function minlength($value) 
	{        
        if(is_numeric($value) and $value >= 0) {
            return ceil($value);
        } else {
            $this->errors[109][] = FormBuilderErrors::error(109);
            return $this->requiredParams['minlength'];
        }
    }
    
    /**
     *  Перевірка параметру maxlength:
     */
    public function maxlength($value) 
	{        
        if(is_numeric($value) and $value > 0) {
            return ceil($value);
        } else {
            $this->errors[110][] = FormBuilderErrors::error(110);
            return $this->requiredParams['maxlength'];
        }
    }
    
    /**
     *  Перевірка параметру readonly:
     */
    public function readonly($value) 
	{        
        if(is_bool($value)) {
            return $value;
        } else {
            if($value == 'true') {
                return true;
            } else if($value == 'false') {
                return false;
            } else {
                $this->errors[111][] = FormBuilderErrors::error(111);
                return false;
            }
        }
    }    
    
    /**
     *  Перевірка параметру value:
     */
    public function value($value) 
	{
        if(is_string($value) or is_int($value) or $value == null) {
            return $value;
        } else {
            $this->errors[112][] = FormBuilderErrors::error(112);
            return $this->requiredParams['value'];
        }
    }
    
    /**
     *  Перевірка параметру values:
     */
    public function values($value) 
	{
        if(is_array($value)) {
            return $value;
        } else {
            $this->errors[106][] = FormBuilderErrors::error(106);
            return $this->requiredParams['values'];
        }
    }

    /**
     *  Перевірка параметру selected_value:
     */
    public function selected_value($value) 
	{
        if(is_string($value) or is_int($value) or $value == null) {
            return $value;
        } else {
            $this->errors[102][] = FormBuilderErrors::error(102);
            return null;
        }
    }
    
    /**
     *  Дебаг:
     */
    public function debug() 
	{
        // Якщо включений дебаг:
        if($this->incomingParams['debug'] == true) {
            
            // Якщо помилки є:
            if(count($this->errors) > 0) {
                
                // Публікую повідомлення про помилки під час генерації форми:
                $this
                    ->codeWriter
                    ->lines([
                        '<!--- DEBUG: --->',
                        '<!---'
                    ]);
                
                foreach($this->errors as $errorCode => $errorMessage) {

                    // Помилки завжди зберігаються в масив:
                    if(is_array($errorMessage)) {
                        
                        foreach($errorMessage as $errorSubMessage) {
                            $this
                                ->codeWriter
                                ->lines([
                                    '[' . $errorCode . '] ' . $errorSubMessage . ' ',
                                ]);
                        }
                        
                    } else {
                        // Если про всяк випадок ще виводжу строку:
                        $this
                            ->codeWriter
                            ->line($errorMessage); 
                    }
                  
                }
                
                $this
                    ->codeWriter
                    ->lines([
                        '--->',
                        '<!--- /DEBUG --->'
                    ]);
            }

        }  
    }
    
    /**
     *  Завершальний метод, який переводить об'єкт у строку для виводу на екран: 
     */
	public function toString()
	{
        // Якщо будівельник вміє генерувати обраним методом:
        if(isset(FormBuilder::$creatingMethods[$this->incomingParams['creating_method']])) {
            
            // Викликаю обраний метод:
            $method = FormBuilder::$creatingMethods[$this->incomingParams['creating_method']];
            return $this->$method();
            
        } else {
            
            // Інакше генерую HTML:
            return $this->getHTML();
            
        }
    }
    
}