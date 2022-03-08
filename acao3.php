<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idC= isset($_GET['idC']) ? $_GET['idC'] : 0;
        excluir($idC);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idC= isset($_POST['idC']) ? $_POST['idC'] : "";
        if ($idC== 0)
            inserir($idC);
        else
            editar($idC);
    }

    // Métodos para cada operação
    function inserir($idC){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO compra (descricao, dataCompra, idU) VALUES(:descricao, :dataCompra, :idU)');
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $descricao = $_POST['descricao'];

        $stmt->bindParam(':dataCompra', $dataCompra, PDO::PARAM_STR);
        $dataCompra = $_POST['dataCompra'];

        $stmt->bindParam(':idU', $idU, PDO::PARAM_STR);
        $idU = $_POST['idU'];
        $stmt->execute();
        header("location:readCompra.php");
    }

    function editar($idC){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE compra SET descricao = :descricao, dataCompra = :dataCompra, idU = :idU
        WHERE idC= :idC');

        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':dataCompra', $dataCompra, PDO::PARAM_STR);
        $stmt->bindParam(':idU', $idU, PDO::PARAM_STR);
        $stmt->bindParam(':idC', $idC, PDO::PARAM_INT);

        $descricao = $dados['descricao'];
        $dataCompra = $dados['dataCompra'];
        $idU = $dados['idU'];
        $idC= $dados['idC'];
        $stmt->execute();
        header("location:readCompra.php");
    }

    function excluir($idC){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from compra WHERE idC= :idC');
        $stmt->bindParam(':idC', $idC, PDO::PARAM_INT);
        $idC = $idC;
        $stmt->execute();
        header("location:readCompra.php");
    }

    // Busca um item pelo código no BD
    function buscarDados($idC){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM compra WHERE idC= $idC");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idC'] = $linha['idC'];
            $dados['descricao'] = $linha['descricao'];
            $dados['dataCompra'] = $linha['dataCompra'];
            $dados['idU'] = $linha['idU'];
        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['idC'] = $_POST['idC'];
        $dados['descricao'] = $_POST['descricao'];
        $dados['dataCompra'] = $_POST['dataCompra'];
        $dados['idU'] = $_POST['idU'];
        return $dados;
    }

?>

