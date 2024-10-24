// Adicionando o evento de clique ao ícone de hambúrguer
document.addEventListener('DOMContentLoaded', function () {
    // Adicionando o evento de clique ao ícone de hambúrguer
    let hamburgerMenu = document.querySelector('.hamburger-menu');
    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function () {
            let ul = document.querySelector('ul');
            if (ul) {
                ul.classList.toggle('show');
            }
            this.classList.toggle('change');
        });
    }})
