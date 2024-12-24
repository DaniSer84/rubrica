<?php

namespace Rubrica\Php\Components;

use Rubrica\Php\Components\HtmlElement;

class SearchFilters extends HtmlElement {

  public function render(): string {

    return
        "<div class='btn-group me-2'>
            <button type='button' class='btn btn-info dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
            Filtra
            </button>
            <ul class='dropdown-menu p-1'>
             <li>
                <p>Cerca per:</p>
            </li>
            <li>
                <select class='form-select' aria-label='Default select example' name='filter'>
                <option value=''>Tutto</option>
                <option value='name'>Nome</option>
                <option value='surname'>Cognome</option>
                <option value='fullname'>Nome&Cognome</option>
                <option value='company'>Compagnia</option>
                <option value='role'>Ruolo</option>
                <option value='email'>Email</option>
                <option value='birthdate'>Data di nascita</option>
                <option value='created_at'>Data creazione</option>
                </select>
            </li>
            
           
        </div>";
  }

}