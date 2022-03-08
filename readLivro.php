<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Procurar Livros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $cnst = isset($_POST["cnst"]) ? $_POST["cnst"] : "1";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
    body{
        background-color: lightcyan;
    }
    header{
        background-color: lightblue;
        padding-top: 20px;
        font-size: 20px;
    }
    form{
        margin: 20px;
    }
    td{
        padding-right: 20px;
    }
    .icon{
        width: 25px;
    }
    .tr{
        background-color: lightblue;
    }
    </style>
</head>
<body>
    <header>
        <nav>
            <strong><?php include_once "menu.php";?></strong>
        </nav>
    </header>
    <br><br>
    <form method="post">
        <legend>Procurar Livro</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table border="1">
	    <tr class="tr">
            <td><b>ID</b></td>
            <td><b>Título</b></td>
            <td><b>Gênero</b></td>
            <td><b>Ano de Publicação</b></td>
            <td><b>Autor</b></td>
            <td><b>Valor</b></td>
            <td><b>Editora</b></td>  
            <td><b>Alterar</b></td>
            <td><b>Excluir</b></td>
        </tr>
        <legend>Procurar por:</legend>
           <input type="radio" id="1" name="cnst" value="1" <?php if($cnst == 1) echo "checked" ?>>ID<br>
           <input type="radio" id="2" name="cnst" value="2" <?php if($cnst == 2) echo "checked" ?>>Título<br>
           <input type="radio" id="3" name="cnst" value="3" <?php if($cnst == 3) echo "checked" ?>>Genêro<br>
        </fieldset>
        <br>
        <?php 
            $pdo = Conexao::getInstance();

            if($cnst == 1) {
                $consulta = $pdo->query("SELECT * FROM livro
                                        WHERE idL LIKE '$procurar%' 
                                        ORDER BY idL");
    
            }else if($cnst == 2) {
                $consulta = $pdo->query("SELECT * FROM livro
                                        WHERE titulo LIKE '$procurar%' 
                                        ORDER BY titulo");  
            }
            else{
                $consulta = $pdo->query("SELECT * FROM livro
                                        WHERE genero LIKE '$procurar%' 
                                        ORDER BY genero"); 
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
        ?>
	    <tr>
            <td><?php echo $linha['idL'];?></td>
            <td><?php echo $linha['titulo'];?></td>
            <td><?php echo $linha['genero'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['anoPublicacao']));?></td>
            <td><?php echo $linha['autor'];?></td>
            <td><?php echo number_format($linha['valor'], 2, ',', '.');?></td>
            <td><?php echo $linha['idE'];?></td>
            <td><a href='createLivro.php?acao=editar&idL=<?php echo $linha['idL'];?>'>
            <img class="icon" src="img/edit.svg"></a></td>
            <td><?php echo "<a href=javascript:excluirRegistro('acao4.php?acao=excluir&idL={$linha['idL']}')>
            <img src='img/excluir.svg' class='icon'></a><br>";?></td>
	    </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>