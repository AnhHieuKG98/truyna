 <?php $page_title = $model["lang"]["title"];
  $page_title_1 = substr($page_title,0,1);
  $page_title_2 = substr($page_title,1);
  
  #echo $page_title;
  #print_r($model);
?>
<style>
  .alert p{
    color:#f00;
    margin-bottom:10px;
  }
  .input-text{
    width:100%;
    height:30px;
    margin-bottom:5px;
    padding:0 10px;
  }
  textarea.input-text{
    height:60px;
    resize:none;
  }
  .form-group{
    padding:0 5px;
    display: flex;
  }
  form button{
    
    background:#03a724;
    color:#fff;
    padding:5px 10px;
    border:none;
  }
  .contact-form-style{
    display:block;
    clear:both;
    text-align: right;
    
    padding:0 5px;
  }
  </style>
<div id="dnn_ContentPane" class="DNNEmptyPane">
</div>
<div class="leftPanel">
    <div id="dnn_leftPane">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-432">
            <a name="432"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr432_dnnTITLE_titleLabel" class="Head"><?php echo $model->lang->title;?></span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr432_ContentPane" class="content">
                    <?php if(!empty($page_form)):?>
                    <!-- FORM-->
                    <div class="contact-area pt-100 pb-100">
                      <div class="container">
                        <?php if (Session::get_flash('error_frontend')): ?>
                        
                          <div class="alert alert-danger alert-dismissable" data-scroll="page-error">
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
                      </div>
                      <div class="container">
                          <div class="row no-gutters">
                             <div class="col-md-12 col-lg-6 yellow-bg">
                                  <div class="contact-form contact-form-wrap">
                                      <h2 class="contact-title">Liên hệ, Đóng góp ý kiến cho chúng tôi</h2>
                                      <form class="form-input-contact" method="post">
                                        <div class="row">
                                          <?php foreach($page_form["fields"] as $field){ #print_r($field);?>
                                          <div class="col-12">
                                            <div class="form-group mb-20">
                                              <?php if($field["type"]=="text" OR $field["type"]=="email" OR $field["type"]=="tel"){?>
                                              <input class="input-text" value="<?php echo isset($form_post[$field["name"]]) ? $form_post[$field["name"]] : ""; ?>" type="text" name="<?php echo $field["name"];?>" placeholder="<?php echo $field["lang"]["placeholder"];?><?php if($field["required"]=="Y"){?> *<?php } ?>">
                                              <?php } elseif($field["type"]=="textarea"){ ?>
                                              <textarea class="input-text" name="<?php echo $field["name"];?>" placeholder="<?php echo $field["lang"]["placeholder"];?><?php if($field["required"]=="Y"){?> *<?php } ?>"><?php echo isset($form_post[$field["name"]]) ? $form_post[$field["name"]] : ""; ?></textarea>
                                              <?php } ?>
                                            </div>
                                          </div>
                                          <?php } ?>
                                          <div class="col-md-12"> 
                                            <div class="contact-form-style">
                                            <button type="submit" class="btn btn-submit" name="contact_form_click" value="<?php echo l("send");?>"><?php echo l("send");?></button>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!--//FORM-->
                    <?php endif;?>
                    <?php if(empty($page_form)):?>
                    <?php echo remove_width_attribute($model->lang->body);?>
                    <?php endif;?>
                    <?php if($model["slug"] =='search'){?>
                    <form action="<?php echo Uri::create("news");?>">
                      <input name="s" placeholder="Nhập từ khoá tìm kiếm" />
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php echo render("modules/news/sidebar")?>
<div class="clear"></div>
     