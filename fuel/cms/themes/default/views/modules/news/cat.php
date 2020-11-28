<?php $module = \Config::get('module.name'); ?>
<div id="dnn_ContentPane" class="DNNEmptyPane">
</div>
<div class="leftPanel">
    <div id="dnn_leftPane">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-432">
            <a name="432"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr432_dnnTITLE_titleLabel" class="Head">
                  <?php if(!empty($models)){ ?>
                    <?php #echo $post["lang"]["title"]?>
                    <?php echo $cat_data["lang"]["title"];?>
                  <?php }else{?>
                    <?php echo $cat_data["lang"]["title"];?>
                  <?php }?>
                  </span>
                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr432_ContentPane" class="content">
                    <?php if(!empty($models)){ ?>
                    <div class="list-content-discover">
                      <?php foreach($models as $p){
                        #echo $p["lang"]["body"];
                        echo render("modules/".$module."/loop",array("module"=>$module,"p"=>$p),false);
                      } ?>
                    </div>
                    
                    <?php echo $pagination;?>
                    <?php }else{?>
                    <?php echo $cat_data["lang"]["body"]?>
                    <?php } ?>
                </div>
                <?php #echo render("partials/blocks/share",array("url_share"=>$url_share));?>
            </div>
        </div>
    </div>
    
</div>
<?php echo render("modules/".$module."/sidebar")?>
<div class="clear"></div>

