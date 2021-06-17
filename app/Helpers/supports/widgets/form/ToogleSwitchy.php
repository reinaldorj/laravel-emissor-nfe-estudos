<?php

namespace App\Helpers\supports\widgets\form;

use App\Helpers\supports\widgets\form\Field;
use App\Helpers\supports\widgets\base\Element;
use App\Helpers\supports\widgets\form\interfaces\FormElementInterface;;

class ToogleSwitchy extends Field implements FormElementInterface
{
    protected $properties;

    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        $data_size  = "data-size";
        $data_color = "data-color";
        $data_text  = "data-text";
        $data_style = "data-style";

        // atribui as propriedades da TAG
        $div                = new Element('label');
        $div->class         = "toggle-switchy";
        $div->for           = $this->name;
        $div->$data_size    = "xs";
        $div->$data_color   = "blue";
        $div->$data_text    = "false";
        $div->$data_style   = "rounded";


        $tag                = new Element('input');
        //$tag->class         = 'field';          // classe CSS
        $tag->name          = $this->name;     // nome da TAG
        $tag->id            = $this->name;
        //$tag->value         = $this->value;   // valor da TAG
        $tag->type          = 'checkbox';        // tipo de input
        //$tag->style         = "width:{$this->size}"; // tamanho em pixels

        if (!parent::getEditable()) {
            // desabilita a TAG input
            $tag->disabled = "disabled";
            $tag->style .= " opacity: 0 !important;";
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }

        if ($this->value) {
            if ($this->value == "S") {
                $tag->checked = "checked";
            }
        }else {
            $tag->checked = "checked";
        }

        $div->add($tag);

        $spanToogle = new Element('div');
        $spanToogle->class = "toggle";

        $spanSwitch = new Element('span');
        $spanSwitch->class = "switch";
        $spanToogle->add($spanSwitch);

        $div->add($spanToogle);

        $spanLabel = new Element('span');
        $spanLabel->class = "label";

        $divLabel = new Element('div');
        $divLabel->class = "descricao-check-tab";
        $divLabel->add("Ativo");

        $spanLabel->add($divLabel);

        $div->add($spanLabel);

        // exibe o elemento
        $div->show();
    }
}
