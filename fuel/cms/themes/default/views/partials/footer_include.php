
<?php
  echo Asset::js("jquery-1.8.2.js");
  echo Asset::js("jquery-ui.js");
  echo Asset::js("jquery-ui-1.9.0.custom.min.js");
  echo Asset::js("jquery-ui-tabs-rotate.js");
  echo Asset::js("jquery.mousewheel.js");
 # echo Asset::js("jquery.js");
  echo Asset::js("jquery.jscrollpane.min.js");
  #echo Asset::js("datetime.js");
  
  #echo Asset::js("AAAAAAAAAAAAAAA.js");
  #echo Asset::js("AAAAAAAAAAAAAAA.js");
  #echo Asset::js("AAAAAAAAAAAAAAA.js");
?>
  <script type="text/javascript">
      $(document).ready(function() {
          $("#featured").tabs({
              fx: {
                  opacity: "toggle"
              }
          }).tabs("rotate", 5000, true);
      });
      $(function() {
          $('.scroll-pane').jScrollPane();
      });
  </script>