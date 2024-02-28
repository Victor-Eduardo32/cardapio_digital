// Abrir aba de cada status da aba de pedidos
export function abrirContainerPedido(){
    $('.aba').click(function(){
        let pedidosContainer = $(this).siblings('.pedidos-container');

        if(pedidosContainer.is(':hidden') == true){
            pedidosContainer.css('display', 'flex');
        } else {
            pedidosContainer.css('display', 'none');
        }
    })
}

export function calcularValorFinal(){
    $('.pedido').each(function(){
        let valorCompra = parseFloat($(this).find('.valor-compra b').text().replace('R$', '').trim());
        let valorEntrega = $(this).find('.valor-entrega b');
        if(valorEntrega.length > 0){
            valorEntrega = parseFloat(valorEntrega.text().replace('R$', '').trim());
            let valorTotal = valorCompra + valorEntrega;
            
            $(this).find('.valor-total b').text('R$ ' + valorTotal.toFixed(2));
        } else if(valorEntrega.length <= 0){
            let valorTotal = valorCompra;
            $(this).find('.valor-total b').text('R$ ' + valorTotal.toFixed(2));
        }
    })
    
}
