<?php

namespace Salabun\Forms;

use Salabun\CodeWriter;
use Salabun\FormParams;
use Salabun\FormBuilder;
use Salabun\FormBuilderErrors;

/**
 *  Text:
 */
class Text extends FormInterface
{      

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
     *  Генерація HTML коду для копіювання і вставки:
     */
    public function getHTML() 
	{
        $this->codeWriter = new CodeWriter;
        
        // Всі параметри інпута:
        $input = [
            'input',
            'type="text"',
            'name="' . $this->incomingParams['name'] . '"',
            'value="' . $this->incomingParams['value'] . '"',
            'id="' . $this->incomingParams['id'] . '"',
            'class="' . $this->incomingParams['class'] . '"',
            'minlength="' . $this->incomingParams['minlength'] . '"',
            'maxlength="' . $this->incomingParams['maxlength'] . '"',
            'placeholder="' . $this->incomingParams['placeholder'] . '"',
            'autocomplete="' . $this->incomingParams['autocomplete'] . '"',
            $this->incomingParams['required'] == true ? 'required pattern=".*\S+.*"' : '',
            $this->incomingParams['readonly'] == true ? 'readonly' : ''
        ];
        
        $this
            ->codeWriter
            ->lines([
                '<!---- TEXT FIELD: ' . $this->incomingParams['name'] . ' ---->',
                '<div class="' . FormParams::$formclasses['form-label'] . '">' . $this->incomingParams['label'] . '</div>',
                '<div class="' . FormParams::$formclasses['form-content'] . '">',
            ])
            ->defaultSpaces(4)
            ->line('<' . trim(implode($input, ' ')) . '>');

            $this
            ->codeWriter
            ->defaultSpaces(0)
            ->lines([
                '</div>',
                '<div class="' . FormParams::$formclasses['form-error'] . '">',
            ])
            ->s(4)
            ->line('<small id="' . $this->incomingParams['name'] . '_js_error" class="form-text text-danger" style="display: none;"></small>')
            ->s(0)
            ->lines([
                '</div>',
            ]);
            
            // Дебаг:
            $this->debug();

            $this
                ->codeWriter
                ->line('<!---- /TEXT FIELD: ' . $this->incomingParams['name'] . ' ---->');              

        return trim($this->codeWriter->getCode());
    }

    /**
     *  Генерація Laravel Blade коду для копіювання і вставки:
     */   
    public function getBlade() 
	{
        $this->codeWriter = new CodeWriter;
        
        // Всі параметри інпута:
        $input = [
            'select',
            'name="' . $this->incomingParams['name'] . '"',
            'id="' . $this->incomingParams['id'] . '"',
            'class="' . $this->incomingParams['class'] . '"',
            'default-selected-value="' . $this->incomingParams['selected_value'] . '"',
            $this->incomingParams['required'] == true ? 'required' : ''
        ];
        
        $this
            ->codeWriter
            ->lines([
                '<!---- TEXT FIELD: ' . $this->incomingParams['name'] . ' ---->',
                '<div class="' . FormParams::$formclasses['form-label'] . '">' . $this->incomingParams['label'] . '</div>',
                '<div class="' . FormParams::$formclasses['form-content'] . '">',
            ])
            ->defaultSpaces(4)
            ->line('<' . trim(implode($input, ' ')) . '>');
            
            $this->codeWriter->s(4);
            
            $this->codeWriter->s(0);

            $this
            ->codeWriter->line(
                '</select>'
            )
            ->defaultSpaces(0)
            ->lines([
                '</div>',
                '<div class="' . FormParams::$formclasses['form-error'] . '">',
            ])
            ->s(4)
            ->line('<small id="' . $this->incomingParams['name'] . '_js_error" class="form-text text-danger" style="display: none;"></small>')
            ->s(0)
            ->lines([
                '</div>',
            ]);
            
            // Дебаг:
            $this->debug();

            $this
                ->codeWriter
                ->line('<!---- /TEXT FIELD: ' . $this->incomingParams['name'] . ' ---->');              

        return trim($this->codeWriter->getCode());
    }
    
    public function getPHP() 
	{
        $this->codeWriter = new CodeWriter;

        $this
            ->codeWriter
            ->line('$param = [')
                ->s(4)
                ->lines([
                    '"name" => "' . $this->incomingParams['name'] . '",',
                    '"label" => "' . $this->incomingParams['label'] . '",',
                    '"id" => "' . $this->incomingParams['id'] . '",',
                    '"selected_value" => "' . $this->incomingParams['selected_value'] . '",',
                    '"values" => "['
                ])
                ->s(8);
        
        $this
            ->codeWriter   
                ->s(4)            
                ->lines([
                    '],',
                    '"class" => "' . $this->incomingParams['class'] . '",',
                    '"required" => "' . $this->incomingParams['required'] . '",',
                    '"debug" => "' . $this->incomingParams['debug'] . '",',
                    '"creating_method" => "' . $this->incomingParams['creating_method'] . '",',
                ])
            ->s(0)
            ->line('];')
            ->br();

        $this
            ->codeWriter
            ->line('echo FormBuilder::select($param);');     
            
        return trim($this->codeWriter->getCode());
    }

}