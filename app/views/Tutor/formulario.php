<div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <h2 style="font-size: 2rem; color: #00CFFF; margin-bottom: 20px;">
        <?=isset($tutor) ? 'Editar Tutor' : 'Cadastrar Tutor'?></h2>

    <form method="post" action="<?=$action?>">
        <?php if (!empty($tutor['id'])): ?>
        <input type="hidden" name="id" value="<?=$tutor['id']?>">
        <input type="hidden" name="endereco_id" value="<?=$tutor['endereco_id']?>">
        <input type="hidden" name="data_cadastro" value="<?=$tutor['data_cadastro']?>">
        <?php endif; ?>

        <div class="form-columns">
            <div class="form-column">
                <label for="nome_completo">Nome Completo</label>
                <input type="text" name="nome_completo" id="nome_completo" value="<?=$tutor['nome_completo'] ?? ''?>"
                    required>

                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo">
                    <option value="0" <?= (isset($tutor['sexo']) && $tutor['sexo'] == '0') ? 'selected' : '' ?>>Homem
                    </option>
                    <option value="1" <?= (isset($tutor['sexo']) && $tutor['sexo'] == '1') ? 'selected' : '' ?>>Mulher
                    </option>
                </select>

                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento"
                    value="<?=$tutor['data_nascimento'] ?? ''?>" required>

                <label for="contato">Contato</label>
                <input type="text" name="contato" id="contato" value="<?=$tutor['contato'] ?? ''?>" required>

                <label for="contato_extra">Contato extra</label>
                <input type="text" name="contato_extra" id="contato_extra" value="<?=$tutor['contato_extra'] ?? ''?>">
            </div>


            <div class="form-column">
                <label for="logradouro">Rua</label>
                <input type="text" name="logradouro" id="logradouro" value="<?=$endereco['logradouro'] ?? ''?>">

                <label for="numero">Número</label>
                <input type="number" name="numero" id="numero" value="<?=$endereco['numero'] ?? ''?>">

                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" value="<?=$endereco['cidade'] ?? ''?>">

                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro" value="<?=$endereco['bairro'] ?? ''?>">
            </div>
        </div>

        <input type="submit" value="Salvar">
    </form>

</div>