import { abrirContainerPedido, calcularValorFinal } from './gestor/pedidos.js';
import { ativarComplemento } from './gestor/produtos.js';
import { adicionarItem, apagarItem, inativarAtivar } from './gestor/complementos.js';
import { abrirDadosProduto, abrirDadosCliente } from './gestor/relatorios.js';
import { abrirNav } from './gestor/nav.js';

// Nevagação
abrirNav();

// Pedidos
abrirContainerPedido();
calcularValorFinal();

// Produtos
ativarComplemento();

// Complementos
adicionarItem();
apagarItem();
inativarAtivar();

// Relatórios
abrirDadosProduto();
abrirDadosCliente();
