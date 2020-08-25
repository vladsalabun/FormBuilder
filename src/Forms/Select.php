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
        $this->incomingParams = $param;
        $this->checkIncomingParams();
        
        
        $this->defaultParams = FormParams::selectParams();

        $this->params = [];
              
    }
    
    /**
     *  Перевірка вхідних параметрів:
     */
	public function checkIncomingParams()
	{
        $this->checkCreatingMethod();
        $this->checkDebug();

       
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
    
    /**
     *  Параметри поля.
     *  Допустимі додаю, зайві відхиляю.
     */
	public function params($array) 
	{
        
        foreach($this->defaultParams['required'] as $requiredParam) {
            if(array_key_exists($requiredParam, $array)) {
                $this->params[$requiredParam] = $array[$requiredParam];
            } else {
                $this->params[$requiredParam] = $this->$requiredParam();
            }
        }
        
        foreach($this->defaultParams['optional'] as $requiredParam) {
            if(array_key_exists($requiredParam, $array)) {
                $this->params[$requiredParam] = $array[$requiredParam];
            }
        }
        
        //$this->validate();
        
        return $this;
    }
    
    public function validate() 
	{
        foreach($this->defaultParams['required'] as $requiredParam) {
            if($this->params[$requiredParam] == null) {
                $this->params[$requiredParam] = $this->$requiredParam();
            }
        }
        //return $this;
    }
    
    public function id() 
	{
        if($this->params['name'] != null) {
            return 'column_' . $this->params['name'];
        } else {
            return 'column_' . rand(1111, 9999);
        }
    }

    public function name() 
	{
        if($this->params['name'] == null) {
            return 'field_' . rand(1111, 9999);
        }
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