<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastrar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Cadastre-se</title>
</head>
<body>
    <div id="cadastrar">
        <form method="POST" enctype="multipart/form-data">
        <br>
        <img src="../img/logo.png" alt="" width="90px">

        <h1 style="color: #FFFFFF;" class="text-center"><b>
            Cadastro
        </b></h1>
        <div id="fotodeperfil">
            <img src="../img/perfil.png" alt="" id="image">
            <div id="add">
   
                <input type="file" name="img" id="img" accept=".jpg, .jpeg, .png">
                <i id="camera"><p style="text-align: center; font-size: 60px; color: white; margin-right: 3px; margin-top: 5px; cursor: pointer;">+</p></i>
            </div>
        </div>
        <p class="fs-4 text-center">Nome Completo</p>
        <input type="text" name="nome" id="nome">
        <br>
        <p class="fs-4 text-center">CPF</p>
        <input type="cpf" name="cpf" id="cpf">
        <br>

        <p class="fs-4 text-center">E-mail</p>
        <input type="email" name="email" id="email">
        <br>
        <p class="fs-4 text-center">Senha</p>
        <input type="password" name="senha" id="senha">
        <br>
        
        <button id="button" name="button" type="submit">Cadastrar</button>
        </form>
    </div>

    
    <?php
    session_start();

    require_once "../model/Usuario.php";
    require_once "../configs/utils.php";
    require_once "../configs/methods.php";


    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["cpf", "nome", "email", "senha"])) {
    
            $cpf = $_POST["cpf"];
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            print_r( $_FILES["img"]);
            // Verifica se o arquivo foi carregado corretamente
            if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
                $img = $_FILES["img"]["name"];
                $img_temp = $_FILES["img"]["tmp_name"];
    
                // Define o caminho para onde a imagem será movida
                $caminhoDestino = "../arquivos/" . $img;
    
                // Move o arquivo para o caminho de destino
                if (move_uploaded_file($img_temp, $caminhoDestino)) {
                    if (!Usuario::existeUsuarioEmail($email)) {
                        if (Usuario::cadastrar($cpf, $nome, $email, $senha, $caminhoDestino)) {
                            header("Location: login.php");
                            exit; // Importante: encerrar o script após redirecionamento
                        } else {
                            echo "<p>Cadastro não pode ser realizado!</p>";
                        }
                    } else {
                        echo "<p>Usuário já existe!</p>";
                    }
                } else {
                    echo "<p>Ocorreu um erro ao carregar a imagem.</p>";
                }
            } else {
                $caminhoDestino = "../img/perfil.png" ;
                if (!Usuario::existeUsuarioEmail($email)) {
                    if (Usuario::cadastrar($cpf, $nome, $email, $senha, $caminhoDestino)) {
                        header("Location: login.php");
                        exit;
                    echo "<p>Erro no upload do arquivo.</p>";
                }
            }
        }
    }
}
?>
<script type="text/javascript">
      document.getElementById("img").onchange = function(){
        document.getElementById("image").src = URL.createObjectURL(this.files[0]); // Preview new image
      }
</script>

</body>
</html>