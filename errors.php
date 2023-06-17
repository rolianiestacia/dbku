<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <h6><?php echo $error ?></h6>
  	<?php endforeach ?>
  </div>
<?php  endif ?>