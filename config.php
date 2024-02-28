<?php 

    session_start();

    $host = 'localhost';
    $banco = 'cardapio';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO('mysql:dbname='.$banco.";host=".$host,$user,$pass);
    } catch (PDOException $e) {
        die("Erro de conexão com o banco de dados: " . $e->getMessage());
    } catch (Exception $e) {
        die("Erro desconhecido: " . $e->getMessage());
    }
    
    define('INCLUDE_PATH', 'http://localhost/cardapio_digital/');

    $url = isset($_GET['url']) ? $_GET['url'] : 'pedidos';
    date_default_timezone_set('America/Sao_Paulo');

?>