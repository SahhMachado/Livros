<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idE= isset($_GET['idE']) ? $_GET['idE'] : 0;
        excluir($idE);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idE= isset($_POST['idE']) ? $_POST['idE'] : "";
        if ($idE== 0)
            inserir($idE);
        else
            editar($idE);
    }

    // Métodos para cada operação
    function inserir($idE){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO editora (nome, dataFundacao) VALUES(:nome, :dataFundacao)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $_POST['nome'];

        $stmt->bindParam(':dataFundacao', $dataFundacao, PDO::PARAM_STR);
        $dataFundacao = $_POST['dataFundacao'];
        $stmt->execute();
        header("location:readEditora.php");
    }

    function editar($idE){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE editora SET nome = :nome, dataFundacao = :dataFundacao
        WHERE idE= :idE');

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':dataFundacao', $dataFundacao, PDO::PARAM_STR);
        $stmt->bindParam(':idE', $idE, PDO::PARAM_INT);

        $nome = $dados['nome'];
        $dataFundacao = $dados['dataFundacao'];
        $idE= $dados['idE'];
        $stmt->execute();
        header("location:readEditora.php");
    }

    function excluir($idE){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from editora WHERE idE= :idE');
        $stmt->bindParam(':idE', $idE, PDO::PARAM_INT);
        $idE = $idE;
        $stmt->execute();
        header("location:readEditora.php");
    }

    // Busca um item pelo código no BD
    function buscarDados($idE){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM editora WHERE idE= $idE");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idE'] = $linha['idE'];
            $dados['nome'] = $linha['nome'];
            $dados['dataFundacao'] = $linha['dataFundacao'];
        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['idE'] = $_POST['idE'];
        $dados['nome'] = $_POST['nome'];
        $dados['dataFundacao'] = $_POST['dataFundacao'];
        return $dados;
    }

?>

