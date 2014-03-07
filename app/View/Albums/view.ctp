<div class="albums view">
<h2><?php echo __('Album'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($album['Album']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($album['Album']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($album['Album']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($album['Album']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Album'), array('action' => 'edit', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Album'), array('action' => 'delete', $album['Album']['id']), null, __('Are you sure you want to delete # %s?', $album['Album']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pictures'), array('controller' => 'pictures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Picture'), array('controller' => 'pictures', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pictures'); ?></h3>
	<?php if (!empty($album['Picture'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Album Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($album['Picture'] as $picture): ?>
		<tr>
			<td><?php echo $picture['id']; ?></td>
			<td><?php echo $picture['name']; ?></td>
			<td><?php echo $picture['album_id']; ?></td>
			<td><?php echo $picture['content']; ?></td>
			<td><?php echo $picture['created']; ?></td>
			<td><?php echo $picture['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pictures', 'action' => 'view', $picture['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pictures', 'action' => 'edit', $picture['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pictures', 'action' => 'delete', $picture['id']), null, __('Are you sure you want to delete # %s?', $picture['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Picture'), array('controller' => 'pictures', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
