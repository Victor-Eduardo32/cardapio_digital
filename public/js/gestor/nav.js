export function abrirNav(){
    const botaoAbrir = $('.botao-abrir-nav');
    const nav = $('.nav-gestor');
    const btnCardapio = $('.btn-cardapio');
    
    botaoAbrir.on('click', function(){
        deslizarNav(nav);
        deslizarNav(btnCardapio);

        function deslizarNav(containerMostrado){
            if(containerMostrado.is(':hidden')){
                containerMostrado.slideDown();
                containerMostrado.css('display', 'flex');
            } else {
                containerMostrado.slideUp();
            }
        }
    })
}