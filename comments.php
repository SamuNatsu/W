<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
if ($this->is('page') && !$this->allow('comment'))
    return;
?>

<div id="comments">
    <h2 style="font-weight:600;font-size:1.5rem;padding-left:7px;margin-bottom:20px;">评论</h2>
    <?php 
        $this->comments()->to($comments);
        if ($comments->have()) {
            $comments->listComments();
            $comments->pageNav('<<', '>>');
        }
    ?>
    <?php if ($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
            <?php $comments->cancelReply(); ?>
        </div>

        <h3 id="response"><?php echo '让我也说点啥'; ?></h3>
        <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" role="form" class="clear">
            <?php if (!$this->user->hasLogin()): ?>
            <input type="text" name="author" id="author" class="text" placeholder="<?php echo '尊姓大名'; ?>" value="<?php $this->remember('author'); ?>" required/>
            <input type="email" name="mail" id="mail" class="text" placeholder="<?php echo '邮箱'; ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>/>
			<input type="url" name="url" id="url" class="text" placeholder="<?php echo 'https://'; ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>/>
            <?php endif; ?>

            <textarea name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            <button type="submit" class="submit"><?php echo '提交评论'; ?></button>

            <div class="OwO-logo" onclick="OwO_show()">
                <span>(OwO)</span>
            </div>
            <div id="OwO-container" class='display-none'>
                <?php $this->need('owo.php'); ?>
            </div>
        </form>
    </div>
    <?php else: ?>
    <h3><?php echo '评论已关闭'; ?></h3>
    <?php endif; ?>
</div>