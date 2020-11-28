<?php $module = \Config::get('module.name');
$post = $model;
$created_at = date($post["created_at"]);
$day = date("d",$created_at);
$month = date("M",$created_at);
?>
<?php $url_share = Uri::create($module."/".$post["slug"]);?>
<?php #echo render("partials/blocks/share",array("url_share"=>$url_share));?>
 <?php $module_title = l("news.title");
  $module_title_1 = substr($module_title,0,1);
  $module_title_2 = substr($module_title,1);
?>
<?php $full_content =  $post["lang"]["body"];?>
<div id="dnn_ContentPane" class="DNNEmptyPane">
</div>
<div class="leftPanel">
    <div id="dnn_leftPane">
        <div class="DnnModule DnnModule-DnnForge-LatestArticles DnnModule-432">
            <a name="432"></a>
            <div class="c_DNN6_bgGeenV c_DNN6">
                <div class="Title"><span id="dnn_ctr432_dnnTITLE_titleLabel" class="Head"><?php echo $main_category["lang"]["title"];#echo $post["lang"]["title"]?></span>

                </div>
                <div style="float:left;"></div>
                <div id="dnn_ctr432_ContentPane" class="content">
                    <?php echo $post["lang"]["body"]?>
                </div>
                <?php echo render("partials/blocks/share",array("url_share"=>$url_share));?>
            </div>
        </div>
    </div>
    
</div>
<?php echo render("modules/".$module."/sidebar")?>
<div class="clear"></div>
     