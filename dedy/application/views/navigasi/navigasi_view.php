<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_0 = '';

if($active_index == 0){
    $active_0 = 'class="active"';
}
?>
<li <?php echo $active_0;?>><a href="<?php echo get_controller("home"); ?>"><i class="fa fa-desktop"></i> <span>Home</span></a></li>