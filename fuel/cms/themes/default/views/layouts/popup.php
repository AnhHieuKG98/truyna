<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $meta_head;?>
    </head>
    <body>
      <div class="wrap">
        <section id="content">
        <?php echo $content; ?>
        </section>
      </div>
      <?php echo $footer_include;?>
    </body>
</html>
