<?php if(!empty($contact_form)){?>
<section class="sec-contact">
  <div class="map-wrap">
    <div id="map"></div>
  </div>
  <div class="container">
    <?php if (Session::get_flash('error_frontend')): ?>
      <div class="alert alert-danger alert-dismissable" data-scroll="page-error">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>
        <?php echo implode('</p><p>', (array) Session::get_flash('error_frontend')); ?>
        </p>
      </div>
    <?php endif; ?>
    <?php if (Session::get_flash('success_frontend_scroll')): ?>
      <div class="alert alert-success alert-dismissable" data-scroll="page-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>
        <?php echo implode('</p><p>', (array) Session::get_flash('success_frontend_scroll')); ?>
        </p>
      </div>
    <?php endif; ?>
    
    <div class="contact-block row justify-content-end">
      <div class="col-md-6">
        <form class="form-input-contact" method="post">
          <div class="desc-item-contact wow fadeInUp">
            <div class="sec-title"><span>C</span>ontact</div>
            <div class="form-group">
              <?php foreach($contact_form["fields"] as $field){ #print_r($field);?>
              <div class="item">
                <?php if($field["type"]=="text" OR $field["type"]=="email" OR $field["type"]=="tel"){?>
                  <input value="<?php echo isset($form_post[$field["name"]]) ? $form_post[$field["name"]] : ""; ?>" type="text" name="<?php echo $field["name"];?>" placeholder="<?php echo $field["lang"]["placeholder"];?><?php if($field["required"]=="Y"){?> *<?php } ?>">
                <?php } elseif($field["type"]=="textarea"){ ?>
                  <textarea name="<?php echo $field["name"];?>" placeholder="<?php echo $field["lang"]["placeholder"];?><?php if($field["required"]=="Y"){?> *<?php } ?>"><?php echo isset($form_post[$field["name"]]) ? $form_post[$field["name"]] : ""; ?></textarea>
                <?php } ?>
              </div>
              <?php } ?>
              <div class="item">
                <div class="g-recaptcha" data-sitekey="6LfGJYMUAAAAAOhoDHAPtxThxJLL2---gogS3Mnu"></div>
              </div>
              <div class="item">
                <button type="submit" name="block_contact" value="block_contact"><?php echo l("send");?></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section><?php } ?>
<footer class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="logo-footer-block col-12">
          <div class="logo-block"><a href="<?php echo Uri::base();?>"><img src="<?php echo \Registry::get_setting("site.site_logo_footer");?>" alt="logo-footer" /></a></div>
        </div>
      </div>
      <div class="list-content-desc row">
        <div class="col-lg-4 item-desc">
          <p class="desc-detai"><?php echo \Registry::get_setting("company.company_summary"); ?></p>
          <div class="list-social-footer"><span class="txt"><?php echo l("connect")?></span>
          <?php $soc_facebook = \Registry::get_setting("social.facebook");?>
          <?php $soc_twitter = \Registry::get_setting("social.twitter");?>
          <?php $soc_google = \Registry::get_setting("social.google");?>
          <?php $soc_youtube = \Registry::get_setting("social.youtube");?>
          <a target="_blank" href="<?php echo $soc_facebook ? $soc_facebook : "#";?>"><i class="fab fa-facebook-f"></i></a>
          <a target="_blank" href="<?php echo $soc_twitter ? $soc_twitter : "#";?>"><i class="fab fa-twitter"></i></a>
          <a target="_blank" href="<?php echo $soc_google ? $soc_google : "#";?>"><i class="fab fa-google"></i></a>
          <a target="_blank" href="<?php echo $soc_youtube ? $soc_youtube : "#";?>"><i class="fab fa-youtube"></i></a>
          </div>
          <a target="_blank" class="btn-link" href="<?php echo Uri::create(\Registry::get_setting("site.site_download")); ?>"><span class="txt"><?php echo l("Capacity Profile")?></span><?php echo Asset::img("common/download.png");?></a>
        </div>
        <div class="col-lg-4 item-desc">
          <div class="sec-title-footer"><?php echo l("Quick Links")?></div>
          <div class="nav-footer">
            <?php echo \Registry::get_setting("company.company_footer2"); ?>
          </div>
        </div>
        <div class="col-lg-4 item-desc">
          <div class="sec-title-footer"><?php echo l("Company Info")?></div>
          <div class="item-infor">
            <div class="icon"><?php echo Asset::img("common/locaiton-icon.png")?></div>
            <div class="desc-info">
              <?php echo \Registry::get_setting("company.company_footer3");?>
            </div>
          </div>
          <div class="item-infor">
            <div class="icon"><?php echo Asset::img("common/call-icon.png")?></div>
            <div class="desc-info">
              <p><?php echo \Registry::get_setting("company.company_phone");?><br><?php echo \Registry::get_setting("company.company_email");?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="to-top"><?php echo Asset::img("common/to-top.png")?></div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="text-center txt-coppyright">© 2018 <span>gianguyenad.com.vn</span>&nbsp;All rights reserved.</div>
  </div>
</footer>