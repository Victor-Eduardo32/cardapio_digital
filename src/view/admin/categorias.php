<?php

$categoria = new daoMysqlCategoria($pdo);
$lista = $categoria->listar();

?>


<div class="conteudo-categorias">
    <div class="add-categorias">
        <h3>Adicionar categorias</h3>
        <a href="?url=categoria-add"><input type="button" value="Adicionar" class="adicionar-categoria"></a>
    </div><!--add-categorias-->

    <div class="categorias">
        <table>
            <thead>
                <tr>
                    <th class="id-categoria">#</th>
                    <th>Nome</th>
                    <th>Ordem</th>
                    <th>Disponibilidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lista as $c) :
                ?>
                    <tr>
                        <td class="id-categoria"><?= $c->getID(); ?></td>
                        <td><?= $c->getNome(); ?></td>
                        <td><?= $c->getOrdem(); ?></td>
                        <td><?= $c->getDisponivel() == 1 ? 'Sempre Disponivel' : $c->getHoraInicial() . ' a ' . $c->getHoraFinal(); ?></td>
                        <td class="botoes-categoria">
                            <a href="?url=categoria-edit&id=<?= $c->getId(); ?>" class="acao-btn">
                                <input type="button" value="Editar" class="botao-categoria editar">
                            </a><!--Botão de Editar a Categoria-->

                            <a href="../../controller/gestor/categoria/inativarAtivar.php?id=<?= $c->getId() ?>&ativo=<?= $c->getAtivo(); ?>" class="acao-btn" value='<?= $c->getAtivo(); ?>' name="ativo">
                                <?php
                                if ($c->getAtivo() == 1) {
                                    echo '<input type="button" value="Inativar" class="botao-categoria inativar" id="inativarAtivar">';
                                } else {
                                    echo '<input type="button" value="Ativar" class="botao-categoria ativar" id="inativarAtivar">';
                                }
                                ?>
                            </a><!--Botão de Ativar/Inativar a Categoria-->

                            <a href="../../controller/gestor/categoria/deletar.php?id=<?= $c->getId() ?>" onclick="return confirm('Deseja Excluir? (Todos os produtos incluídos nela também serão excluídos)')" class="acao-btn">
                                <input type="button" value="Excluir" class="botao-categoria excluir">
                            </a><!--Botão de Excluir a Categoria-->
                        </td>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>
    </div><!--confirmar-excluir-->
</div><!--categorias-->
</div><!--conteudo-categorias-->