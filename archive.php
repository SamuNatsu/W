<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
$this->need('header.php');
?>

<div id="article-list">
    <?php if ($this->have()): ?>
	<?php while ($this->next()): ?>
    <div class="article-item">
        <h2><a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a></h2>
        <span><?php $this->author(); ?> · <?php $this->category(' · '); ?> · <?php echo formatTime($this->created); ?> | <span title="阅读量：<?php viewOut($this->fields); ?>"><img class="comment-ico" src="<?php $this->options->themeUrl('ico/view.svg?v=2.0'); ?>"></img><?php viewOut($this->fields, " %d "); ?></span><?php if ($this->allowComment): ?><span title="评论数：<?php $this->commentsNum(); ?>"><img class="comment-ico" src="<?php $this->options->themeUrl('ico/comment.svg?v=2.0'); ?>"></img><?php $this->commentsNum(" %d"); ?></span><?php endif; ?></span>
        <br/>
        <p><?php $this->excerpt(50); ?></p>
    </div>
    <?php endwhile; ?>
    <?php else: ?>
    <article class="post">
        <h2 class="post-title"><?php echo '⁄(⁄⁄•⁄ω⁄•⁄⁄)⁄什么也没有找到呢'; ?></h2>
    </article>
    <?php endif;?>

    <div class="clear changePage">
        <?php
        $this->pageLink('< 返回', 'prev');
        $this->pageLink('更多 >', 'next');
        ?>
    </div>
</div>
<!-- end #main -->

<?php $this->need('footer.php'); ?>