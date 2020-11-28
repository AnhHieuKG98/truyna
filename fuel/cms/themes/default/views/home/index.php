<div id="dnn_ContentPane" class="DNNEmptyPane">
</div>
<div class="leftPanel">
    <div id="dnn_TopNewsPane" class="hotFeature">
        <div class="DnnModule DnnModule-Police_TruyNaTop DnnModule-459">
            <a name="459"></a>

            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="Silver4_border">
                <tr>
                    <td align="left" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="Silver4_tbg">
                            <tr>
                                <td width="11%" align="left" valign="middle" nowrap="nowrap"><span id="dnn_ctr459_dnnTITLE_titleLabel" class="SilverDialogtitle4">Đối tượng truy nã đặc biệt</span>

                                </td>
                                <td width="11%" align="center" valign="middle" nowrap="nowrap"></td>
                                <td width="5%" align="center" valign="middle" nowrap="nowrap"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td id="dnn_ctr459_ContentPane" width="100%" align="left" valign="top" class="content">
                        <!-- Start_Module_459 -->
                        <div id="dnn_ctr459_ModuleContent" class="DNNModuleContent ModPoliceTruyNaTopC">

                            
                            <span id="dnn_ctr459_TruyNaNoiBat_lblError" class="error"></span>
                            <div id="featured">
                                <ul class="ui-tabs-nav scroll-pane">
                                    <?php 
                                    #lấy đối tượng Truy nã
                                    $slug = "doi-tuong-truy-na";
                                    $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>20));
                                    foreach($posts as $m){ ?>
                                    <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                    <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $m["id"];?>">
                                        <a href="#fragment-<?php echo $m["id"];?>">
                                            <img alt="Ảnh đối tượng truy nã" src="<?php echo cms_src_image($image,array("full"=>true));?>" />
                                            <b><?php echo $m["lang"]["title"];?></b>
                                            <br /> <?php echo Str::truncate($m["lang"]["summary2"],100);?>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php foreach($posts as $m){ ?> 
                                <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                <div id="fragment-<?php echo $m["id"];?>" class="ui-tabs-panel" style="">
                                    <div class="truyna-top">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>">
                                            <img src="<?php echo cms_src_image($image,array("full"=>true));?>" alt="ảnh đối tượng truy nã" />
                                        </a>
                                        <div>
                                            <a href="<?php echo Uri::create("news/".$m["slug"]);?>"><h2 style="color:#05841f"><?php echo $m["lang"]["title"];?></h2></a>
                                            <br /> <?php echo nl2br($m["lang"]["summary2"]);?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            </div>

                        </div>
                        <!-- End_Module_459 -->
                    </td>

                </tr>
            </table>
        </div>
    </div>
    <div id="dnn_leftPane">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-432">
            <a name="432"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr432_dnnTITLE_titleLabel" class="Head">Sự kiện tiêu điểm</span>

                </div>
                <div style="float:left;"></div>
                <?php 
                #lấy sự kiện tiêu điểm
                $slug = "su-kien-tieu-diem";
                $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>6));
                if(!empty($posts)){
                $posts_1 = array();
                $posts_2 = array();
                $i = 0;
                foreach($posts as $m){ 
                  if($i==0)
                    $posts_1[] = $m;
                  else
                    $posts_2[] = $m;
                  $i++;
                }
                ?>
                <div id="dnn_ctr432_ContentPane" class="content">
                    <!-- Start_Module_432 -->
                    <div id="dnn_ctr432_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <div class="Newsfull">
                            <div class="LeftNewsfull">
                              <?php foreach($posts_1 as $m){#145_96?>
                                <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                <div class="imageTopnewsfull">
                                    <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none">
                                      <img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                                </div>

                                <div class="linkSmallColor"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                <div class="sumaryTopnewsfull">
                                    <div class="header">
                                        <div class="box-widget desnews" style="margin-bottom: 10px;"><?php echo Str::truncate(strip_tags($m["lang"]["body"]),250);?></div>
                                    </div>
                                </div>
                              <?php } ?>
                            </div>
                            <div class="RightNews">
                                <?php foreach($posts_2 as $m){?>
                                <div class="RightNewsfull"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                <?php } ?>

                            </div>
                            <div class="clear">
                            </div>
                        </div>

                    </div>
                    <!-- End_Module_432 -->
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="dnn_leftPaneLowerLeft" class="leftpart">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-433">
            <a name="433"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr433_dnnTITLE_titleLabel" class="Head">Công tác nghiệp vụ</span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr433_ContentPane" class="content">
                    <!-- Start_Module_433 -->
                    <div id="dnn_ctr433_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <div class="newsCat">
                            <?php 
                            #lấy công tác nghiệp vụ
                            $slug = "cong-tác-nghiep-vu";
                            $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>3));
                            if(!empty($posts)){
                            $posts_1 = array();
                            $posts_2 = array();
                            $i = 0;
                            foreach($posts as $m){ 
                              if($i==0)
                                $posts_1[] = $m;
                              else
                                $posts_2[] = $m;
                              $i++;
                            }
                            ?>
                            <?php foreach($posts_1 as $m){#145_96?>
                            <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                            <div class="topNewsCat">
                                <div class="imageTopNewsCat">
                                    <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                                </div>

                                <div class="linkSmallColor">
                                    <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                <div class="sumaryTopNewsCat">
                                    <p style="color: #333333;"><?php echo Str::truncate(strip_tags($m["lang"]["body"]),250);?></p>
                                </div>
                                <div class="clear">
                                </div>
                            </div>
                            <?php } ?>
                              
                              <?php foreach($posts_2 as $m){?>
                                <div class="subNewsCat"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                <?php } ?>
                            <?php } ?>
                        </div>

                    </div>
                    <!-- End_Module_433 -->
                </div>
            </div>
        </div>
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-434">
            <a name="434"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr434_dnnTITLE_titleLabel" class="Head">Vận động đầu thú</span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr434_ContentPane" class="content">
                    <!-- Start_Module_434 -->
                    <div id="dnn_ctr434_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <div class="newsCat">
                           
                                 <?php 
                                #lấy vận động đầu thú
                                $slug = "van-dong-dau-thu";
                                $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>3));
                                if(!empty($posts)){
                                $posts_1 = array();
                                $posts_2 = array();
                                $i = 0;
                                foreach($posts as $m){ 
                                  if($i==0)
                                    $posts_1[] = $m;
                                  else
                                    $posts_2[] = $m;
                                  $i++;
                                }
                                ?>
                                <?php foreach($posts_1 as $m){#145_96?>
                                <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                <div class="topNewsCat">
                                    <div class="imageTopNewsCat">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                                    </div>

                                    <div class="linkSmallColor">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <div class="sumaryTopNewsCat">
                                        <p style="color: #333333;"><?php echo Str::truncate(strip_tags($m["lang"]["body"]),250);?></p>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                                <?php } ?>
                                  
                                  <?php foreach($posts_2 as $m){?>
                                    <div class="subNewsCat"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <?php } ?>
                                <?php } ?>
                            

                            

                        </div>

                    </div>
                    <!-- End_Module_434 -->
                </div>
            </div>
        </div>
    </div>
    <div id="dnn_leftPaneLowerRight" class="rightpart">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-435">
            <a name="435"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr435_dnnTITLE_titleLabel" class="Head">Hoạt động phong trào</span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr435_ContentPane" class="content">
                    <!-- Start_Module_435 -->
                    <div id="dnn_ctr435_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <div class="newsCat">
                            <?php 
                                #lấy hoạt động phong trào
                                $slug = "hoat-dong-phong-trao";
                                $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>3));
                                if(!empty($posts)){
                                $posts_1 = array();
                                $posts_2 = array();
                                $i = 0;
                                foreach($posts as $m){ 
                                  if($i==0)
                                    $posts_1[] = $m;
                                  else
                                    $posts_2[] = $m;
                                  $i++;
                                }
                                ?>
                                <?php foreach($posts_1 as $m){#145_96?>
                                <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                <div class="topNewsCat">
                                    <div class="imageTopNewsCat">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                                    </div>

                                    <div class="linkSmallColor">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <div class="sumaryTopNewsCat">
                                        <p style="color: #333333;"><?php echo Str::truncate(strip_tags($m["lang"]["body"]),250);?></p>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                                <?php } ?>
                                  
                                  <?php foreach($posts_2 as $m){?>
                                    <div class="subNewsCat"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <?php } ?>
                                <?php } ?>

                        </div>

                    </div>
                    <!-- End_Module_435 -->
                </div>
            </div>
        </div>
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-436">
            <a name="436"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr436_dnnTITLE_titleLabel" class="Head">Gương điển hình</span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr436_ContentPane" class="content">
                    <!-- Start_Module_436 -->
                    <div id="dnn_ctr436_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <div class="newsCat">
                            <?php 
                                #gương điển hình
                                $slug = "guong-dien-hinh";
                                $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>3));
                                if(!empty($posts)){
                                $posts_1 = array();
                                $posts_2 = array();
                                $i = 0;
                                foreach($posts as $m){ 
                                  if($i==0)
                                    $posts_1[] = $m;
                                  else
                                    $posts_2[] = $m;
                                  $i++;
                                }
                                ?>
                                <?php foreach($posts_1 as $m){#145_96?>
                                <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                                <div class="topNewsCat">
                                    <div class="imageTopNewsCat">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                                    </div>

                                    <div class="linkSmallColor">
                                        <a href="<?php echo Uri::create("news/".$m["slug"]);?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <div class="sumaryTopNewsCat">
                                        <p style="color: #333333;"><?php echo Str::truncate(strip_tags($m["lang"]["body"]),250);?></p>
                                    </div>
                                    <div class="clear">
                                    </div>
                                </div>
                                <?php } ?>
                                  
                                  <?php foreach($posts_2 as $m){?>
                                    <div class="subNewsCat"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                                    <?php } ?>
                                <?php } ?>
                        </div>

                    </div>
                    <!-- End_Module_436 -->
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="dnn_leftPaneBottom">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-437">
            <a name="437"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr437_dnnTITLE_titleLabel" class="Head">Thư cảm ơn</span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr437_ContentPane" class="content">
                    <!-- Start_Module_437 -->
                    <div id="dnn_ctr437_ModuleContent" class="DNNModuleContent ModDnnForgeLatestArticlesC">
                        <?php 
                        #Thư cảm ơn
                        $slug = "thu-cam-on";
                        $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>3));
                        if(!empty($posts)){?>
                        <?php foreach($posts as $m){#145_96?>
                        <?php $image = cms_get_image_one($m["id"],"news_p_A"); ?>
                          <div class="thucamon">

                              <div class="imageTopnewsfull">
                                  <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><img src="<?php echo cms_src_image($image,array("width"=>145,"height"=>96));?>" alt="<?php echo $m["lang"]["title"];?>" /></a>
                              </div>

                              <div class="linkSmallColor"> <a href="<?php echo Uri::create("news/".$m["slug"])?>" style="text-decoration: none"><?php echo $m["lang"]["title"];?></a></div>
                              <div class="sumaryTopnewsfull">
                                  <p><?php echo Str::truncate(strip_tags($m["lang"]["body"]),260);?></p>
                              </div>
                          </div>
                          <div class="clear"></div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <!-- End_Module_437 -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo render("modules/news/sidebar");?>
