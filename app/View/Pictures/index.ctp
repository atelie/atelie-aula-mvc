<div class="page-header">
  <h1><?php echo __('Fotos'); ?></h1>
</div>
<div>
  <?php echo $this->Html->link(__('Nova Foto'), array('action' => 'add'), array('class' => 'btn btn-success')); ?>
</div>
<div class="row">
  <?php foreach ($pictures as $picture): ?>
  <div class="col-xs-6 col-md-3">
    <span class="thumbnail">      
      <img src="data:image/jpeg;base64,<?php echo base64_encode($picture['Picture']['content']);?>"/>
    </span>
    <div >
      <?php echo $picture['Picture']['name']; ?>

      <?php echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $picture['Picture']['id']), null, __('Are you sure you want to delete # %s?', $picture['Picture']['id'])); ?>
    </div>

  </div>
  <?php endforeach; ?>
</div>