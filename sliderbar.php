<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
?>

<div id="sliderbar">
    <div class="sliderbar-container">
        <div id="sliderbar-profile" class="sliderbar-content clear">
            <div id="sliderbar-profile-meta" class="left">
                <?php if ($this->options->avatarUrl != ''): ?>
                <img id="sliderbar-profile-avatar" src="<?php echo $this->options->avatarUrl; ?>"/>
                <?php else: ?>
                <img id="sliderbar-profile-avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, '', '', ''); ?>"/>
                <?php endif; ?>
            </div>

            <div id="sliderbar-profile-social" class="right">
                <div class="sliderbar-profile-content">
                    <h2><a href="<?php Helper::options()->siteUrl(); ?>"><?php $this->author(); ?></a></h2>
                    <?php if ($this->options->bilibiliUrl != ''): ?>
                    <a href="<?php echo $this->options->bilibiliUrl; ?>"><img class="bili-ico" src="<?php $this->options->themeUrl('ico/bilibili.svg?v=2.0'); ?>"></img></a>
                    <?php endif; ?>

                    <?php if ($this->options->GHUrl != ''): ?>
                    <a href="<?php echo $this->options->GHUrl; ?>"><img class="github-ico" src="<?php $this->options->themeUrl('ico/github.svg?v=2.0'); ?>"></img></a>
                    <?php endif; ?>

                    <?php if ($this->options->TGUrl != ''): ?>
                    <a href="<?php echo $this->options->TGUrl; ?>"><img src="<?php $this->options->themeUrl('ico/telegram.svg?v=2.0'); ?>"></img></a>
                    <?php endif; ?>

                    <?php if ($this->options->weiboUrl != ''): ?>
                    <a href="<?php echo $this->options->weiboUrl; ?>"><img src="<?php $this->options->themeUrl('ico/weibo.svg?v=2.0'); ?>"></img></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-background" style="background-image: url(<?php echo $this->options->profileBG; ?>);"></div>
        </div>
        
        <?php if ($this->user->pass('administrator', true)): ?>
        <div class="sliderbar-content" id="sliderbar-menu">
            <a href="<?php $this->options->adminUrl(); ?>" target="_blank" no-pjax>进入后台</a>
            <a href="/action/logout" no-pjax>登出</a>
        </div>
        <?php endif; ?>
        
        <div class="sliderbar-content" id="sliderbar-menu">
            <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <input type="text" id="s" name="s" class="text" placeholder="输入关键字搜索"/>
                <button type="submit" class="submit">搜索</button>
            </form>
        </div>

        <div class="sliderbar-content" id="sliderbar-menu">
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <a href="/" title="首页">首页</a>
            <?php while ($pages->next()): ?>
            <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
            <?php endwhile; ?>
        </div>

        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <?php if ($category->have()): ?>
        <div class="sliderbar-content" id="sliderbar-menu">
            <h3 style="text-align: center;"><b>分类</b></h3>
            <?php while ($category->next()): ?>
            <a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>">
                <?php
                $category->name();
                echo ' (';
                $category->count();
                echo ')';
                ?>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <?php if ($this->options->CommentSwitcher == 1 && $this->is('single')): ?>
        <div id="sliderbar-comments" class="sliderbar-content">
            <?php $this->need('comments.php'); ?>
        </div>
        <?php endif; ?>

        <script defer>
            if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent))
                $(".sliderbar-container").append('<div class="sliderbar-content" id="sliderbar-hitokoto hitokoto"><a href="#" id="hitokoto_text">「一言」获取中...</a><script>fetch("https://v1.hitokoto.cn/?c=b").then(response=>response.json()).then(data=>{$("#hitokoto_text").attr("href","https://hitokoto.cn/?uuid="+data.uuid);$("#hitokoto_text").text(data.hitokoto+"——"+data.from);}).catch(console.error);<\/script><\/div>');
        </script>
    </div>
</div>

<div id="menu-wrap" onclick="sliderbar_toggle()"></div>
<img id="menu" src="<?php $this->options->themeUrl('ico/menu.svg?v=2.0'); ?>" onclick="sliderbar_toggle()"/>
<img id="night-mode" src="<?php $this->options->themeUrl('ico/night.svg?v=2.0'); ?>" onclick="switchNightMode()"/>