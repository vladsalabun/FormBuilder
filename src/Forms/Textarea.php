<?php

namespace Salabun\Forms;

use Salabun\CodeWriter;
use Salabun\FormParams;
use Salabun\FormBuilder;
use Salabun\FormBuilderErrors;

/**
 *  Textarea:
 */
class Textarea extends FormInterface
{      

    /**
     *  Конструктор:
     */
    public function __construct($param = []) 
	{
        // Дізнаюсь дефолтні параметри:
        $this->requiredParams = FormParams::textareaParams()['required'];
        $this->optionalParams = FormParams::textareaParams()['optional'];
        
        $this->incomingParams = $param;
        $this->checkIncomingParams();   
    }

    /**
     *  Генерація HTML коду для копіювання і вставки:
     */
    public function getHTML() 
	{
        $this->codeWriter = new CodeWriter;
        return trim($this->codeWriter->getCode());
    }

    /**
     *  Генерація Laravel Blade коду для копіювання і вставки:
     */   
    public function getBlade() 
	{
        $this->codeWriter = new CodeWriter;
        return trim($this->codeWriter->getCode());
    }
    
    public function getPHP() 
	{
        $this->codeWriter = new CodeWriter;
        return trim($this->codeWriter->getCode());
    }

}