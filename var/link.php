<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function linkOut($json) {
    $json = json_decode($json);
    if (!$json) {
        echo '<p style="text-align:center;"><b style="color:red;">[Links error]</b></p>';
        return;
    }
    foreach ($json as $key):
?>
<li>
    <a href="<?php echo $key->addr; ?>" title="<?php echo $key->name; ?> | <?php echo $key->sign; ?>" target="_blank"></a>
    <img src="<?php echo $key->avt; ?>"/>
    <div>
        <h3><?php echo $key->name; ?></h3>
        <span><?php echo $key->tag; ?></span>
        <p><?php echo $key->sign; ?></p>
    </div>
</li>
<?php
    endforeach;
}