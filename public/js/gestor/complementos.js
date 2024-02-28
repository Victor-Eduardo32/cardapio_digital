export function adicionarItem(){
    $('.adiciona-complemento').on('click', function(){
        let ultimoItem = $('.corpo-itens:last');
        let novoItem = ultimoItem.clone();

        novoItem.find('[nome="nome-item"]').attr('name', 'nome-item[]');
        novoItem.find('[nome="descricao-item"]').attr('name', 'descricao-item[]');
        novoItem.find('[nome="valor-item"]').attr('name', 'valor-item[]');
        
        novoItem.find('[name="id-item[]"]').val('');
        novoItem.find('[name="nome-item[]"]').val('');
        novoItem.find('[name="descricao-item[]"]').val('');
        novoItem.find('[name="valor-item[]"]').val('');
        novoItem.find('[name="inativo-complemento[]"]').val('');

        ultimoItem.after(novoItem);
    })
}

export function apagarItem() {
    let itensRemovidos = [];

    $(document).on('click', '.remover-complemento', function () {
        let item = $(this).closest('.corpo-itens');
        let IdsItemRemovido = item.find('[name="id-item[]"]').val();

        if ($('.corpo-itens').length > 1) {
            item.remove();
            // Adiciona o ID do item removido ao array
            itensRemovidos.push(IdsItemRemovido);
        } else {
            item.find('[name="nome-item[]"]').val('');
            item.find('[name="descricao-item[]"]').val('');
            item.find('[name="valor-item[]"]').val('');
            item.find('[name="inativo-complemento[]"]').val('');
        }

        // Atualiza o campo id-item-removido com o array de IDs
        $('[name="id-item-removido[]"]').val(itensRemovidos.join(',')); // Transforma o array em uma string separada por vírgulas
    });
}

export function inativarAtivar() {
    let itensAtivos = [];
    let valorAtivos = [];

    $(document).on('click', '.inativar-ativar-complemento', function () {
        let item = $(this).closest('.corpo-itens');
        let idItemAtivo = item.find('[name="id-item[]"]').val();
        let valorItemAtivo = item.find('[name="trocar-ativo-complemento[]"]').val();

        let novoValorAtivo = (valorItemAtivo == 1) ? 0 : 1;

        $(this).toggleClass('inativar ativar').attr('value', (novoValorAtivo == 1) ? 'Inativar' : 'Ativar');

        item.find('[name="trocar-ativo-complemento[]"]').val(novoValorAtivo);

        itensAtivos.push(idItemAtivo);
        valorAtivos.push(novoValorAtivo);

        $('[name="inativo-complemento[]"]').val(itensAtivos.join(','));
        $('[name="valor-ativo-complemento[]"]').val(valorAtivos.join(','));
    });
}
