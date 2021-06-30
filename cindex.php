<?php
/**
* 自定义主页
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');
?>

<style>
    @keyframes shake{25%{transform:rotate(15deg)}75%{transform:rotate(-15deg)}}
    #grv{width:200px;height:200px;border-radius:100%!important}
    #grv:hover{animation-name:shake;animation-duration:.1s;animation-timing-function:linear;animation-iteration-count:infinite}
    .mls{text-align:center}
    .mls div{font-size:1.5em;display:inline-block;margin:0 20px}
    .sel:hover{animation-name:shake;animation-duration:.1s;animation-timing-function:linear}
    <?php if ($this->user->pass('administrator', true)): ?>
    #tip{float:left;position:absolute;font-weight:bold;color:rgba(0,0,0,.5);transition-duration:.5s}
    #tip:hover{color:rgba(0,0,0,1)}
    <?php endif; ?>
</style>

<?php if ($this->user->pass('administrator', true)): ?>
<script>
    function helpShow() {
        alert('在自定义字段中添加项目以自定义主页：\nblog_url:(string) 文章列表地址\nabout_url:(string) 关于页面地址\nlinks_url:(string) 友链页面地址\n    *以上三个项目如果没有，则不会显示相应跳转按钮\n\nurl_(n):(json) 添加一个跳转链接按钮；n为一个整数，代表按钮次序，小的在前；json中需要包含name:(string)和url:(string)，代表显示名称和链接。例：url_1:{"name":"API Document","url":"/api.html"}，字段名称为url_1，显示名称为API Document，跳转链接为/api.html');
    }
</script>
<?php endif; ?>

<div id="articleBody">
    <div id="articleContent" class="typo">
        <?php if ($this->user->pass('administrator', true)): ?>
        <div id="tip"><a href="#" onclick="helpShow()" title="自定义帮助">HELP</a></div>
        <?php endif; ?>

        <?php if ($this->options->avatarUrl != ''): ?>
        <img id="grv" src="<?php echo $this->options->avatarUrl; ?>"/>
        <?php else: ?>
        <img id="grv" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, '200px', '', ''); ?>" no-lazy/>
        <?php endif; ?>

        <div class="mls">
            <?php if ($this->fields->blog_url != NULL): ?>
            <div class="sel"><a href="<?php echo $this->fields->blog_url; ?>"><b>Blog</b></a></div>
            <?php endif; ?>
            <?php if ($this->fields->about_url != NULL): ?>
            <div class="sel"><a href="<?php echo $this->fields->about_url; ?>"><b>About</b></a></div>
            <?php endif; ?>
            <?php if ($this->fields->links_url != NULL): ?>
            <div class="sel"><a href="<?php echo $this->fields->links_url; ?>"><b>Links</b></a></div>
            <?php endif; ?>
        </div>

        <div class="mls">
            <?php indexFields($this->fields); ?>
        </div>

        <?php
        if(!preg_match('/<!--more-->([\s\S]*)/', $this->content, $content))
            emotionContent($this->content, $this->options->themeUrl);
        else 
            emotionContent($content[1], $this->options->themeUrl);
        ?>
    </div>
</div>
<!-- end #articleBody-->

<?php $this->need('footer.php'); ?>