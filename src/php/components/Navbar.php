<?php

namespace Rubrica\Php\Components;

class Navbar extends HtmlElement {

    public function render(): string {

        $items = $this->putParam('items');
        $active = $this->putParam('active');
        $search = $this->putParam('search');
        $navItems = self::setNavItem($items, $active);
        
        return 
            "<nav class='navbar navbar-expand-md border-2 border-bottom'>
                <div class='container-fluid'>
                    <span class='navbar-brand mb-0 h1'>Rubrica</span>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse'
                        data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false'
                        aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                            $navItems
                        </ul> 
                        $search
                    </div>
                </div>
            </nav>";
        
    }

    public static function setNavItem($items, $active) {

        $navItems = '';
        
        foreach ($items as $key => $value) {

            $isActive = $value === $active ? 'active' : null;
            
            $navItems .= "<li class='nav-item'><a class='nav-link $isActive' aria-current='page' href='$key'>$value</a></li>\n";
            
        }
        
        return $navItems;
    }


    
}