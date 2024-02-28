<?php 
    require_once '../../config.php'; 
    require_once '../model/DAO/gestor/entregadao.php';
    require_once '../model/DAO/cardapio/carrinho/produtoCarrinhoDao.php'; 

    $entregaDao = new daoMySqlEntrega($pdo);
    $listarEntrega = $entregaDao->listar();

    $produtoCarrinhoDao = new daoMySqlProdutoCarrinho($pdo);
    $listarProdutoCarrinho = $produtoCarrinhoDao->listar();

    $valorTotalCompra = 0;

    foreach($listarProdutoCarrinho as $pc){
        $valorTotalProduto = $pc->getValor() * $pc->getQuantidade();
        $valorTotalCompra += $valorTotalProduto;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>./public/css/cardapio/finalizar.css">
    <title>Pagamento</title>
</head>
<body>
<div class="retornar">
    <a href="./carrinho.php">
        <i class="fa-solid fa-arrow-left"></i>
        <p>Voltar</p>
    </a>
</div><!--retornar-->

<h3 class="finalizar-titulo">Finalizar Pedido</h3>

<form action="../controller/gestor/pedido/adicionar.php" method="post" class="finalizar-info">

    <div class="dados-cliente-container">
        <div class="nome-cliente">
            <p>Qual o seu nome?</p>
            <input type="text" name="nome-cliente" placeholder="SEU NOME AQUI">
        </div>
        <div class="telefone-cliente">
            <p>Qual o seu telefone?</p>
            <input type="text" name="telefone-cliente" placeholder="(XX) XXXXX-XXXX">
        </div>
    </div><!--dados-cliente-container-->

    <h4 class="opcoes-entrega">Opções de Entrega:</h4>
    
    <div class="tipo-entrega">
        <input type="hidden" name="entrega-selecionado">
        <button type="button" class="btn-entrega inativo">
            <i class="fa-solid fa-box"></i>
            Entrega
        </button>
        <input type="hidden" name="retirar-selecionado">
        <button type="button" class="btn-retirar inativo">
            <i class="fa-solid fa-location-dot"></i>
            Retirar
        </button>
    </div><!--tipo-entrega-->

    <div class="endereco-container">
        <div class="ed-bairro">
            <p>Qual o seu Bairro?</p>
            <input type="hidden" name="nome-bairro-selecionado">
            <select name="valor-bairro-selecionado">
                <option value="bairro-desabilitado" disabled selected>Selecione um Bairro</option>
                <?php foreach($listarEntrega as $e): ?>
                <option value="<?= $e->getPreco(); ?>" class="valor-entrega"><?= $e->getNome(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="ed-rua">
            <p>Qual sua rua e número?</p>
            <div class="input-group">
                <input type="text" name="rua">
                <input type="number" name="numero-casa">
            </div>
        </div>
        <div class="ed-referencia">
            <p>Algum ponto de referência?</p>
            <input type="text" name="referencia">
        </div>
    </div><!--endereco-container-->

    <div class="pagamento-container">
        <div class="preco-container">
            <div class="preco-info" id="preco-compra">
                <input type="hidden" name="valor-compra" value="<?= $valorTotalCompra; ?>">
                <h5>Valor da Compra:</h5>
                <p>R$ <?php echo number_format($valorTotalCompra, 2, '.'); ?></p>
            </div>
            <div class="preco-info entrega">
                <h5>Valor da Entrega:</h5>
                <p>R$ 00.00</p>
            </div>
            <div class="preco-info" id="total">
                <h5>Valor Total:</h5>
                <p>R$ 15.00</p>
            </div>
        </div><!--preco-container-->

        <div class="tipo-pagamento">
            <div class="apresentacao-pagamento">
                <h4>Forma de pagamento:</h4>
                <h5></h5>
                <p></p>
            </div><!--apresentacao-pagamento-->
            <div class="escolha-pagamento">
                <input type="hidden" name="dinheiro-selecionado">
                <button type="button" class="btn-dinheiro inativo">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Dinheiro
                </button>
                <input type="hidden" name="cartao-selecionado">
                <button type="button" class="btn-cartao inativo">
                    <i class="fa-brands fa-cc-mastercard"></i>
                    Cartão
                </button>
            </div><!--escolha-pagamento-->
        </div><!--tipo-pagamento-->

        <div class="troco-dinheiro">
            <h4>Precisa de Troco?</h4>
            <div class="selecionar-troco">
                <div class="sem-troco">   
                    <label for="troco-nao">Não</label>
                    <input type="checkbox" class="troco-nao" name="sem-troco">
                </div><!--sem-troco-->
                
                <div class="com-troco">   
                    <label for="troco-sim">Sim</label>
                    <input type="checkbox" class="troco-sim" name="com-troco">
                </div><!--selecionar-troco-->
            </div><!--com-troco-->
        </div><!--troco-dinheiro-->
        
        <div class="tipo-cartao">
            <h4>Escolha como deseja pagar:</h4>
            <select name="tipo-cartao-selecionado">
                <option disabled selected>Selecione a forma que deseja</option>
                <option value="Debito">DEBITO</option>
                <option value="Credito">CREDITO</option>
            </select>
        </div>
    </div><!--pagamento-container-->

    <div class="quantidade-troco">
        <label for="valor-troco">Troco para quanto?</label>
        <input type="number" name="valor-troco">
    </div><!--quantidade-troco-->

</form><!--finalizar-info-->

<div class="separador"></div>

<div class="concluir-pedido">
    <button class="concluir">
        <i class="fa-solid fa-circle-check"></i>
        Concluir Pedido
    </button>
</div>

<script src="https://kit.fontawesome.com/ea49bb39e4.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="module" src="../../public/js/cardapio.js"></script>
</body>
</html>