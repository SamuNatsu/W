<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
?>

</div>
<!-- end main -->

<div id="footer" class="clear">
    <p style="text-align:left;">Copyright &copy; <?php echo date('Y'); ?> <a href="<?php Helper::options()->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved.</p>
    <p style="text-align:left;">Theme <a href="https://github.com/youranreus/W">W</a> Made by <a href="https://季悠然.space">季悠然</a> | Modified by <a href="https://rainiar.top">Rainiar</a> as Theme <a href="https://github.com/SamuNatsu/WR">WR</a></p>
    <p style="text-align:left;">Run for <?php getBuildTime($this->options->createDate); ?></p>
    <p class="right"><a href="http://beian.miit.gov.cn/"><?php $this->options->ICP(); ?></a></p>
</div>
<!-- end #footer -->

<?php $this->need('sliderbar.php'); ?>

<img id="gototop" style="display:none;" src="<?php $this->options->themeUrl('ico/top.svg'); ?>"></img>

<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload/dist/lazyload.min.js"></script>
<script>
    lazyloadReady();
    var lazyLoadInstance = new LazyLoad();
    var pjax = new Pjax({
        elements: 'a:not([no-pjax])',
        selectors: ['title', '#main']
    });
    function pjaxSendCallback() {
        if ($("#sliderbar").hasClass("sliderbar-show"))
            sliderbar_toggle();
        topbar.show();
    }
    function pjaxCompleteCallback() {
        autoRun();
        $("#gototop").click(scrollTop);
        lazyloadReady();
        lazyLoadInstance.update();
        Prism.highlightAll();
        topbar.hide();
    }
    document.addEventListener("pjax:send", pjaxSendCallback);
    document.addEventListener("pjax:complete", pjaxCompleteCallback);
</script>

<?php bdNewsOut($this->options->bDays); ?>

<?php $this->footer(); ?>

</body>
</html>

<?php
$html_source = ob_get_contents();
ob_clean();
if ($this->options->enableCompressHTML == 1)
    echo compressHtml($html_source);
else
    echo $html_source;
ob_end_flush();
?>