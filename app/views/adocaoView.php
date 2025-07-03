<div style="display: flex; flex-direction: column; height: 100%; ">
    <h2 id="title_message"><?=  $message; ?></h2><br />
    <div class="pet-grid">
        <?php foreach ($pets as $pet): ?>
        <div class="pet-card">
            <img src="<?= $pet['foto_url'] ?>" alt="Foto do <?= $pet['nome'] ?>">
            <div class="pet-info">
                <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                <div class="icons">
                    <?php if ($pet['especie_id'] == 1): // cachorro ?>
                    <span title="Cachorro">🐶</span>
                    <?php else: ?>
                    <span title="Gato">🐱</span>
                    <?php endif; ?>

                    <?php if ($pet['sexo'] == 0): ?>
                    <span title="Macho" class="sexo-m">♂️</span>
                    <?php else: ?>
                    <span title="Fêmea" class="sexo-f">♀️</span>
                    <?php endif; ?>
                </div>
                <a href="?pagina=adocao&action=detalhes&id=<?= $pet['id'] ?>" class="ver-mais">Ver mais</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>