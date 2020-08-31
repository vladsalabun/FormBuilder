<?php

namespace Salabun\Forms;

use Salabun\CodeWriter;
use Salabun\FormParams;
use Salabun\FormBuilder;
use Salabun\FormBuilderErrors;

/**
 *  Select:
 */
class Select extends FormInterface
{      
 
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
    }

    /**
     *  Генерація HTML коду для копіювання і вставки:
     */
    public function getHTML() 
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
                '<!---- SELECT FIELD: ' . $this->incomingParams['name'] . ' ---->',
                '<div class="' . FormParams::$formclasses['form-label'] . '">' . $this->incomingParams['label'] . '</div>',
                '<div class="' . FormParams::$formclasses['form-content'] . '">',
            ])
            ->defaultSpaces(4)
            ->line('<' . trim(implode($input, ' ')) . '>');
            
            $this->codeWriter->s(4);
            
            // Варіанти вибору:
            foreach($this->incomingParams['values'] as $value => $text) {
                
                if($this->incomingParams['selected_value'] == $value) {
                    $this->codeWriter->line(
                        '<option value="' . $value . '" selected>' . $text . '</option>'
                    );  
                } else {
                    $this->codeWriter->line(
                        '<option value="' . $value . '">' . $text . '</option>'
                    );  
                }

            }
            
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
                ->line('<!---- /SELECT FIELD: ' . $this->incomingParams['name'] . ' ---->');              

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
                '<!---- SELECT FIELD: ' . $this->incomingParams['name'] . ' ---->',
                '<div class="' . FormParams::$formclasses['form-label'] . '">' . $this->incomingParams['label'] . '</div>',
                '<div class="' . FormParams::$formclasses['form-content'] . '">',
            ])
            ->defaultSpaces(4)
            ->line('<' . trim(implode($input, ' ')) . '>');
            
            $this->codeWriter->s(4);
            
            // Варіанти вибору:
            foreach($this->incomingParams['values'] as $value => $text) {
                $this->codeWriter->line(
                    '<option value="' . $value . '" @if($object->' . $this->incomingParams['name'] . ' == "' . $value . '"){{""}}selected{{""}}@endif>' . $text . '</option>'
                );  
            }
            
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
                ->line('<!---- /SELECT FIELD: ' . $this->incomingParams['name'] . ' ---->');              

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
                
        // Варіанти вибору:
        foreach($this->incomingParams['values'] as $value => $text) {
            $this
                ->codeWriter         
                    ->line('"' . $value . '" => "' . $text . '",');
        }
        
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