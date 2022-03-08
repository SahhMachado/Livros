<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Procurar Usuários";
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
        <legend>Procurar Usuário</legend>
        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        <table border="1">
	    <tr class="tr">
            <td><b>ID</b></td>
            <td><b>Nome</b></td>
            <td><b>Data de Nascimento</b></td>
            <td><b>Email</b></td>
            <td><b>Senha</b></td>
            <td><b>Telefone</b></td>
            <td><b>Alterar</b></td>
            <td><b>Excluir</b></td>
            
        </tr>
        <legend>Procurar por:</legend>
           <input type="radio" id="1" name="cnst" value="1" <?php if($cnst == 1) echo "checked" ?>>ID<br>
           <input type="radio" id="2" name="cnst" value="2" <?php if($cnst == 2) echo "checked" ?>>Nome<br>
        </fieldset>
        <br>
        <?php 
            $pdo = Conexao::getInstance();

            if($cnst == 1) {
                $consulta = $pdo->query("SELECT * FROM usuario
                                        WHERE idU LIKE '$procurar%' 
                                        ORDER BY idU");
    
            }else if($cnst == 2) {
                $consulta = $pdo->query("SELECT * FROM usuario
                                        WHERE nome LIKE '$procurar%' 
                                        ORDER BY nome");  
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
        ?>
	    <tr>
            <td><?php echo $linha['idU'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['dataNascimento']));?></td>
            <td><?php echo $linha['email'];?></td>
            <td><?php echo $linha['senha'];?></td>
            <td><?php echo $linha['telefone'];?></td>
            <td><a href='createUsuario.php?acao=editar&idU=<?php echo $linha['idU'];?>'>
            <img class="icon" src="img/edit.svg"></a></td>
            <td><?php echo "<a href=javascript:excluirRegistro('acao.php?acao=excluir&idU={$linha['idU']}')>
            <img src='img/excluir.svg' class='icon'></a><br>";?></td>
	    </tr>
            <?php } ?>       
        </table>
    </fieldset>
    </form>
</body>
</html>