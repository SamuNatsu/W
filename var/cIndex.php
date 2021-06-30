<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function indexFields($fields) {
    $uls = array();
    foreach ($fields as $key => $value)
        if (substr($key, 0, 4) == 'url_')
            $uls[substr($key, 4)] = $value;
    ksort($uls);
    foreach ($uls as $key => $value) {
        $jn = json_decode($value);
        if (!$jn)
            continue;
?>
<div class="sel"><a href="<?php echo $jn->url; ?>"><b><?php echo $jn->name; ?></b></a></div>
<?php
    }
}