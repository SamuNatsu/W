<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
?>

</div>
<!-- end main -->

<div id="footer" class="clear">
    <p style="text-align:left;">Copyright &copy; <?php echo date('Y')?> <a href="<?php Helper::options()->siteUrl()?>"><?php $this->options->title()?></a>. All Rights Reserved.</p>
    <p style="text-align:left;">Theme <a href="https://github.com/youranreus/W">W</a> Made by <a href="https://季悠然.space">季悠然</a> | Modified by <a href="https://rainiar.top">Rainiar</a> as Theme <a href="https://github.com/SamuNatsu/WR">WR</a></p>
    <p style="text-align:left;">Run for <?php getBuildTime($this->options->createDate)?></p>
    <p class="right"><a href="http://beian.miit.gov.cn/"><?php $this->options->ICP()?></a></p>
</div>
<!-- end #footer -->

<?php $this->need('sliderbar.php')?>

<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload/dist/lazyload.min.js"></script>
</body>

<img id="gototop" style="display:none;" src="<?php $this->options->themeUrl('ico/top.svg')?>"></img>
<script data-no-instant src="<?php $this->options->themeUrl('W.js?v=1.50')?>"></script>
<script>
    lazyloadReady();
    var lazyLoadInstance = new LazyLoad();
</script>
<?php if ($this->options->enableInstantclick == 1):?>
<script src="https://cdn.bootcdn.net/ajax/libs/instantclick/3.1.0/instantclick.js"></script>
<script data-no-instant>
    InstantClick.on('change', function(isInitialLoad) {
        if (isInitialLoad === false) {
            autoRun();
            gototop.addEventListener('click', scrollTop, false);
            if(typeof(meting_api) !== 'undefined')
                loadMeting();
        }
    });
    InstantClick.init();
</script>
<?php endif;?>

<script src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.0/W/prism.js"></script>
<?php $this->footer()?>
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