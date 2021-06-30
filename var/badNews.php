<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function bdNewsCSS($json) {
    $json = json_decode($json);
    $mm = date('m');
    $dd = date('d');
    if ($json)
        foreach ($json as $key)
            if (substr($key->date, 5, 2) == $mm && substr($key->date, 8, 2) == $dd) {
                echo 'filter:grayscale(1);-webkit-filter:grayscale(1);';
                return;
            }
}

function bdNewsOut($json) {
    $json = json_decode($json);
    $mm = date('m');
    $dd = date('d');
    $ar = array();
    if ($json)
        foreach ($json as $key)
            if (substr($key->date, 5, 2) == $mm && substr($key->date, 8, 2) == $dd) 
                array_push($ar, $key);
    if (!count($ar))
        return;
    usort($ar, function($a, $b) {
        if ($a->date == $b->date)
            return 0;
        return $a->date < $b->date ? -1 : 1;
    });
?>
<style>
    #badNews {
        width:310px;
        position:fixed;
        top:0px;
        right:0px;
        background-color:white;
        padding:10px;
        border-radius:5px;
        margin:5px;
        transition:all .5s;
        z-index:99999
    }
</style>
<div id="badNews">
    <p style="text-align:center;"><b>🕯永远纪念（点击收起）</b></p>
    <?php foreach ($ar as $key): ?>
    <p><b><?php echo $key->date; ?>：</b><?php echo $key->descr; ?></p>
    <?php endforeach; ?>
</div>
<script>
    $("#badNews").click(function() {
        $(this).attr("style", $(this).attr("style") == "" ? "transform:translateX(310px)" : "");
    });
</script>
<?php
}