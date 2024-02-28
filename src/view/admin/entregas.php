<?php

$entregaDao = new daoMySqlEntrega($pdo);
$listar = $entregaDao->listar();

?>

<div class="conteudo-entregas">
    <div class="add-entregas">
        <h3>Adicionar Bairro</h3>
        <a href="?url=entregas-add"><input type="button" value="Adicionar" class="adicionar-entregas"></a>
    </div><!--add-categorias-->

    <div class="entregas">
        <table>
            <thead>
                <tr>
                    <th class="id-entrega">#</th>
                    <th class="nome-bairro">Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listar)) : ?>
                    <?php foreach ($listar as $e) : ?>
                        <tr>
                            <td class="id-entrega"><?= $e->getId(); ?></td>
                            <td class="nome-bairro"><?= $e->getNome(); ?></td>
                            <td><?= $e->getPreco(); ?></td>
                            <td class="botoes-entrega">
                                <a href="?url=entregas-edit&id=<?= $e->getId(); ?>" class="acao-btn">
                                    <input type="button" value="Editar" class="botao-entrega editar">
                                </a><!--Botão de Editar a Categoria-->

                                <a href="../../controller/gestor/entrega/excluir.php?id=<?= $e->getId(); ?>" class="acao-btn" onclick="return confirm('Deseja excluir a entrega?')">
                                    <input type="button" value="Excluir" class="botao-entrega excluir">
                                </a><!--Botão de Excluir a Categoria-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div><!--confirmar-excluir-->
</div><!--categorias-->
</div><!--conteudo-categorias-->