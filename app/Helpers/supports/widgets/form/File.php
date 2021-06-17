<?php

namespace App\Helpers\supports\widgets\form;

use App\Helpers\supports\widgets\form\Field;
use App\Helpers\supports\widgets\base\Element;
use App\Helpers\supports\widgets\form\interfaces\FormElementInterface;

/**
 * Representa um componente de upload de arquivo
 * @author Pablo Dall'Oglio
 */
class File extends Field implements FormElementInterface
{
    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $divcontainerimg = new Element('div');
        $divcontainerimg->class = 'col-md-4';

        $divcontainerfile = new Element('div');
        $divcontainerfile->class = 'col-md-7';

        //$inputHidden = new Element('input');
        //$inputHidden->type = 'hidden';
        //$inputHidden->name = 'file';
        //$inputHidden->value = $this->value ? URL_BASE . $this->value : null;

        $img        = new Element('img');
        $img->src   = $this->value ? URL_BASE . $this->value : URL_BASE . "assets/adm/images/default.jpg";
        $img->style = "max-width: 100%;";

        $tag = new Element('input');
        $tag->class = 'field';
        $tag->name = $this->name;    // nome da TAG
        $tag->value = URL_BASE . $this->value;  // valor da TAG
        $tag->type = 'file';         // tipo de input
        $tag->style = "width:{$this->size}"; // tamanho em pixels
        
        // se o campo não é editável
        if (!parent::getEditable()) {
            // desabilita a TAG input
            $tag->readonly = "1";
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }

        $divcontainerimg->add($img);
        $divcontainerfile->add($tag);
        //$divcontainerfile->add($inputHidden);
        $divcontainer = new Element('div');
        $divcontainer->class = 'row';

        $divcontainer->style = 'align-items: center;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;';

        $divcontainer->add($divcontainerimg);
        $divcontainer->add($divcontainerfile);

        // exibe a tag
        $divcontainer->show();
    }
}
