<?php


#namespace PHPWee;
#require_once(APPPATH."vendor/phpwee/src/CssMin/CssMin.php");
#require_once(APPPATH."vendor/phpwee/src/HtmlMin/HtmlMin.php");
#require_once(APPPATH."vendor/phpwee/src/JsMin/JsMin.php");

class Minify{
  
  //
  public static function minify_css_BK( $string = '' ) {
    $comments = <<<'EOS'
(?sx)
    # don't change anything inside of quotes
    ( "(?:[^"\\]++|\\.)*+" | '(?:[^'\\]++|\\.)*+' )
|
    # comments
    /\* (?> .*? \*/ )
EOS;

    $everything_else = <<<'EOS'
(?six)
    # don't change anything inside of quotes
    ( "(?:[^"\\]++|\\.)*+" | '(?:[^'\\]++|\\.)*+' )
|
    # spaces before and after ; and }
    \s*+ ; \s*+ ( } ) \s*+
|
    # all spaces around meta chars/operators (excluding + and -)
    \s*+ ( [*$~^|]?+= | [{};,>~] | !important\b ) \s*+
|
    # all spaces around + and - (in selectors only!)
    \s*([+-])\s*(?=[^}]*{)
|
    # spaces right of ( [ :
    ( [[(:] ) \s++
|
    # spaces left of ) ]
    \s++ ( [])] )
|
    # spaces left (and right) of : (but not in selectors)!
    \s+(:)(?![^\}]*\{)
|
    # spaces at beginning/end of string
    ^ \s++ | \s++ \z
|
    # double spaces to single
    (\s)\s+
EOS;

    $search_patterns  = array( "%{$comments}%", "%{$everything_else}%" );
    $replace_patterns = array( '$1', '$1$2$3$4$5$6$7$8' );

    return preg_replace( $search_patterns, $replace_patterns, $string );
    
 } 
  public static function minify_css($string){
    $string = preg_replace('!/\*.*?\*/!s','', $string);
    $string = preg_replace('/\n\s*\n/',"\n", $string);

    // space
    $string = preg_replace('/[\n\r \t]/',' ', $string);
    $string = preg_replace('/ +/',' ', $string);
    $string = preg_replace('/ ?([,:;{}]) ?/','$1',$string);

    // trailing;
    $string = preg_replace('/;}/','}',$string);
    return $string;
  }
  public static function minify_js($string){
    #$string = preg_replace('~//<!\[CDATA\[\s*|\s*//\]\]>~', '', $string);
    $string = preg_replace('/(\/\*[\w\'\s\r\n\*]*\*\/)|(\/\/[\w\s\']*)|(\<![\-\-\s\w\>\/]*\>)/', '', $string);
    $string = preg_replace( "/\n/", "", $string);
    #$string = str_replace(array(PHP_EOL, "\t"), '', $string);
    #$string = preg_replace( "/\r|\n/", "", $string);
    
    
    return $string;
  }
  //
  
  public static function css($files){
    
    $css_code = '';
    $merged_file_location = DOCROOT."themes/default/css/taki-min.css";
    if(!is_file($merged_file_location)){
      foreach($files as $file){
        $css_file_path = Asset::find_file($file, 'css');
        if  (file_exists($css_file_path)) {
          $css_code .=  file_get_contents($css_file_path);
        }
      }
      $css_code = self::minify_css($css_code);#compress css content
      file_put_contents ( $merged_file_location , $css_code);
    }
    
    $css_min_path = Asset::find_file("taki-min.css", 'css');
    $css_content = file_get_contents($css_min_path);
    $css_content = str_replace("../images/",\Uri::base(false)."themes/default/images/",$css_content);
    
  
    #return "<style class=\"tk-css\">".$css_content."</style>";
    
    return Asset::css("taki-min.css");
    
  }
  public static function js($files){
    $js_code = '';
    $merged_file_location = DOCROOT."themes/default/js/taki-min.js";
    if(!is_file($merged_file_location)){
      foreach($files as $file){
        $css_file_path = Asset::find_file($file, 'js');
        if  (file_exists($css_file_path)) {
          $js_code .=  file_get_contents($css_file_path);
        }
      }
      #$js_code = self::minify_js($js_code);#compress js content
      file_put_contents ( $merged_file_location , $js_code);
    }
    $file_js = Asset::find_file("taki-min.js","js");
    return "<script async src=\"".\Uri::base(false).$file_js."\"></script>";
    
  }
}
