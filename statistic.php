<?php
/**
* 统计页面
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
statUpdate($this);
$this->need('header.php');
?>

<style>
    .stat{text-align:center;font-size:1.5em}
    .stat span{margin:0 20px;display:inline-block}
    .stat span span{margin:0;font-size:0.5em}
    .inc{color:rgba(255,0,0,255)}
    .dec{color:rgba(0,255,0,255)}
    .ib{display:inline-block}
</style>

<div id="articleBody">
    <div id="articleContent" class="typo">
        <?php
        $content = $this->content;
        emotionContent($content, $this->options->themeUrl);
        ?>
        <hr/>
        <div class="stat"><b id="rld">1970.01.01</b></div>
        <div class="stat"><b id="rlt">00:00:00 CST+8</b></div>
        <div class="stat">
            <span><b>总阅读量：<?php echo $this->fields->total_view; ?></b><?php deltaOut($this->fields->total_view - $this->fields->total_view_old); ?></span>
            <span><b>总文章数：<?php echo $this->fields->total_post; ?></b><?php deltaOut($this->fields->total_post - $this->fields->total_post_old); ?></span>
            <span><b>总评论数：<?php echo $this->fields->total_comment; ?></b><?php deltaOut($this->fields->total_comment - $this->fields->total_comment_old); ?></span>
        </div>
        <div class="stat">
            <span title="越高越鸽"><b>鸽子指数：<?php guguOut($this); ?></b></span>
            <span title="图一乐指数"><b>博客活跃指数：<?php activeOut($this); ?></b></span>
        </div>
        <hr/>
        <p>数据上次更新于：<span class="ib"><?php echo date('Y年n月j日 | H:i:s', $this->fields->last_update); ?></span></p>
        <p>变化统计时间段：<span class="ib"><?php echo date('Y年n月j日 | H:i:s', $this->fields->last_update_old) . ' 到 ' . date('Y年n月j日 | H:i:s', $this->fields->last_update); ?></span></p>
        <p style="text-align:right;">*本站技术力有限，仅在访问数据统计页面时才刷新统计数据</p>
    </div>

    <div id="articleInfo">
        <p>文档最后编辑于<?php echo formatTime($this->modified); ?></p>
    </div>
</div>
<!-- end #articleBody-->

<script>
    var tm = new Date("<?php echo date('F j, Y H:i:s'); ?>");
    var y = tm.getFullYear(), m = tm.getMonth() + 1, d = tm.getDate(), hh = tm.getHours(), mm = tm.getMinutes(), ss = tm.getSeconds(), dt = -tm.getTimezoneOffset() / 60;
    $("#rld").text(y.toString() + "." + (m < 10 ? "0" : "") + m.toString() + "." + (d < 10 ? "0" : "") + d.toString());
    $("#rlt").text((hh < 10 ? "0" : "") + hh.toString() + ":" + (mm < 10 ? "0" : "") + mm.toString() + ":" + (ss < 10 ? "0" : "") + ss.toString() + " GMT" + (dt >= 0 ? "+" : "") + dt.toString());
    var itv = setInterval(function() {
        ++ss;
        if (ss >= 60) {
            ++mm;
            ss = 0;
        }
        if (mm >= 60) {
            ++hh;
            mm = 0;
        }
        if (hh >= 24) {
            hh = 0;
            y = new Date().getFullYear();
            m = new Date().getMonth() + 1;
            d = new Date().getDate();
            $("#rld").text(y.toString() + "." + (m < 10 ? "0" : "") + m.toString() + "." + (d < 10 ? "0" : "") + d.toString());
        }
        $("#rlt").text((hh < 10 ? "0" : "") + hh.toString() + ":" + (mm < 10 ? "0" : "") + mm.toString() + ":" + (ss < 10 ? "0" : "") + ss.toString() + " GMT" + (dt >= 0 ? "+" : "") + dt.toString());
    }, 1000);
</script>

<?php
if ($this->options->CommentSwitcher == 0)
    $this->need('comments.php');
$this->need('footer.php');
?>