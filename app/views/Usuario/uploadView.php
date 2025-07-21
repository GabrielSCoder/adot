<div>
    <form method="POST" action="adot/app/core/Upload.php" enctype="multipart/form-data">
        <input type="file" name="imagem" id="imagem" accept="image/*" required />
        <input type="submit" value="confirmar" />
        <br />
        <img id="preview" src="" alt="pre-visualização"
            style="max-width: 200px; display: none; border: 1px solid #ccc;">
    </form>
</div>