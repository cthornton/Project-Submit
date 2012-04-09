<?php $this->beginContent('/layouts/application'); ?>
    <div class="left">
      <?php echo $content; ?>
    </div>
		<div class="right">				
			<?php echo $this->renderPartial('/layouts/_right'); ?>
		</div>	
<?php $this->endContent(); ?>