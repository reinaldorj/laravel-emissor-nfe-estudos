<?php

namespace App\Helpers\supports\widgets\form;

use App\Helpers\supports\widgets\form\Field;
use App\Helpers\supports\widgets\base\Element;
use App\Helpers\supports\widgets\form\interfaces\FormElementInterface;

class RadioGroup extends Field implements FormElementInterface
{
    private $layout = 'vertical';
    private $items;
    private $selected;

    /**
     * Define a direção das opções (vertical ou horizontal)
     */
    public function setLayout($dir)
    {
        $this->layout = $dir;
    }

    /**
     * Adiciona itens (botões de rádio)
     * @param $items = array indexado contendo os itens
     */
    public function addItems($items)
    {
        $this->items = $items;
    }

    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        if (@$this->items["n"])
            $this->selected = $this->items["n"];

        if ($this->items) {
            // percorre cada uma das opções do rádio
            foreach ($this->items as $index => $label) {
                if ($index != "n") {
                    $button = new RadioButton($this->name);
                    $button->setValue($index);
                    // se o índice coincide

                    if ($this->selected == $index and !$this->value) {
                        $button->setProperty('checked', '1');
                    }

                    if ($this->value == $index) {
                        // marca o radio button
                        $button->setProperty('checked', '1');
                    }

                    $obj = new Label($label);
                    $obj->add($button);
                    $obj->show();
                    if ($this->layout == 'vertical') {
                        // exibe uma tag de quebra de linha
                        $br = new Element('br');
                        $br->show();
                    }
                    echo "\n";
                }
            }
        }
    }
}
