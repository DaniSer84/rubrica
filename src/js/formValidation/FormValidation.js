
export function setCustomMessages(form) {

    const email = form.elements.email;
    const name = form.elements.name;
    const phone = form.elements.phone;


    email.addEventListener('input', (e) => {

        const validityState = email.validity;

        if (validityState.valueMissing) {

            email.setCustomValidity('Per favore inserisci l\'indirizzo email del contatto.');
            
        } else if (validityState.typeMismatch || validityState.patternMismatch) {

            email.setCustomValidity('Per favore inserisci un indirizzo email valido (es: esempio@dominio.com).');
            
        } else {

            email.setCustomValidity('');
            
        }

    })

    name.addEventListener('input', (e) => {

        const validityState = name.validity;
        
        if (validityState.valueMissing) {

            name.setCustomValidity('Per favore inserisci il nome del contatto.')
            
        } else if (validityState.patternMismatch) {
            
            name.setCustomValidity('Per favore inserisci un nome valido (es: "Luca", "Gian Marco", etc.).');
            
        } else {

            name.setCustomValidity('');

        }

    })

   phone.addEventListener('input', () => {

        const validityState = phone.validity;
        
        if (validityState.valueMissing) {

            phone.setCustomValidity('Per favore inserisci il numero di telefono del contatto.');
            
        } else if (validityState.patternMismatch || validityState.tooShort) {

            phone.setCustomValidity('Per favore inserisci un numero di telefono valido (es: 3331234567 / 00391234567890).');
            
        } else {

            phone.setCustomValidity('')
            
        }
    
})
    
}