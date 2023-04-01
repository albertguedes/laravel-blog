/*
 * Alternate '+' and '-' symbols on item on categories list page.
 */
const collapseLinks = document.querySelectorAll('.collapse-link');
collapseLinks.forEach( link => {
    link.addEventListener('click', function() {
        let icon = this.querySelector('.collapse-icon');
        if (icon.innerText == '-') {
            // Altera o texto dentro do link para indicar que o conteúdo está visível
            icon.innerText = '+';
        }
        else {
            // Altera o texto dentro do link para indicar que o conteúdo está oculto
            icon.innerText = '-';
        }
    });
});
