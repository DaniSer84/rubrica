<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class Modal extends HtmlElement {

  public function render(): string {

    $id = $this->putParam("id");
    $title = $this->putParam("title");
    $text = $this->putParam("text");
    $button = $this->putParam("button");

    return
            "<div class='modal fade' id='$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>$title</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            $text
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Chiudi</button>
                            $button
                        </div>
                    </div>
                </div>
            </div>";
  }

}


