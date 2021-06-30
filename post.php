<?php
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
    </div>

    <div class="blog-bottom-bar clear">
        <?php
        prev_post($this);
        next_post($this);
        ?>
    </div>

    <div id="articleInfo">
        <p class="tags">
            <?php
            echo '标签: ';
            $this->tags(', ', true, '⁄(⁄⁄•⁄ω⁄•⁄⁄)⁄什么也没有呢');
            ?>
        </p>
        <p>文档最后编辑于<?php echo formatTime($this->modified); ?></p>
    </div>
</div>
<!-- end #articleBody-->

<?php 
if ($this->options->CommentSwitcher == 0)
    $this->need('comments.php');
$this->need('footer.php');
?>