import { alterarQtdProduto, alterarQtditem, alterarValorProduto, formSubmitAddProduto, armazenarQuantidadeProduto, armazenarQuantidadeItem, limiteComplemento } from "./cardapio/addProduto.js";
import { changeSlider, initSlider } from "./cardapio/banner.js";
import { selecionarBotao, mostrarDados, mostrarPagamento, verificacaoTroco, alterarValorEntrega, alterarValorTotal, formSubmitFinalizar, armazenarTipoPagamento, armazenarTipoEntrega, formatarCliente, armazenarBairro } from "./cardapio/finalizar.js";

// Adicionar Produto
alterarQtdProduto();
alterarQtditem();
alterarValorProduto();
formSubmitAddProduto();
armazenarQuantidadeProduto();
armazenarQuantidadeItem();
limiteComplemento();

// Finalizar Pedido
selecionarBotao();
mostrarDados();
mostrarPagamento();
verificacaoTroco();
alterarValorEntrega();
alterarValorTotal();
formSubmitFinalizar();
armazenarTipoPagamento();
armazenarTipoEntrega();
formatarCliente();
armazenarBairro();

// Banners
initSlider();
changeSlider();
