<div class="share-block">
<span><i class="fas fa-share-alt"></i></span>
<a class="icon-item" href="http://www.facebook.com/share.php?u=<?php echo $url_share;?>" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><i class="fab fa-facebook-f"></i></a>
<a class="icon-item" href="https://plus.google.com/share?url=<?php echo $url_share;?>" onclick="window.open(this.href, 'PLwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><i class="fab fa-google-plus-g"></i></a>
<a class="icon-item" href="http://twitter.com/share?url=<?php echo $url_share;?>&amp;text=<?php #echo htmlentities($p["lang"]["title"]); ?>" onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><i class="fab fa-twitter"></i></a>
</div>