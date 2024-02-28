<?php

$complementoDao = new daoMysqlComplemento($pdo);
$lista = $complementoDao->listar();

?>

<div class="conteudo-complementos">
    <div class="add-complemento">
        <h3>Adicionar produtos</h3>
        <a href="?url=complemento-add"><input type="button" value="Adicionar"></a>
    </div>

    <div class="complementos">
        <table>
            <thead>
                <tr>
                    <th class="id-complemento">#</th>
                    <th class="nome-complemento">Nome</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $c) : ?>
                    <tr>
                        <td class="id-complemento"><?= $c->getID(); ?></td>
                        <td class="nome-complemento"><?= $c->getNome(); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($c->getDate())); ?></td>
                        <td class="botoes-complemento">
                            <a href="?url=complemento-edit&id=<?= $c->getId(); ?>">
                                <input type="button" value="Editar" class="botao-complemento editar">
                            </a>
                            <a href="../../controller/gestor/complemento/duplicar.php?id=<?= $c->getId(); ?>">
                                <input type="button" value="Duplicar" class="botao-complemento duplicar">
                            </a>
                            <a href="../../controller/gestor/complemento/excluir.php?id=<?= $c->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir esse complemento?')">
                                <input type="button" value="Excluir" class="botao-complemento excluir">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>