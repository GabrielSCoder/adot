<div class="pet-detalhes-container"
    style="max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px; font-weight: bold;"><?=$pet['nome']?></h2>
    <hr />

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        <div style="flex: 1; min-width: 250px;">
            <img src="<?= $imagem ? $imagem['caminho'] : 'public/img/default.png' ?>" alt="Foto do pet"
                style="width: 100%; border-radius: 10px; object-fit: cover;" />
        </div>

        <div
            style="flex: 2; min-width: 250px;display: flex; flex-direction: column; align-items: start; justify-content: center; gap: 5px;">
            <h3>Informações gerais</h3>
            <p><strong>Espécie:</strong> <?= $pet['especie_id'] == 1 ? 'Cachorro' : 'Gato' ?></p>
            <p><strong>Sexo:</strong> <?= $pet['sexo'] == 0 ? 'Macho' : 'Fêmea' ?></p>
            <p><strong>Data de Nascimento:</strong> <?= date('d/m/Y', strtotime($pet['data_nascimento'])) ?></p>
        </div>
    </div>


    <?php if (!empty($pet['comentario'])): ?>
    <hr style="margin: 30px 0;" />
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h3>Sobre mim</h3>
        <p style="padding: 10px;"><?= $pet['comentario'] ?></p>
    </div>
    <?php endif; ?>

    <hr style="margin: 30px 0;" />

    <h3>Quadro Médico</h3>
    <ul style="list-style: none; padding: 0;">
        <li>✅ Castrado: <?= $quadro['castrado'] ? 'Sim' : 'Não' ?></li>
        <li>✅ Vacinado contra raiva: <?= $quadro['vacina_raiva'] ? 'Sim' : 'Não' ?></li>
        <li>✅ Remédio para pulgas: <?= $quadro['remedio_pulga'] ? 'Sim' : 'Não' ?></li>
        <li>✅ Remédio para carrapatos: <?= $quadro['remedio_carrapato'] ? 'Sim' : 'Não' ?></li>
        <li>✅ Remédio para vermes: <?= $quadro['remedio_verme'] ? 'Sim' : 'Não' ?></li>
    </ul>

    <hr style="margin: 30px 0;" />

    <h3>Tutor Responsável</h3>
    <p><strong>Nome:</strong> <?= $tutor['nome_completo'] ?></p>
    <p><strong>Contato:</strong> <a href="https://wa.me/55<?= preg_replace('/\D/', '', $tutor['contato']) ?>"
            target="_blank" style="color: green; font-weight: bold;">Entrar em contato pelo WhatsApp</a></p>
</div>