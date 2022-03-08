<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
        excluir($idU);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idU = isset($_POST['idU']) ? $_POST['idU'] : "";
        if ($idU == 0)
            inserir($idU);
        else
            editar($idU);
    }

    // Métodos para cada operação
    function inserir($idU){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO usuario (nome, dataNascimento, email, senha, telefone) 
        VALUES(:nome, :dataNascimento, :email, :senha, :telefone)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $_POST['nome'];

        $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
        $dataNascimento = $_POST['dataNascimento'];

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $email = $_POST['email'];

        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $senha = $_POST['senha'];

        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $telefone = $_POST['telefone'];
        $stmt->execute();
        header("location:readUsuario.php");
    }

    function editar($idU){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, dataNascimento = :dataNascimento, 
        email = :email, senha = :senha, telefone = :telefone WHERE idU = :idU');

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':idU', $idU, PDO::PARAM_INT);

        $nome = $dados['nome'];
        $dataNascimento = $dados['dataNascimento'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $telefone = $dados['telfone'];
        $idU = $dados['idU'];
        $stmt->execute();
        header("location:readUsuario.php");
    }

    function excluir($idU){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from usuario WHERE idU = :idU');
        $stmt->bindParam(':idU', $idU, PDO::PARAM_INT);
        $idU = $idU;
        $stmt->execute();
        header("location:readUsuario.php");
    }

    // Busca um item pelo código no BD
    function buscarDados($idU){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM usuario WHERE idU = $idU");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idU'] = $linha['idU'];
            $dados['nome'] = $linha['nome'];
            $dados['dataNascimento'] = $linha['dataNascimento'];
            $dados['email'] = $linha['email'];
            $dados['senha'] = $linha['senha'];
            $dados['telefone'] = $linha['telefone'];
        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['idU'] = $_POST['idU'];
        $dados['nome'] = $_POST['nome'];
        $dados['dataNascimento'] = $_POST['dataNascimento'];
        $dados['email'] = $_POST['email'];
        $dados['senha'] = $_POST['senha'];
        $dados['telefone'] = $_POST['telefone'];
        return $dados;
    }

?>

