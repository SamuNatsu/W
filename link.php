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
        $content = $this->content;
        emotionContent($content, $this->options->themeUrl);
        ?>
        <div class="friendLinks">
            <?php formatOut($this->options->links); ?>
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