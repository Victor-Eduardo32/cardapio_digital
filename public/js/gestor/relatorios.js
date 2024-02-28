// Mostrar mais destalhes do produto em relatórios
export function abrirDadosProduto(){
    $('.abrir-produto').click(function(){
        let produtoContainer = $(this).parent().next(".info-produto-categorias");

        if(produtoContainer.is(':hidden') == true){
            produtoContainer.slideDown();
        } else {
            produtoContainer.slideUp();
        }
    })
}

// Mostrar mais destalhes do cliente em relatórios
export function abrirDadosCliente(){
    $('.abrir-cliente').click(function(){
        let clienteContainer = $(this).parent().next(".cliente");

        if(clienteContainer.is(':hidden') == true){
            clienteContainer.slideDown();
        } else {
            clienteContainer.slideUp();
        }
    })
}
