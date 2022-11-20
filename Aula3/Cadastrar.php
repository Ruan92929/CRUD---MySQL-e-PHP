<?php
include_once './conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
</head>
<body>
        <h1>Cadastrar</h1>
        <?php
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($dados['cadUsuario'])){
                
                //E possível utilizar este método para coletar os dados, no entanto abaixo segue o modelo correto.
            //   $query_usuario = "INSERT INTO usuarios (nome, email) VALUES ('". $dados['nome']."', '".$dados['email']."')";
            $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email) ";

           $cad_usuario = $conn->prepare($query_usuario); //Este método é feito através de link abaixo é necessário fazer a PARTE 2;

            //Parte 2;
            $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);

             $cad_usuario->execute();

             if($cad_usuario->rowCount()){
                echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
             } else{
                echo "<p style='color:red;'>Erro: Usuário não cadastrado!</p>";
             }
            }

        ?>
        <form name="cad-usuario" method="POST" action="">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome Completo" > <br><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="E-mail" > <br><br>

            <input type="Submit" value="Cadastrar" name="cadUsuario">
        </form>
</body>
</html>