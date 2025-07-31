<div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <h2 style="font-size: 2rem; color: #00CFFF; margin-bottom: 20px;">
        <?=isset($pet) ? 'Editar Pet' : 'Cadastrar Pet'?></h2>

    <form method="POST" action="<?=$action?>" enctype="multipart/form-data">
        <?php if (!empty($pet['id'])): ?>
        <input type="hidden" name="id" value="<?=$pet['id']?>">
        <input type="hidden" name="tutor_id" value="<?=$pet['tutor_id']?>">
        <input type="hidden" name="quadro_medico_id" value="<?=$pet['quadro_medico_id']?>">
        <input type="hidden" name="data_cadastro" value="<?=$pet['data_cadastro']?>">
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?=$pet['nome'] ?? ''?>" required>

                <label>Espécie</label>
                <select name="especie_id" required>
                    <option selected disabled style="color: gray;">Selecione...</option>
                    <?php foreach ($especies as $especie): ?>
                    <option value="<?= $especie['id']; ?>"
                        <?= (isset($pet['especie_id']) && $pet['especie_id'] == $especie['id']) ? 'selected' : '' ?>>
                        <?php echo $especie['nome']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="0" <?= (isset($pet['sexo']) && $pet['sexo'] == '0') ? 'selected' : '' ?>>Macho
                    </option>
                    <option value="1" <?= (isset($pet['sexo']) && $pet['sexo'] == '1') ? 'selected' : '' ?>>Fêmea
                    </option>
                </select>

                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento"
                    value="<?=$pet['data_nascimento'] ?? ''?>" required>

                <label>Tutor atual</label>
                <select name="tutor_id" required>
                    <option selected disabled style="color: gray;">Selecione...</option>
                    <?php foreach ($tutores as $tutor): ?>
                    <option value="<?= $tutor['id']; ?>"
                        <?= (isset($pet['tutor_id']) && $pet['tutor_id'] == $tutor['id']) ? 'selected' : '' ?>>
                        <?php echo $tutor['nome_completo']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>
                    Comentário
                </label>
                <textarea placeholder="Fale um pouco sobre o pet"
                    name="comentario"><?= $pet['comentario'] ?? '' ?></textarea>
                <Label>
                    Fotos (máx. 2)
                </Label>
                <input type="file" name="imagem[]" id="imagem" accept="image/*" multiple />
                <button style="padding: 5px; width: fit-content;" id="preview_btn_form" onclick=""
                    <?= empty($pet['imagem_url']) ? "hidden" : "" ?>>
                    Pre-visualizacao
                </button>
            </div>

            <div class="form-colum" style="background-color: white;">
                <h3>Dados médicos</h3><br />
                <label>É castrado?</label>
                <input type="checkbox" name="castrado"
                    <?= (isset($quadro_medico) && $quadro_medico['castrado'] == 1) ? 'checked' : '' ?> />
                <label>Vacinado contra raiva</label>
                <input type="checkbox" name="vacina_raiva"
                    <?= (isset($quadro_medico) && $quadro_medico['vacina_raiva'] == 1) ? 'checked' : '' ?> />
                <label>Medicado contra carrapatos</label>
                <input type="checkbox" name="remedio_carrapato"
                    <?= (isset($quadro_medico) && $quadro_medico['remedio_carrapato'] == 1) ? 'checked' : '' ?> />
                <label>Medicado contra pulgas</label>
                <input type="checkbox" name="remedio_pulga"
                    <?= (isset($quadro_medico) && $quadro_medico['remedio_pulga'] == 1) ? 'checked' : '' ?> />
                <label>Medicado contra verme</label>
                <input type="checkbox" name="remedio_verme"
                    <?= (isset($quadro_medico) && $quadro_medico['remedio_verme'] == 1) ? 'checked' : '' ?> />
            </div>
            <input type="submit" value="Salvar" id="btn_submit_formulario_pet"
                onclick=" return(confirm('Deseja salvar?'))">
        </div>
    </form>
    <script src="/adot/public/scripts/imgPreviewForm.js"></script>
    <script src="/adot/public/scripts/formularioPetSubmit.js"></script>
</div>

<div id="form_preview_modal">
    <div id="container">
        <button id="btn_close_preview_imgs">x</button>
        <h3 style="position: absolute; top: 6px;">Fotos</h3>
        <div style="display: flex; gap: 10px;">
            <div style="position: relative; display: block;" id="pv_div_1">
                <img id="preview" src="<?= !empty($pet['imagem_url']) ? $pet['imagem_url'] : "" ?>"
                    alt="pre-visualização" style="max-width: 300px; border: 1px solid #ccc;">
                <p id="del_preview1" style="position: absolute; top: 2px; right: 10px; color: red; cursor: pointer">
                    X
                </p>
            </div>
            <div style="position: relative; display: none;" id="pv_div_2">
                <img id="preview2" src="<?= !empty($pet['imagem_url_extra']) ? $pet['imagem_url_extra'] : "" ?>"
                    alt="pre-visualização" style="max-width: 300px; border: 1px solid #ccc;">
                <p id="del_preview2" style="position: absolute; top: 2px; right: 10px; color: red; cursor: pointer;">X
                </p>
            </div>
        </div>
        <button id="btn_confirm_preview_imgs" onclick="">
            Ok
        </button>
    </div>
</div>