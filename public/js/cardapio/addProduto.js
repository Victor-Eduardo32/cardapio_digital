export function alterarQtdProduto() {
    let quantidadeProduto = $('#qtd-produto');

    $('#diminuir-qtd').click(function () {
        let valorAtual = parseInt(quantidadeProduto.text(), 10)
        if (valorAtual > 1) {
            quantidadeProduto.text(valorAtual - 1);
            alterarValorProduto();
        }
    })

    $('#aumentar-qtd').click(function () {
        let valorAtual = parseInt(quantidadeProduto.text(), 10);
        quantidadeProduto.text(valorAtual + 1);
        alterarValorProduto();
    })
}

export function alterarQtditem(){
    $('.diminuir-qtd-item').click(function () {
        let quantidadeItem = $(this).closest('.item-qtd').find('.qtd-atual-item');
        let valorAtual = parseInt(quantidadeItem.text(), 10);
        if (valorAtual > 0) {
            quantidadeItem.text(valorAtual - 1);
        }
    });

    $('.aumentar-qtd-item').click(function () {
        let quantidadeItem = $(this).closest('.item-qtd').find('.qtd-atual-item');
        let valorAtual = parseInt(quantidadeItem.text(), 10);
        quantidadeItem.text(valorAtual + 1);
    });
}

export function alterarValorProduto() {
    // Verifica se a variável valorProdutoOriginal já foi definida
    if (typeof alterarValorProduto.valorProdutoOriginal === 'undefined') {
        // Se não foi definida, define com o valor original, ou seja, o valor inicial
        alterarValorProduto.valorProdutoOriginal = parseFloat($('.adicionar-produto p').text().replace("R$", "").trim());
    }

    // Para armazenar os valores de quando o tipo do complemento for Múltiplas Opções
    function calcularValorItensMO() {
        let ValoresItens = 0;

        $('.aumentar-qtd-item, .diminuir-qtd-item').each(function () {
            let quantidadeItem = $(this).closest('.item-qtd').find('.qtd-atual-item').text();
            quantidadeItem = parseInt(quantidadeItem);

            let valorItem = $(this).closest('.opcoes-complemento').find('.valor-item').text().trim();
            valorItem = parseFloat(valorItem.replace('+', ''));

            ValoresItens += (valorItem * quantidadeItem)/2;
        });
        
        return ValoresItens;
    }

    // Para armazenar os valores de quando o tipo do complemento for Seleção Única
    function calcularValorItensSU() {
        let ValoresItens = 0;

        $('.item-marcado:checked').each(function () {
            let valorItem = $(this).closest('.opcoes-complemento').find('.valor-item').text().trim();
            valorItem = parseFloat(valorItem.replace('+', ''));
            ValoresItens += valorItem;
        });
    
        return ValoresItens;
    }

    function atualizarValorFinal() {
        let ValoresItensMO = calcularValorItensMO();
        let ValoresItensSU = calcularValorItensSU();

        if(ValoresItensMO >= 0 || ValoresItensSU >= 0){
            let quantidadeProduto = parseInt($('#qtd-produto').text());
            let valorFinal = (alterarValorProduto.valorProdutoOriginal + ValoresItensMO + ValoresItensSU) * quantidadeProduto;

            $('.adicionar-produto p').text('R$' + valorFinal.toFixed(2));
        }
        
    }

    function armazenarValorProduto(){
        let ValoresItensMO = calcularValorItensMO();
        let ValoresItensSU = calcularValorItensSU();

        if(ValoresItensMO >= 0 || ValoresItensSU >= 0){
            let valorFinal = alterarValorProduto.valorProdutoOriginal + ValoresItensMO + ValoresItensSU;

            $('[name=valor-produto-armazenado]').val(valorFinal.toFixed(2));
        }
    }

    const functionUpdateFinalValue = () => {
        atualizarValorFinal();
    }

    $('.aumentar-qtd-item, .diminuir-qtd-item').on('click', functionUpdateFinalValue);

    $('#diminuir-qtd, #aumentar-qtd').on('click', functionUpdateFinalValue);

    $('.item-marcado').on('change', functionUpdateFinalValue);

    $('form').on('submit', armazenarValorProduto);
}

export function formSubmitAddProduto(){
    $('.adicionar-produto').on('click', function(){
        $('form').submit();
    });
}

export function armazenarQuantidadeProduto(){
    $('form').on('submit', function(){
        let quantidadeProduto = $('#qtd-produto').html();
        quantidadeProduto = parseInt(quantidadeProduto);

        $('[name=quantidade-produto-armazenado]').val(quantidadeProduto);
    });
}

export function armazenarQuantidadeItem(){
    function armazenarQuantidadeSU() {
        let quantidadeItemSU = [];
    
        $('.item-check').each(function () {
            let itemCheck = $(this).find('.item-marcado');
            let quantidadeItem = 0;
    
            if (itemCheck.is(':checked')) {
                quantidadeItem = 1;
            } else {
                quantidadeItem = '';
            }
    
            quantidadeItemSU.push(quantidadeItem);
        });

        $('[name="quantidade-item-SU[]"]').val(quantidadeItemSU.join(','));
    }

    function armazenarQuantidadeMO() {
        let quantidadeItemMO = [];
    
        $('.item-qtd').each(function() {
            let quantidadeItem = $(this).find('.qtd-atual-item');
            quantidadeItem = parseInt(quantidadeItem.html());
    
            quantidadeItemMO.push(quantidadeItem);
        });
    
        $('[name="quantidade-item-MO[]"]').val(quantidadeItemMO.join(','));
    }

    $('.diminuir-qtd-item, .aumentar-qtd-item').on('click', armazenarQuantidadeMO);
    $('.item-marcado').on('change', armazenarQuantidadeSU);
    
}

export function limiteComplemento() {
    $('.complemento-produtos').each(function () {
        let minimoSelecionado = parseInt($(this).find('.min-selecinado').val());
        let maximoSelecionado = parseInt($(this).find('.max-selecinado').val());
        
        let itemCheck = $(this).find('.item-marcado');

        let contabilizador = 0;
        let documentReadyExecuted = false;

        function forSU() {
            if (!documentReadyExecuted) {
                return; // Evita a execução da lógica se o document ready não foi totalmente executado
            }

            $('.adicionar-produto').hide();

            if($(this).is(':checked')) {
                if (contabilizador < minimoSelecionado) {
                    contabilizador += 1;
                } else {
                    if (contabilizador < maximoSelecionado) {
                        contabilizador += 1;
                    } else {
                        let valorItem = parseFloat($(this).closest('.opcoes-complemento').find('.valor-item').text().replace('+' , '').trim());
                        let valorProduto = parseFloat($('.adicionar-produto p').text().replace('R$', '').trim());
                        $(this).prop('checked', false);
                        $('.adicionar-produto p').text('R$' + (valorProduto - valorItem).toFixed(2));
                    }
                }
            } else {
                contabilizador -= 1;
            }

            if(contabilizador >= minimoSelecionado){
                $('.adicionar-produto').show();
            }
        }

        function forMO() {
            let quantidadeItemMO = 0;
            $('.adicionar-produto').hide();

            $('.diminuir-qtd-item, .aumentar-qtd-item').each(function () {
                let qtdItemMO = parseInt($(this).closest('.item-qtd').find('.qtd-atual-item').text());
                quantidadeItemMO += qtdItemMO / 2;
            });

            if(quantidadeItemMO >= minimoSelecionado){
                $('.adicionar-produto').show();
            }
        
            if (quantidadeItemMO < maximoSelecionado) {
                $('.aumentar-qtd-item').show();
            } else {
                $('.aumentar-qtd-item').hide();
            }
        }

        $(this).find('.diminuir-qtd-item, .aumentar-qtd-item').on('click', forMO);
        itemCheck.on('change', forSU);
        $(document).ready(function(){
            forMO();
            forSU();
            documentReadyExecuted = true;
        });
    });
}

