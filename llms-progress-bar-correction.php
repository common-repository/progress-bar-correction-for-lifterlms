<?php
/*
Plugin Name: Progress Bar Correction For LifterLMS
Description: It updates the course progress bar of LifterLMS that in many situations doesn't work as expected.
Author: Jose Mortellaro
Author URI: https://jjosemortellaro.com
Domain Path: /languages/
Text Domain: progress-bar-correction-for-lifterlms
Version: 0.0.2
*/
/*  This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'shutdown',function(){
  if( class_exists( 'LifterLMS' ) && !isset( $_REQUEST['enrolled_in'] ) ) {
?>
  <script id="llms-correct-progress-bar">
  function eos_llms_cpb_init(){
    var pis=document.getElementsByClassName('progress__indicator'),
      pib=document.getElementsByClassName('progress-bar-complete'),
      l=document.getElementsByClassName('llms-lesson'),
      lc=document.querySelectorAll('.llms-lesson-complete.done');
    if(pis && pis.length>0 && l && l.length>0 && lc && lc.length>0){
      var p=parseInt(1000*lc.length/l.length)/10;
      for(var n=0;n<pis.length;++n){
        pis[n].innerHTML=p + '%';
        pib[n].style.width = p + '%';
      }

    }
  }
  eos_llms_cpb_init();
  </script>
<?php
  }
} );
