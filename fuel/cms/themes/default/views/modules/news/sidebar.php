<div class="rightPane">
    <div id="dnn_RightPane" class="_rightPane">
        <div class="DnnModule DnnModule-DNN_HTML DnnModule-457">
            <a name="457"></a>
            <div class="c_DNN6_bgGeen c_DNN6">

                <div class="Title"><span id="dnn_ctr457_dnnTITLE_titleLabel" class="Head">Thông tin</span>

                </div>

                <div id="dnn_ctr457_ContentPane" class="content">
                    <!-- Start_Module_457 -->
                    <div id="dnn_ctr457_ModuleContent" class="DNNModuleContent ModDNNHTMLC">
                        <div id="dnn_ctr457_HtmlModule_lblContent" class="Normal">
                            <div>
                                <a href="<?php echo Uri::create("news/cat/cau-hoi-thuong-gap")?>">
                                  <?php echo Asset::img("ban-can-biet.jpg",array("style"=>"width: 238px; border-width: 0px; border-style: solid;"))?>
                                </a>
                            </div>
                            <div style="text-align: justify;">&nbsp;</div>
                            <div>
                                <a href="<?php echo Uri::create("page/contact-us");?>">
                                  <?php echo Asset::img("togiactoipham2.jpg",array("style"=>"width: 238px; border-width: 0px; border-style: solid;"))?>
                                </a>
                            </div>
                            <style>
                            .my-content p{
                              margin-bottom:0;
                            }
                            </style>
                            <div style="margin-top:15px;" class="my-content">
                           <?php echo nl2br(\Registry::get_setting("site.web_summary")); ?>
                           </div>
                    </div>

                </div>
                <!-- End_Module_457 -->
            </div>
        </div>
    </div>
    <div class="DnnModule DnnModule-Quick_Video DnnModule-454">
        <a name="454"></a>
        <div class="c_DNN6_bgGeen c_DNN6">

            <div class="Title"><span id="dnn_ctr454_dnnTITLE_titleLabel" class="Head">Phóng sự truy nã </span>

            </div>

            <div id="dnn_ctr454_ContentPane" class="content">
                <!-- Start_Module_454 -->
                <div id="dnn_ctr454_ModuleContent" class="DNNModuleContent ModQuickVideoC">

                    <script src="https://content.jwplatform.com/libraries/PpU09I1i.js"></script>
                    <script type="text/javascript">
                        function Playclip454(rong, cao, url, img) {
                            jwplayer('mediaspace_454').setup({
                                'flashplayer': '/DesktopModules/MediaVideo/Scripts/player.swf',
                                'file': url,
                                'controlbar': 'bottom',
                                'width': rong,
                                'height': cao,
                                'image': img,
                                'autostart': 0
                            });

                        }
                    </script>
                    <style>
                        .listvideo {
                            overflow-x: hidden;
                            overflow-y: auto;
                            width: 98% !important;
                        }
                    </style>
                    <div id="dnn_ctr454_Quick_Videos_pnlist">
                        <?php 
                        #Video clip
                        $slug = "video-clip";
                        $posts = get_posts_by_cat(array("category_slug"=>$slug,"limit"=>5));
                        #print_r($posts);exit;
                        $posts1 = reset($posts);
                        if(!empty($posts)){
                          ?>
                        
                        <div id='mediaspace_454'></div>
                        <script type="text/javascript">
                            Playclip454(240, 175, 'https://youtu.be/<?php echo $posts1["slug"];?>', 'https://img.youtube.com/vi/<?php echo $posts1["slug"];?>/default.jpg')
                        </script>
                        <?php foreach($posts as $m){?>
                        <div class='listvideo'><a href='#sel' class='linkvideo' onclick='Playclip454(240,175,&#39;https://youtu.be/<?php echo $m["slug"];?>&#39;,&#39;https://img.youtube.com/vi/<?php echo $m["slug"];?>/default.jpg&#39;)'><?php echo $m["lang"]["title"];?></a></div>
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                </div>
                <!-- End_Module_454 -->
            </div>
        </div>
    </div>
    <div class="DnnModule DnnModule-DNN_HTML DnnModule-455">
        <a name="455"></a>
        <div class="c_DNN6_bgGeenV c_DNN6">
            <div class="Title"><span id="dnn_ctr455_dnnTITLE_titleLabel" class="Head">Liên kết</span>

            </div>
            <div style="float:left;"></div>
            <div id="dnn_ctr455_ContentPane" class="content">
                <!-- Start_Module_455 -->
                <div id="dnn_ctr455_ModuleContent" class="DNNModuleContent ModDNNHTMLC">
                    <div id="dnn_ctr455_HtmlModule_lblContent" class="Normal">
                        <ul>
                          <?php $web_links = \Registry::get_setting("site.web_links"); 
                          $web_links = explode("\n", str_replace("\r", "", $web_links));
                          foreach($web_links as $w){
                             $item = explode(";", str_replace("\r", "", $w));
                            if(!empty($item)){ ?>
                              <li><a target="_blank" href="<?php echo $item[1]?>"><?php echo $item[0]?></a></li>
                            <?php }
                          }
                          ?>
                            
                            
                        </ul>
                    </div>

                </div>
                <!-- End_Module_455 -->
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>