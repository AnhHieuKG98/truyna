<!DOCTYPE html>
<html class="no-js" lang="ja">
  <head>
    <title><?php echo $title; ?></title>
    <?php echo $meta_head;?>
  </head>
  <body class="page-top">
    <div class="main">
      <?php if(isset($banners)){?>
      <section class="section-top-banner">
        <div class="content-banner">
          <div class="slider-banner">
            <?php foreach($banners as $banner):?>
            <div class="item-slider"><img src="<?php echo $banner->image_full;?>" alt="img"/>
              <div class="caption text-center"><?php echo $banner->lang->summary;?></div>
            </div><?php endforeach;?>
          </div>
        </div>
        <h1 class="logo"><a href="<?php echo Uri::base();?>"><?php echo Asset::img("common/logo.png")?></a>
        </h1>
        <div class="block-social">
          <?php $soc_facebook = \Registry::get_setting("social.facebook");?>
          <?php $soc_twitter = \Registry::get_setting("social.twitter");?>
          <?php $soc_instagram = \Registry::get_setting("social.instagram");?>
          <?php $soc_google = \Registry::get_setting("social.google");?>
          <?php $soc_pinterest = \Registry::get_setting("social.pinterest");?>
          <a target="_blank" class="item" href="#"><span class="icon"><?php echo Asset::img("common/icon_calendar.svg")?></span><span class="txt-social">booking now</span></a>
          <a target="_blank" class="item" href="<?php echo $soc_facebook ? $soc_facebook : "#";?>"><span class="icon"><?php echo Asset::img("common/icon_face.svg")?></span><span class="txt-social">facebook</span></a>
          <a target="_blank" class="item" href="#"><span class="icon"><?php echo Asset::img("common/icon_youtube.svg")?></span><span class="txt-social">youtube</span></a>
          <a target="_blank" class="item" href="<?php echo $soc_instagram ? $soc_instagram : "#";?>"><span class="icon"><?php echo Asset::img("common/icon_instar.svg")?></span><span class="txt-social">instargram</span></a>
          <a target="_blank" class="item" href="#"><span class="icon"><?php echo Asset::img("common/icon_flaticon.svg")?></span><span class="txt-social">flaticon</span></a>
        </div>
        <div class="block-check">
          <div class="title-check">Check your Availability</div>
          <div class="contnet-desc-check">
            <div class="item">
              <div class="desc date-time">
                <input type="text" value="Check In Date" id="checkin">
              </div>
            </div>
            <div class="item">
              <div class="desc date-time">
                <input type="text" value="Check Out Date" id="checkout">
              </div>
            </div>
            <div class="item">
              <div class="desc select-desc">
                <select>
                  <option>Rooms</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
            <div class="item">
              <div class="desc select-desc">
                <select>
                  <option>Childrens</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
            <div class="item">
              <div class="desc select-desc">
                <select>
                  <option>Adults</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
            <div class="item"><a class="btn-check" href="#"><span class="txt-btn">check availability</span></a>
            </div>
          </div>
        </div>
      </section><?php } ?>
      <header class="header">
        <div class="header-inner">
          <div class="menu">
            <div class="hamburger">
              <div class="img-hamguder"><?php echo Asset::img("common/icon_menu.svg",array("class"=>"open","alt"=>"hambuger"))?><?php echo Asset::img("common/close.png",array("class"=>"close","alt"=>"hambuger"))?>
              </div><span class="txt-menu">menu</span>
            </div><a class="phone" href="tel:02838222999"><?php echo Asset::img("common/call.png",array("class"=>"","alt"=>"icon-phone"))?><span class="txt-phone">(+84) 28 3822 2999</span></a>
            <nav class="nav-header">
              <div class="nav-inner">
                <div class="list-menu">
                  <div class="list-item">
                    <div class="item-menu"><a class="btn-nav current" href="<?php echo Uri::base();?>"><span class="txt-nav">home</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">ABOUT US</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">SPECIAL OFFERS</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">ROOMS & SUITES</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">DINING</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">MEETINGS & EVENT</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">FACILITIES</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">DISCOVER SAIGON</span></a></div>
                    <div class="item-menu"><a class="btn-nav" href="./"><span class="txt-nav">GALLERY</span></a></div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
          <div class="contact-header">
            <div class="list-content">
              <div class="item price-item"><span class="txt">Current:</span><span class="price">$ Dollar</span></div><a class="item" href="#">
              <?php echo Asset::img("common/icon_login.svg",array("class"=>"","alt"=>"login"))?>
              <span class="txt">Login</span></a>
              <a class="item" href="#">
                <?php echo Asset::img("common/user.svg",array("class"=>"","alt"=>"register"))?><span class="txt">Register</span></a><a class="item" href="#"><?php echo Asset::img("common/icon_search.svg",array("class"=>"","alt"=>""))?></a>
            </div>
            <div class="language"><a class="item current" href="#"><span class="txt-language">en</span></a><a class="item" href="#"><span class="txt-language">vn</span></a>
            </div>
          </div>
        </div>
      </header>
      <?php echo $content;?>
      <footer class="footer">
        <div class="infor-company">
          <div class="container">
            <div class="col-md-12 col-lg-4 item"><?php echo Asset::img("common/logo.png",array("class"=>"logo-footer","alt"=>""))?>
              <div class="call">
                <div class="title">saigon prince hotel</div><a class="icon-phone" href="tel:02838222999"><span class="icon"><?php echo Asset::img("common/phone_red.png",array("class"=>"","alt"=>""))?></span>(+84) 28 3822 2999</a>
              </div>
            </div>
            <div class="col-md-12 col-lg-4 item location"><span class="icon"><?php echo Asset::img("common/location.png",array("class"=>"","alt"=>""))?></span>63 Nguyen Hue Boulevard, Ben Nghe Ward, District 1, Ho Chi Minh</div>
            <div class="col-md-12 col-lg-4 item mail"><span class="icon"><?php echo Asset::img("common/mail_red.png",array("class"=>"","alt"=>""))?></span>info@saigonprincehotel.com</div>
          </div>
        </div>
        <div class="sitemap">
          <div class="container list-sitemap">
            <div class="col-xs-6 col-sm-6 col-md-2 item">
              <ul>
                <li class="title">About us</li>
                <li><a href="#">Introduction</a>
                </li>
                <li><a href="#">Careers</a>
                </li>
                <li><a href="#">Contact us</a>
                </li>
              </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 item">
              <ul>
                <li class="title">Agents & Media</li>
                <li><a href="#">News</a>
                </li>
                <li><a href="#">Factsheet</a>
                </li>
                <li><a href="#">Logo</a>
                </li>
                <li><a href="#">E-Brochure</a>
                </li>
                <li><a href="#">Photos</a>
                </li>
              </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 item">
              <ul>
                <li class="title">Quick link</li>
                <li><a href="#">Sitemap</a>
                </li>
                <li><a href="#">Private Policy</a>
                </li>
                <li><a href="#">Security & Safety</a>
                </li>
                <li><a href="#">Terms & Conditions </a>
                </li>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 item">
              <ul>
                <li class="title">Connect</li>
                <li class="facebook"><a href="#">Facebook.com/saigonprince</a>
                </li>
                <li class="instargram"><a href="#">Instagram.com/saigonprince</a>
                </li>
                <li class="tripadvisor"><a href="#">Tripadvisor.com/saigonprince</a>
                </li>
                <li class="booking"><a href="#">Booking.com/saigonprince</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="coppyright">
          <div class="container-fluid"><span>&copy; 2018</span>saigonprincehotel.com.<span> All Rights Reserved</span>
            <div class="btn-to-top"><?php echo Asset::img("common/to-top.png",array("class"=>"","alt"=>"to-top"))?>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <?php echo $footer_include;?>
  </body>
</html>