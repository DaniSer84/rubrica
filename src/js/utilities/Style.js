class Style {

    static centerElement(el) {
    
        el = el.parentNode
        
        let width = el.offsetWidth
        
        el.style.position = 'relative'
        el.style.left = `calc(50% - ${width/2}px)`
    
    }
    
}

export { Style }