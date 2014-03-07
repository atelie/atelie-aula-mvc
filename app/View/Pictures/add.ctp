<div class="pictures form">
<?php echo $this->Form->create('Picture', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Picture'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('album_id');
        echo $this->Form->file('content');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
