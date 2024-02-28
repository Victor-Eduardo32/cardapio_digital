<?php

$produtoDao = new daoMysqlProduto($pdo);
$listaProduto = $produtoDao->listar();

?>

<div class="conteudo-produtos">
    <div class="add-produtos">
        <h3>Adicionar produtos</h3>
        <a href="?url=produtos-add"><input type="button" value="Adicionar"></a>
    </div>
    <div class="produtos">
        <table>
            <thead>
                <tr>
                    <th class="id-produto">#</th>
                    <th class="titulo-imagem">Imagem</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Disponibilidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaProduto as $p) : ?>
                    <tr>
                        <td class="id-produto"><?= $p->getID(); ?></td>
                        <td class="imagem"><img src="<?= $p->getImagem(); ?>"></td>
                        <td><?= $p->getNome(); ?></td>
                        <td><?= $p->getNomeCategoria(); ?></td>
                        <td><?= $p->getDisponivel() == 1 ? 'Sempre Disponível' : $p->getHoraInicial() . ' a ' . $p->getHoraFinal(); ?></td>
                        <td class="botoes-produto">
                            <a href="?url=produtos-edit&id=<?= $p->getId(); ?>" class="acao-btn">
                                <input type="button" value="Editar" class="botao-produto editar">
                            </a>

                            <a href="../../controller/gestor/produto/inativarAtivar.php?id=<?= $p->getId(); ?>&ativo=<?= $p->getAtivo(); ?>" name="ativo" value="<?= $p->getAtivo(); ?>" class="acao-btn">
                                <?php
                                if ($p->getAtivo() == 1) {
                                    echo '<input type="button" value="Inativar" class="botao-produto inativar" name="item-ativo">';
                                } else {
                                    echo '<input type="button" value="Ativar" class="botao-produto ativar" name="item-inativo">';
                                }
                                ?>
                            </a>

                            <a href="../../controller/gestor/produto/excluir.php?id=<?= $p->getId(); ?>" onclick="return confirm('Deseja apagar o produto?')" class="acao-btn">
                                <input type="button" value="Excluir" class="botao-produto excluir">
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>