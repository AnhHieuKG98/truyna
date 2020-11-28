<?php $module = \Config::get('module.name');?>
 <?php $module_title = l("news.title");
  $module_title_1 = substr($module_title,0,1);
  $module_title_2 = substr($module_title,1);
?>
<div id="dnn_ContentPane" class="DNNEmptyPane">
</div>
<div class="leftPanel">
    <div id="dnn_leftPane">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-432">
            <a name="432"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr432_dnnTITLE_titleLabel" class="Head">
                 
                    Tìm kiếm
          
                  </span>
                </div>
                
                
                
                <div style="float:left;"></div>
                <div id="dnn_ctr432_ContentPane" class="content">
                    <form action="<?php echo Uri::create("news");?>">
                      <input value="<?php echo isset($_GET["s"]) ? $_GET["s"] : "";?>" name="s" placeholder="Nhập từ khoá tìm kiếm" />
                    </form>
                    <div class="list-content-discover">
                      <?php foreach($models as $p){
                        #echo $p["lang"]["body"];
                        echo render("modules/".$module."/loop",array("module"=>$module,"p"=>$p),false);
                      } ?>
                    </div>
                    
                    <?php echo $pagination;?>
                   
                </div>
                <?php #echo render("partials/blocks/share",array("url_share"=>$url_share));?>
            </div>
        </div>
    </div>
    
</div>
<?php echo render("modules/".$module."/sidebar")?>
<div class="clear"></div>