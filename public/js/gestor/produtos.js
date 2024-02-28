export function ativarComplemento(){
    $('.editar-produto').on('click', function(){
        $('.check-complemento').each(function() {
            var complemento = $(this).closest('.complemento');
            var inputComplementoAtivo = complemento.find('input[name="complemento-ativo[]"]');
    
            inputComplementoAtivo.val(this.checked ? 1 : 0); 
        });
    });
}
