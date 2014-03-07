<div class="albums form">
<?php echo $this->Form->create('Album'); ?>
    <fieldset>
        <legend><?php echo __('Add Album'); ?></legend>
    <?php
        echo $this->Form->input('name');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>