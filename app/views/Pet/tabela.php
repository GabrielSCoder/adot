<div style="display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 10px;">

    <h2 style="font-size: 2rem; color: #00CFFF; margin-bottom: 20px; text-align: center;">Lista de Pets</h2>

    <?php if (empty($pets)): ?>
    <p>Nenhum pet cadastrado.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet): ?>
            <tr>
                <td><?=htmlspecialchars($pet['nome'])?></td>
                <td><?=$pet['sexo'] == 0 ? 'macho' : 'fêmea'?></td>
                <td><?=date("d/m/Y", strtotime($pet['data_nascimento']))?></td>
                <td><?=date("d/m/Y H:i", strtotime($pet['data_cadastro']))?></td>
                <td>
                    <a href="?pagina=pet&action=editar&id=<?=$pet['id']?>"
                        style="text-decoration: none; color: black;">Editar</a>
                    |
                    <a href="?pagina=pet&action=deletar&id=<?=$pet['id']?>" style="text-decoration: none; color: black;"
                        onclick="return confirm('Tem certeza que deseja excluir este pet?')">
                        Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <button class="btn-adicionar" onclick="window.location.href='?pagina=pet&action=criar'">
        Adicionar novo
    </button>
</div>