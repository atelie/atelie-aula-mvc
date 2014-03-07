<div class="page-header">
  <h1><?php echo __('Albums'); ?></h1>
</div>
<div class="">
  <?php echo $this->Html->link(__('Novo Álbum'), array('action' => 'add'), array('class' => 'btn btn-success')); ?>
</div>

<div class="container container-fluid">
  <table class="table table-stripped">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th class="actions"><?php echo __('Ações'); ?></th>
    </tr>

    <?php foreach ($albums as $album): ?>
      <tr>
        <td><?php echo h($album['Album']['id']); ?>&nbsp;</td>
        <td><?php echo h($album['Album']['name']); ?>&nbsp;</td>
        <td class="actions">
          <?php echo $this->Html->link(__('Fotos'), array('controller' => 'pictures', 'action' => 'index', $album['Album']['id'])); ?>
          <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $album['Album']['id'])); ?>
          <?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $album['Album']['id']), null, __('Are you sure you want to delete # %s?', $album['Album']['id'])); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>