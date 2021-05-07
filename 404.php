<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');
?>

<style>
body{background:none!important}
#header,#footer{display:none}
.h404{font-size:5rem;text-align:center;margin:100px 0 10px;opacity:0.3}
a{color:#000000;opacity:0.3;transition:opacity .2s}
a:hover{text-decoration:none;opacity:1.0}
</style>

<h3 class="h404"><b>4o4<br/>nOt FoUnD</b><h3>
<p style="text-align:center;"><b><a href="<?php Helper::options()->siteUrl()?>">&gt;&gt; Back To Home &lt;&lt;</a></b></p>

<?php $this->need('footer.php')?>