<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idL= isset($_GET['idL']) ? $_GET['idL'] : 0;
        excluir($idL);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $idL= isset($_POST['idL']) ? $_POST['idL'] : "";
        if ($idL== 0)
            inserir($idL);
        else
            editar($idL);
    }

    // Métodos para cada operação
    function inserir($idL){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO livro (titulo, genero, anoPublicacao, autor, valor, idE) VALUES(:titulo, :genero, :anoPublicacao, :autor, :valor, :idE)');
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $titulo = $_POST['titulo'];

        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $genero = $_POST['genero'];

        $stmt->bindParam(':anoPublicacao', $anoPublicacao, PDO::PARAM_STR);
        $anoPublicacao = $_POST['anoPublicacao'];

        $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
        $autor = $_POST['autor'];

        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $valor = $_POST['valor'];

        $stmt->bindParam(':idE', $idE, PDO::PARAM_STR);
        $idE = $_POST['idE'];
        $stmt->execute();
        header("location:readLivro.php");
    }

    function editar($idL){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE livro SET titulo = :titulo, genero = :genero, anoPublicacao =: :anoPublicacao, autor = : autor, 
        valor = :valor, idE = :idE WHERE idL= :idL');

        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stmt->bindParam(':anoPublicacao', $anoPublicacao, PDO::PARAM_STR);
        $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':idE', $idE, PDO::PARAM_STR);
        $stmt->bindParam(':idL', $idL, PDO::PARAM_INT);

        $titulo = $dados['titulo'];
        $genero = $dados['genero'];
        $anoPublicacao = $dados['anoPublicacao'];
        $autor = $dados['autor'];
        $valor = $dados['valor'];
        $idE = $dados['idE'];
        $idL= $dados['idL'];
        $stmt->execute();
        header("location:readLivro.php");
    }

    function excluir($idL){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from livro WHERE idL= :idL');
        $stmt->bindParam(':idL', $idL, PDO::PARAM_INT);
        $idL = $idL;
        $stmt->execute();
        header("location:readLivro.php");
    }

    // Busca um item pelo código no BD
    function buscarDados($idL){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM livro WHERE idL= $idL");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idL'] = $linha['idL'];
            $dados['titulo'] = $linha['titulo'];
            $dados['genero'] = $linha['genero'];
            $dados['anoPublicacao'] = $linha['anoPublicacao'];
            $dados['autor'] = $linha['autor'];
            $dados['valor'] = $linha['valor'];
            $dados['idE'] = $linha['idE'];
        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['idL'] = $_POST['idL'];
        $dados['titulo'] = $_POST['titulo'];
        $dados['genero'] = $_POST['genero'];
        $dados['anoPublicacao'] = $_POST['anoPublicacao'];
        $dados['autor'] = $_POST['autor'];
        $dados['valor'] = $_POST['valor'];
        $dados['idE'] = $_POST['idE'];
        return $dados;
    }

?>

