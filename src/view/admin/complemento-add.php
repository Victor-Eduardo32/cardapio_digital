<a href="?url=complementos" class="retornar-add-complemento">
    <i class="fa-solid fa-arrow-left"></i>
    <p>Voltar</p> 
</a><!--retornar-->

<form class="campos-dados-complemento" action="../../controller/gestor/complemento/adicionar.php" method="post">
    
    <h4>Adicionar Complemento</h4>
    <div class="form-group-complemento">
        <label for="nome-complemento" class="form-label">Nome</label>
        <input type="text" name="nome-complemento" class="form-input nome-produto" placeholder="Nome" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="descricao-complemento" class="form-label">Descricao</label>
        <input type="text" name="descricao-complemento" class="form-input descricao-produto" placeholder="Descrição" require>
    </div><!--form-group-categoria-->
    <div class="form-group-complemento">
        <label for="min-selecionavel-complemento" class="form-label">Mínimo Selecionavel</label>
        <input type="number" name="min-selecionavel-complemento" class="form-input min-selecionavel" placeholder="Mínimo Selecionavel" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="max-selecionavel-complemento" class="form-label">Máximo Selecionavel</label>
        <input type="number" name="max-selecionavel-complemento" class="form-input max-selecionavel" placeholder="Máximo Selecionavel" require>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="tipo-complemento" class="form-label">Tipo de Complemento</label>
        <Select class="form-input" name="tipo-complemento">
            <option value="1">Seleção Única</option>
            <option value="2">Multíplas Opções -/+</option>
        </Select>
    </div><!--form-group-produto-->
    <div class="form-group-complemento">
        <label for="tipo-cobrar" class="form-label">Cobrar maior valor entre as opções selecionadas?</label>
        <Select class="form-input" name="valor-maior">
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </Select>
    </div><!--form-group-produto-->
    <p>Adicione itens a esse complemento</p>
    <div class="corpo-itens">
        <div class="item">
            <div class="campo-item">
                <div class="form-group-complemento">
                    <label for="nome-item" class="form-label">Nome do Complemento</label>
                    <input type="text" name="nome-item[]" class="form-input nome-produto" placeholder="Nome do Complemento" require>
                </div><!--form-group-produto-->
                <div class="form-group-complemento">
                    <label for="descricao-item" class="form-label">Descrição do Complemento</label>
                    <input type="text" name="descricao-item[]" class="form-input descricao-produto" placeholder="Descrição do Complemento" require>
                </div><!--form-group-categoria-->
                <div class="form-group-complemento">
                    <label for="valor-item" class="form-label">Valor do Complemento</label>
                    <input type="number" name="valor-item[]" class="form-input min-selecionavel" placeholder="Valor do Complemento" require>
                </div><!--form-group-produto-->
            </div><!--campo-item-->
            
            <div class="remover-item">
                <input type="button" value="Remover" class="remover-complemento">
            </div><!--remover-item-->
        </div><!--item-->

        <div class="separador-complemento"></div>
    </div><!--corpo-itens-->
    <div class="adicionar-novo-complemento">
        <input type="button" value="Adicionar Complemento" class="adiciona-complemento">
    </div>
    
    <input type="submit" value="Criar Complemento" class="criar-complemento"> 
</form>