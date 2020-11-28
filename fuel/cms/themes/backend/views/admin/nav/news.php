<li><a><i class="fa fa-rss"></i><?php echo l("news.title");?><span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li class="sub_menu"><a href="<?php echo Uri::create("admin/news")?>"><?php echo l("Posts");?></a></li>
    <li class="sub_menu"><a href="<?php echo Uri::create("admin/news/create")?>"><?php echo l("Add Post");?></a></li>
    <li class="sub_menu"><a href="<?php echo Uri::create("admin/news/category")?>"><?php echo l("Categories");?></a></li>
  </ul>
</li>