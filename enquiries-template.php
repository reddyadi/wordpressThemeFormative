<?php

/*
  Template Name: Enquiries
*/

if($_POST){

  $errors = array();

  if(!wp_verify_nonce($_POST['_wpnonce'], 'wp_enquiry_form')){
    array_push($error, 'Sorry something went wrong with processing this form, Please try again');
  } else {

    if(!$_POST['enquiriesName']){
      array_push($errors, "Your name is required, please enter your name");
    } else if(strlen($_POST['enquiriesName']) < 2){
      array_push($errors, "Please enter at least 2 characters for your name");
    }

    $content = $_POST['enquiriesMessage'];
    if(!$_POST['enquiriesMessage']){
      array_push($errors, "A message is required, please enter a value");
    } else if(strlen($_POST['enquiriesMessage']) < 10){
      array_push($errors, "Please enter at least 10 characters for your Message");
    }

    if(!$_POST['enquiriesEmail']){
      array_push($errors, "An Email is required, please enter a value");
    } else if(!filter_var($_POST['enquiriesEmail'], FILTER_VALIDATE_EMAIL)){
      array_push($errors, "Please enter a valid email address");
    }

    if(empty($errors)){

    }

  }
}

?>

<?php get_header(); ?>

<?php if(have_posts()): ?>
  <?php while(have_posts()): the_post(); ?>
    <div class="container">

      <div class="row">
        <div class="col">
          <h1 class="comfortaa"><?php the_title(); ?></h1>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="wp_content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <?php if($_POST && !empty($errors)): ?>
        <div class="row mb-2">
          <div class="col">
            <div class="alert alert-danger pb-0" role="alert">
              <ul>
                <?php foreach($errors as $singleError): ?>
                  <li><?= $singleError; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col">
          <form action="<?= get_permalink(); ?>" method="post">
            <?php wp_nonce_field('wp_enquiry_form'); ?>
            <div class="form-group">
              <label class="poiret" for="">Name</label>
              <input type="text" name="enquiriesName" class="form-control" value="">
            </div>
            <div class="form-group">
              <label class="poiret" for="">Email</label>
              <input type="email" name="enquiriesEmail" class="form-control" value="">
            </div>
            <div class="form-group">
              <label class="poiret" for="">Message</label>
              <textarea name="enquiriesMessage" rows="8" cols="80"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" name="" value="Send Enquiry" class="btn btn-primary btn-block">
            </div>
          </form>
        </div>
      </div>

    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
