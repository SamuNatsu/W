<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
ob_start();
?>

<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
    <?php
        $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - ');
        $this->options->title();
    ?>
    </title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.min.css?v=2.0'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.0/W/prism.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.0/W/typo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.0/G/CSS/OwO.min.css">
    <link href="<?php $this->options->themeUrl('css/dark.min.css?v=2.0'); ?>" rel="<?php if($_COOKIE['night'] != '1') echo 'alternate '; ?>stylesheet" type="text/css" title="dark">

    <link rel="icon" type="image/png" href="<?php $this->options->logoUrl(); ?>">
    <link href="/favicon.ico" rel="icon">
    <link rel="apple-touch-icon-precomposed" href="/favicon.ico">

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pjax/pjax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload/dist/lazyload.min.js"></script>

    <script src="<?php $this->options->themeUrl('js/WR.js?v=2.0'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/topbar.min.js?v=1.0.0'); ?>"></script>

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
    <?php if ($this->is('post')): ?>
        <meta property="og:type" content="article"/>
        <meta property="article:published_time" content="<?php $this->date('c'); ?>"/>
        <meta property="article:author" content="<?php $this->author(); ?>"/>
        <meta property="article:published_first" content="<?php $this->options->title(); ?>, <?php $this->permalink(); ?>"/>
        <meta property="og:title" content="<?php $this->title(); ?>"/>
        <meta property="og:url" content="<?php $this->permalink(); ?>"/>
    <?php endif; ?>

    <script>
        if (document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") == '') {
            if (new Date().getHours() > 22 || new Date().getHours() < 6) {
                $('link[title="dark"]').removeAttr("disabled");
                document.cookie = "night=1;path=/";
                console.log('夜间模式开启');
            }
            else {
                document.cookie = "night=0;path=/";
                console.log('夜间模式关闭');
            }
        }
        else {
            var night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
            if (night == '0') {
                $('link[title="dark"]').attr("disabled", "");
                console.log('夜间模式关闭');
            }
            else if (night == '1') {
                $('link[title="dark"]').removeAttr("disabled");
                console.log('夜间模式开启');
            }
        }
    </script>

    <style>
        <?php if ($this->options->enableImgShadow == 0): ?>
        .typo img{-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
        <?php endif;?>

        <?php if ($this->options->CommentSwitcher == 0): ?>
        #articleInfo{margin-bottom:20px}
        <?php endif;?>

        <?php if ($this->options->cardSliderbar == 1): ?>
        @media screen and (max-width: 768px){
        .sliderbar-content{border-radius:10px;background:rgba(255,255,255,0.02);margin-bottom:15px}
        .sliderbar-container{padding:10px}
        }
        <?php endif; ?>
        
        html {
            background-image:url(<?php echo $this->options->bodyBG; ?>);
            background-repeat:no-repeat;
            background-attachment:fixed;
            background-size:cover;
            <?php echo $this->options->bodyCSS; ?>
        }
    </style>
</head>

<body>

<!-- main -->
<div id="main">
    <div id="header">
    <h2>
        <?php if($this->is('index')): ?>
        <a href="/" title="<?php Helper::options()->siteUrl(); ?>"><?php $this->options->title(); ?></a>
        <?php elseif($this->is('post') or $this->is('page')): ?>
        <a href="#" onclick="window.history.go(-1)"><?php $this->title(); ?><img src="<?php $this->options->themeUrl('ico/home.svg'); ?>"></img></a>
        <?php elseif($this->is('archive')): ?>
        <a href="#" onclick="window.history.go(-1)">
        <?php
            if ($this->getArchiveType() == 'front')
                $this->setArchiveTitle('文章');
            $this->archiveTitle(array(
                'category'  =>  _t('「%s」'),
                'search'    =>  _t('「%s」'),
                'tag'       =>  _t('「%s」'),
                'author'    =>  _t('「%s」发布的文章')
            ), '', '');
        ?>
        <img src="<?php $this->options->themeUrl('ico/home.svg'); ?>"></img></a>
        <?php else: ?>
        <a href="/" title="<?php Helper::options()->siteUrl(); ?>"><?php $this->options->title(); ?></a>
        <?php endif; ?>
    </h2>

    <?php if($this->is('post')): ?>
    <span><?php $this->author(); ?> · <?php $this->category(','); ?> · <?php $this->date(); ?></span>
    <?php else: ?>  
    <span><?php $this->options->description(); ?></span>
    <?php endif; ?>
</div>

<?php if($this->is('post') or $this->is('page')): ?>
<div id="header-f">
    <h2><a href="#" onclick="window.history.go(-1)"><?php $this->title(); ?></a></h2>
</div>
<?php endif; ?>