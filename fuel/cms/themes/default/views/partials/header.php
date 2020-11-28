<div id="Header">
  <div id="ContentBG">

      <div id="LogoRow">
          <a id="dnn_dnnLOGO_hypLogo" title="Lực lượng cảnh sát Truy nã tội phạm" href="<?php echo Uri::base();?>"><img id="dnn_dnnLOGO_imgLogo" src="<?php echo Uri::create(\Registry::get_setting("site.site_logo")); ?>" alt="Lực lượng cảnh sát Truy nã tội phạm" /></a>
      </div>
      <div class="Content">
          <div id="Nav_Xanh">
              <div class="boxHead">
                  <div id="dnnMenu">
                      <?php $url_current = \Uri::string(); 
                      ?>
                      <ul class="topLevel">
                          <li class="item first <?php if(empty($url_current)){?>selected<?php } ?>">

                              <a href="<?php echo Uri::base()?>">
                                  <div>Trang chủ</div>
                              </a>
                          </li>
                          <li class="item haschild">

                              <a href="#">
                                  <div>Giới thiệu</div>
                              </a>

                              <div class="subLevel">
                                
                                                                    <ul>
                                    <?php 
                                      \Module::load("news");
                                      $parent_slug = "gioi-thieu";
                                      $cat_data = \News\Model_News_Category::find("first",array(
                                          "related" => array("lang" => array("where"=>array("lang_code"=>\Lang::get_lang()))),
                                          "where"=>array(array("slug"=>$parent_slug))
                                        )
                                      )->to_array();
                                      if(!empty($cat_data)){
                                        $params = array('parent_id'=>$cat_data["id"],"status"=>"A");#,'frefix'=>""
                                        $_categories = \News\Model_News_Category::fn_get_categories($params);
                                        $i=0;
                                        foreach($_categories as $cat){
                                          $url = "news/cat/".$cat["slug"];
                                    ?>
                                    
                                      <li class="item <?php if($i==0){?>first<?php } ?> <?php if($url_current==$url){?>selected<?php } ?>">
                                          <a href="<?php echo Uri::create($url);?>">
                                              <div><span><?php echo $cat["title"];?></span></div>
                                          </a>
                                      </li>
                                      <?php $i++; 
                                      }
                                      } ?>


                                  </ul>
                              </div>

                          </li>

                          
                          <li class="item haschild <?php if($url_current=="news/cat/tin-tuc-su-kien"){?>selected<?php } ?>">

                              <a href="<?php echo Uri::create("news/cat/tin-tuc-su-kien")?>">
                                  <div>Tin tức - Sự kiện</div>
                              </a>

                              <div class="subLevel">
                                  <ul>
                                    <?php 
                                      \Module::load("news");
                                      $parent_slug = "tin-tuc-su-kien";
                                      $cat_data = \News\Model_News_Category::find("first",array(
                                          "related" => array("lang" => array("where"=>array("lang_code"=>\Lang::get_lang()))),
                                          "where"=>array(array("slug"=>$parent_slug))
                                        )
                                      )->to_array();
                                      if(!empty($cat_data)){
                                        $params = array('parent_id'=>$cat_data["id"],"status"=>"A");#,'frefix'=>""
                                        $_categories = \News\Model_News_Category::fn_get_categories($params);
                                        $i=0;
                                        foreach($_categories as $cat){
                                          $url = "news/cat/".$cat["slug"];
                                    ?>
                                    
                                      <li class="item <?php if($i==0){?>first<?php } ?> <?php if($url_current==$url){?>selected<?php } ?>">
                                          <a href="<?php echo Uri::create("news/cat/".$cat["slug"]);?>">
                                              <div><span><?php echo $cat["title"];?></span></div>
                                          </a>
                                      </li>
                                      <?php $i++; 
                                      }
                                      } ?>


                                  </ul>
                              </div>

                          </li>

                          
                          <li class="item <?php if($url_current=="page/search" OR isset($_GET["s"])){?>selected<?php } ?> ">

                              <a href="<?php echo Uri::create("page/search");?>">
                                  <div>Tìm kiếm</div>
                              </a>

                          </li>
                          <li class="item <?php if($url_current=="item page/contact-us"){?>selected<?php } ?>">

                              <a href="<?php echo Uri::create("page/contact-us");?>">
                                  <div>Liên hệ</div>
                              </a>

                          </li>

                         

                          

                      </ul>
                  </div>

              </div>
          </div>
          <div class="clear">
          </div>
          <div class="tick_Search">
              <div class="boxHead" style="position:relative;">
                  
                  <div class="tick">
                      <div id="settime" style="float: left; font-size: 11px;"><?php echo date("d/m/Y, H:i A")?></div>
                      <strong style="position: absolute; left: 177px;">Sáu điều Bác Hồ dạy CAND:
                      </strong>
                  </div>
                  <marquee behavior="scroll" direction="left" scrollamount="3" style="position: absolute;
                           left: 345px; width: 600px;color:#444">
                      1. Đối với tự mình phải cần, kiệm, liêm, chính&nbsp;&nbsp; 2. Đối với đồng sự phải thân ái, giúp đỡ&nbsp;&nbsp; 3. Đối với chính phủ phải tuyệt đối trung thành&nbsp;&nbsp; 4. Đối với nhân dân phải kính trọng, lễ phép&nbsp;&nbsp; 5. Đối với công việc phải tận tụy&nbsp;&nbsp; 6. Đối với địch phải cương quyết, khôn khéo&nbsp;&nbsp;
                  </marquee>
              </div>
          </div>
      </div>
  </div>
</div>