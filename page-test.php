<?php 
/*
 * Template Name: Test 
*/
$browser = get_browser(null, true);
$browser_name = $browser['browser'];
$browser_version = $browser['version'];

?>
<pre>
    <?php var_export($browser); ?>
    <p>Name : <?php echo $browser_name; ?></p>
    <p>Version : <?php echo $browser_version; ?></p>
</pre>
