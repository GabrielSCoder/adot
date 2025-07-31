<div>
    <form method="POST" action="<?= $action ?>" enctype="multipart/form-data" onsubmit="return validarArquivos()">
        <input type="file" name="imagem" id="imagem" accept="image/*" multiple required />
        <input type="submit" value="confirmar" />
        <br />
        <div style="display: flex; gap: 10px;">
            <div style="position: relative; display: none;" id="pv_div_1">
                <img id="preview" src="" alt="pre-visualização" style="max-width: 400px; border: 1px solid #ccc;">
                <p id="del_preview1" style="position: absolute; top: 2px; right: 10px; color: red; cursor: pointer">X
                </p>
            </div>
            <div style="position: relative; display: none;" id="pv_div_2">
                <img id="preview2" src="" alt="pre-visualização" style="max-width: 400px; border: 1px solid #ccc;">
                <p id="del_preview2" style="position: absolute; top: 2px; right: 10px; color: red; cursor: pointer;">X
                </p>
            </div>
        </div>
    </form>
    <p>
        <?= $msg ?? ''?>
    </p>
</div>