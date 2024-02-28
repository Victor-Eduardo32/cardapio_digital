export function selecionarBotao(){
    let btnEntrega = $('.btn-entrega');
    let btnRetirada = $('.btn-retirar');
    let btnDinheiro = $('.btn-dinheiro');
    let btnCartao = $('.btn-cartao');

    mostrarSelecionado(btnEntrega, btnRetirada);
    mostrarSelecionado(btnRetirada, btnEntrega);
    mostrarSelecionado(btnDinheiro, btnCartao);
    mostrarSelecionado(btnCartao, btnDinheiro);

    function mostrarSelecionado(btnClicado, btnDesativado){
        btnClicado.on('click', function(){
            if($(this).hasClass('inativo')){
                if(btnDesativado.hasClass('ativo')){
                    btnDesativado.removeClass('ativo').addClass('inativo')
                }
    
                $(this).removeClass('inativo').addClass('ativo');
            } else {
                $(this).removeClass('ativo').addClass('inativo');
            }
        });
    }
}

export function mostrarDados(){
    let btnEntrega = $('.btn-entrega');
    let btnRetirada = $('.btn-retirar');

    let enderecoContainer = $('.endereco-container');
    let pagamentoContainer = $('.pagamento-container');

    let localPagamento = $('.apresentacao-pagamento h5');
    let realizarPagamento = $('.apresentacao-pagamento p');

    btnEntrega.on('click', function(){
        if(btnEntrega.hasClass('ativo')){
            enderecoContainer.css('display', 'block');
            pagamentoContainer.css('display', 'block');

            localPagamento.text('Pagar na Entrega');
            realizarPagamento.text('Realize o pagamento na Entrega');
        } else {
            enderecoContainer.css('display', 'none');
            pagamentoContainer.css('display', 'none');
        }
    })

    btnRetirada.on('click', function(){
        if(btnRetirada.hasClass('ativo')){
            if(btnEntrega.hasClass('inativo')){
                enderecoContainer.css('display', 'none');
            }
            pagamentoContainer.css('display', 'block');

            localPagamento.text('Pagar no Balcão');
            realizarPagamento.text('Realize o pagamento no Balcão');
        } else {
            pagamentoContainer.css('display', 'none');
        }
    })
}

export function alterarValorEntrega(){
    $('.ed-bairro select').on('change',function(){
        let valorEntrega = parseFloat($(this).val()).toFixed(2);

        $('.entrega p').text('R$ ' + valorEntrega);
        $(this).find('option[value="bairro-desabilitado"]').remove();
    })
}

export function alterarValorTotal(){
    let btnEntrega = $('.btn-entrega');
    let btnRetirada = $('.btn-retirar');

    function valorNaEntrega(){
        let bairroSelecionado = $('.ed-bairro select');
        let valorCompra = parseFloat($('#preco-compra p').text().replace('R$', '').trim());
        
        btnEntrega.on('click', function(){
            $('.entrega').css('display', 'flex');

            let valorEntrega = parseFloat($('.entrega p').text().replace('R$', '').trim());
            $('#total p').text('R$ ' + (valorCompra + valorEntrega).toFixed(2));
            
            if(btnEntrega.hasClass('ativo')){
                bairroSelecionado.on('change', function(){
                    let valorEntrega = parseFloat($('.entrega p').text().replace('R$', '').trim());
                    $('#total p').text('R$ ' + (valorCompra + valorEntrega).toFixed(2));
                });
            }
        });
    }

    function valorNaRetirada(){
        btnRetirada.on('click', function(){
            if(btnRetirada.hasClass('ativo')){
                let valorCompra = $('#preco-compra p').text();
    
                $('.entrega').css('display', 'none');
                $('#total p').text(valorCompra);
            }
        });
    }

    valorNaEntrega();
    valorNaRetirada();
}

export function mostrarPagamento(){
    let btnDinheiro = $('.btn-dinheiro');
    let btnCartao = $('.btn-cartao');

    let trocoDinheiro = $('.troco-dinheiro');
    let tipoCartao = $('.tipo-cartao');

    let qtdTroco = $('.quantidade-troco');

    btnDinheiro.on('click', function(){
        if(btnDinheiro.hasClass('ativo')){
            if(btnCartao.hasClass('inativo')){
                tipoCartao.css('display', 'none');
            }

            if ($('.troco-sim').is(':checked')) {
                qtdTroco.css('display', 'flex');
            }

            trocoDinheiro.css('display', 'block');
        } else {
            trocoDinheiro.css('display', 'none');
        }
    });

    btnCartao.on('click', function(){
        if(btnCartao.hasClass('ativo')){
            if(btnDinheiro.hasClass('inativo')){
                trocoDinheiro.css('display', 'none');
                qtdTroco.css('display', 'none');
            }

            tipoCartao.css('display', 'block');
        } else {
            tipoCartao.css('display', 'none');
        }
    });
}

export function verificacaoTroco() {
    let semTroco = $('.troco-nao');
    let comTroco = $('.troco-sim');
    let qtdTroco = $('.quantidade-troco');

    semTroco.on('change', function () {
        if (semTroco.is(':checked')) {
            qtdTroco.css('display', 'none');
            comTroco.prop('checked', false);
        }
    });

    comTroco.on('change', function () {
        if (comTroco.is(':checked')) {
            qtdTroco.css('display', 'flex');
            semTroco.prop('checked', false);
        }
    });
}

export function armazenarTipoEntrega(){
    let btnEntrega = $('.btn-entrega');
    let btnRetirada = $('.btn-retirar');

    function armazenado(){
        if(btnEntrega.hasClass('ativo')){
            $('[name=entrega-selecionado]').val(1);
        } else {
            $('[name=entrega-selecionado]').val(0);
        }

        if(btnRetirada.hasClass('ativo')){
            $('[name=retirar-selecionado]').val(1);
        } else {
            $('[name=retirar-selecionado]').val(0);
        }
    }
    
    btnEntrega.on('click', armazenado);
    btnRetirada.on('click', armazenado);
}

export function armazenarTipoPagamento(){
    let btnDinheiro = $('.btn-dinheiro');
    let btnCartao = $('.btn-cartao');

    function armazenado(){
        if(btnDinheiro.hasClass('ativo')){
            $('[name=dinheiro-selecionado]').val(1);
        } else {
            $('[name=dinheiro-selecionado]').val(0);
        }

        if(btnCartao.hasClass('ativo')){
            $('[name=cartao-selecionado]').val(1);
        } else {
            $('[name=cartao-selecionado]').val(0);
        }
    }
    
    btnDinheiro.on('click', armazenado);
    btnCartao.on('click', armazenado);
}

export function armazenarBairro(){
    $('.ed-bairro select').on('change', function(){
        let nomeBairro = $(this).find(':selected').text();

        $('[name=nome-bairro-selecionado]').val(nomeBairro);
    });
}

export function formSubmitFinalizar(){
    $('.concluir-pedido').on('click', function(){
        $('form').submit();
    });
}

export function formatarCliente(){
    $('.telefone-cliente input').mask("(99) 99999-9999");
}