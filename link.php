<?php
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');
?>

<div id="articleBody">
    <div id="articleContent" class="typo">
        <?php
        if(!preg_match('/<!--more-->([\s\S]*)/', $this->content, $content))
            emotionContent($this->content, $this->options->themeUrl);
        else 
            emotionContent($content[1], $this->options->themeUrl);
        ?>
        <div class="friendLinks">
            <?php linkOut($this->options->links); ?>
        </div>
    </div>

    <div id="articleInfo">
        <p>文档最后编辑于<?php echo formatTime($this->modified); ?></p>
    </div>
</div>
<!-- end #articleBody-->

<?php 
if ($this->options->CommentSwitcher == 0)
    $this->need('comments.php');
$this->need('footer.php');
?>