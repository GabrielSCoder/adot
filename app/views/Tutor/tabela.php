<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 10px;">

    <h2 style="font-size: 2rem; color: #00CFFF; margin-bottom: 20px; text-align: center;">Lista de Tutores</h2>

    <?php if (empty($tutores)): ?>
    <p>Nenhum tutor cadastrado.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nome completo</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tutores as $tutor): ?>
            <tr>
                <td><?=htmlspecialchars($tutor['nome_completo'])?></td>
                <td><?=$tutor['sexo'] == 0 ? 'Homem' : 'Mulher'?></td>
                <td><?=date("d/m/Y", strtotime($tutor['data_nascimento']))?></td>
                <td><?=date("d/m/Y H:i", strtotime($tutor['data_cadastro']))?></td>
                <td>
                    <a href="?pagina=tutor&action=editar&id=<?=$tutor['id']?>"
                        style="text-decoration: none; color: black;">Editar</a>
                    |
                    <a href="?pagina=tutor&action=deletar&id=<?=$tutor['id']?>"
                        style="text-decoration: none; color: black;"
                        onclick="return confirm('Tem certeza que deseja excluir este tutor?')">
                        Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <button class="btn-adicionar" onclick="window.location.href='?pagina=tutor&action=criar'">
        Adicionar novo
    </button>
</div>