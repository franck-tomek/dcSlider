<html>
  <head>
    <title>dcSlider</title>
    <?php echo dcPage::jsPageTabs($default_tab);?>
  </head>
  <body>
    <h2><?php echo html::escapeHTML($core->blog->name);?> &gt; dcSlider</h2>
    <?php if (!empty($message)):?>
    <p class="message"><?php echo $message;?></p>
    <?php endif;?>

    <form action="<?php echo $p_url;?>" method="post" enctype="multipart/form-data">
    <?php if ($dcslider_active || $is_super_admin):?>
    <div class="multi-part" id="settings" title="<?php echo __('Settings');?>">
      <h3 class="hidden-if-js"><?php echo __('Settings');?></h3>
      <?php if ($is_super_admin):?>
      <div class="fieldset">
	<h3><?php echo __('Plugin activation');?></h3>
	<p>
	  <label class="classic" for="dcslider_active">
	    <?php echo form::checkbox('dcslider_active', 1, $dcslider_active);?>
	    <?php echo __('Enable dcSlider plugin');?>
	  </label>
	</p>
      </div>
      <?php endif;?>

      <p>
	<input type="submit" name="saveconfig" value="<?php echo __('Save configuration');?>" />
      </p>
    </div>

    <?php if ($dcslider_active):?>
    <div class="multi-part" id="images" title="<?php echo __('Images');?>">
      <h3 class="hidden-if-js"><?php echo __('Images');?></h3>
      <p class="area">
	<label class="classic">
	  <?php echo __('List of images');?>
	  <?php echo form::textArea('dcslider_images', 5, 10, $dcslider_images);?>
	</label>
      </p>
      <p class="note"><?php echo __('Paths to images. One per line');?></p>

      <p>
	<input type="submit" name="saveconfig" value="<?php echo __('Add');?>" />
      </p>
    </div>
    <?php endif;?>

    <input type="hidden" name="p" value="dcSlider"/>
    <?php echo $core->formNonce();?>
    </form>
    <?php endif;?>
  </body>
</html>
