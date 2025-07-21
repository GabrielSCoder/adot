<?php

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK)
    {
        if ($arquivo['error'] === 0)
        {
            $arquivo = $_FILES['imagem'];
            $nomeArquivo = basename($arquivo['name']);
            $extensoesPermitidas = ['jpg', 'jpeg', 'png'];
            $extensaoArquivo = strtolower($nomeArquivo, PATHINFO_EXTENSION);
            $destino = 'imgs/' . $nomeArquivo;
    
            if (in_array($extensaoArquivo, $extensoesPermitidas))
            {
                $novoNome = uniqid() . "." . $extensaoArquivo;
                $caminho = $destino . $novoNome;
                
                if (move_uploaded_file($arquivo['tmp_name'], $destino))
                {
                    echo 'Upload realizado com sucesso!';                       
                } else 
                {
                    echo "erro";
                }
            }
        } else {
            echo "Erro no upload: " . $arquivo['error'];
        }
    }
}