<?php 
    
    require __DIR__ . '/../../class/gestor/usuario.php';

    class daoMysqlUsuario implements UsuarioDAO{
        private $pdo;

        public function __construct(PDO $drive)
        {
            $this->pdo = $drive;
        }

        public function logar($nome, $senha){
            $sql = $this->pdo->prepare('SELECT * FROM usuario WHERE nome = :nome AND senha = :senha');
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':senha', $senha);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetch();

                $_SESSION['logado'] = $dados['id'];
                return true;
            } else {
                return false;
            }
        }

        public function logout(){
            session_destroy();
            header('Location: ../../../view/login.php');
            exit;
        }
    }

?>