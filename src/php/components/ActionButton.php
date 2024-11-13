<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class ActionButton extends HtmlElement
{

    public function render(): string
    {

        $href = $this->putParam("href");
        $id = $this->putParam("id");
        $class = $this->putParam('class');
        $text = $this->putParam("text");

        return "<a href='$href' id='$id'>
                    <button type='button' class='btn $class'>$text</button>
                </a>";

    }

}