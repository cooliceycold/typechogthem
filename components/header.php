<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) 
    exit;
$minInfix = !defined('__TYPECHO_DEBUG__') || __TYPECHO_DEBUG__ != true ? ".min" : "";
$devTag = !defined('__TYPECHO_DEBUG__') || __TYPECHO_DEBUG__ != true ? G::$version : time(); 

if (isset($_POST['DYLM'])) {
    exit(G::DYLM('add'));
}
?>
<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//source.ahdark.com">
    <link rel="icon" type="image/png" href="<?php $this->options->favicon(); ?>">
    <link href="<?php $this->options->favicon(); ?>" rel="icon">
    <link rel='dns-prefetch' href='//s.w.org'>
    <link rel="apple-touch-icon-precomposed" href="<?php $this->options->favicon(); ?>">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' | '); ?><?php $this->options->title(); ?></title>
    <style>
        /* 输出自定义主题色 */
        <?php echo G::setCSSValues(); ?>
    </style>

    <?php if($this->options->enableKatex == 1): ?>
        <link rel="stylesheet" href="<?php echo G::staticUrl('static/css/katex.min.css'); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo G::staticUrl('static/css/G.css'); ?>?v=<?php echo $devTag; ?>">
    <link rel="stylesheet alternate" href="<?php echo G::staticUrl("static/css/dark$minInfix.css?v=$devTag"); ?>" title="dark" disabled>

    <style>
        /* 设置自定义背景[颜色/图片] */
        html::before {
            <?php echo G::getBackground(); ?>
            <?php if ($this->options->repeatBackground): ?>
            background-repeat: repeat;
            -webkit-background-size: unset;
            -o-background-size: unset;
            background-size: unset;
            background-position: top left;
            <?php endif; ?>
        }

        <?php $this->options->customCSS(); ?>
    </style>
    <?php $this->header(); ?>
    <script src="<?php echo G::staticUrl('static/js/DPlayer.min.js'); ?>"></script>
    <script>
        <?php $this->options->customHeaderJS(); ?>
        
        window.G_CONFIG = {
            katex: <?php echo $this->options->enableKatex == 1 ? 'true' : 'false' ?>,
            imgUrl: "<?php echo G::staticUrl('static/img/'); ?>",
            autoTOC: <?php echo G::$config["enableDefaultTOC"] == 1 ? 'true' : 'false' ?>,
            nightSpan: "<?php echo G::$config["autoNightSpan"]; ?>",
            nightMode: "<?php echo G::$config["autoNightMode"]; ?>",
        };

        function custom_callback() {
            <?php echo $this->options->customPjaxCallback; ?>
        }
    </script>
</head>
<body>
<style>
footer{backdrop-filter: blur(2px)!important;background: rgba(50, 50,50,0.3)!important;}
#header{background: rgba(60, 60,60,0.7)!important;}
.article-item{background: rgba(250,250,250,0.6)!important;backdrop-filter: blur(6px)!important;}
.sliderbar-content{background: rgba(250,250,250,0.6)!important;backdrop-filter: blur(6px)!important;}
.profile-content i{opacity: 0!important;}
#widgets .widget{background: rgba(250,250,250,0.6)!important;backdrop-filter: blur(6px)!important;}
img{width: 100%;height: 100%;object-fit: cover;border-radius:30px!important;}
#post{background: rgba(250,250,250,0.4)!important;}
#post-banner{background: rgba(250,250,250,0)!important;}
#comments-textarea{background:url(https://mc.rslist.cf/get/@:icey.cf?theme=gelbooru-h);background-size: contain;background-repeat: no-repeat;background-position:center;background-color:rgba(255,255,255,0);backdrop-filter: blur(6px)!important;border-radius:30px!important;}
#comment-submit{background: rgba(250,250,250,0)!important;}
#comments-form{background: rgba(250,250,250,0.5)!important;}
#comments-textarea-wrap{background: rgba(250,250,250,0.3)!important;border-radius:30px!important;}
.comment-content{background: rgba(250,250,250,0.4)!important;backdrop-filter: blur(6px)!important;}
.post-toolbar-btn{background: rgba(250,250,250,0)!important;}
#page{background: rgba(250,250,250,0.4)!important;backdrop-filter: blur(6px)!important;}
#page-banner{background: rgba(250,250,250,0)!important;backdrop-filter: blur(6px)!important;}
.text{background: rgba(250,250,250,0.3)!important;backdrop-filter: blur(6px)!important;border-radius:20px!important;}
#OwO-container{background: rgba(250,250,250,0.4)!important;backdrop-filter: blur(6px)!important;}
.article-banner {opacity:0.8!important;}
.card-item article{background: rgba(50, 50,50,0.3)!important;backdrop-filter: blur(6px)!important;}
.card-cover{opacity:0.7!important;}
.PAP-banner div{opacity:0.7!important;}
.PAP-content>* {max-width: none;}
a.next {opacity: 0.5 !important;backdrop-filter: blur(6px)!important;}
a.prev {opacity: 0.5 !important;backdrop-filter: blur(6px)!important;}
</style>
<div id="main">
    <header id="header">
        <div id="header-title">
            <h2><?php $this->options->title(); ?></h2>
        </div>
        <div id="header-content">
            <div id="header-content-left">
                <p><?php $this->options->description(); ?></p>
            </div>
            <div id="header-content-right">
                <nav>
                    <a href="<?php $this->options->siteUrl() ?>" <?php if ($this->is('index')) : ?> class="nav-focus"<?php endif; ?>>首页</a>
                    <?php if ($this->options->enableIndexPage): ?>
                        <a href="<?php echo G::getArticlePath(); ?>" <?php if ($this->is('archive') or $this->is('post')) : ?> class="nav-focus"<?php endif; ?>>文章</a>
                    <?php endif; ?>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while ($pages->next()): ?>
                        <?php if (strtolower($pages->slug) == 'links' or strtolower($pages->slug) == 'about' or $pages->fields->headerDisplay == 1): ?>
                            <a
                                <?php if ($this->is('page', $pages->slug)): ?>class="nav-focus"<?php endif; ?>
                                href="<?php $pages->permalink(); ?>"
                                title="<?php $pages->title(); ?>"
                            ><?php $pages->title(); ?></a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php if ($this->options->enableHeaderSearch): ?>
                        <a href="#" class="search-form-input">搜索</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <?php if ($this->options->headerBackground != ''): ?>
            <img src="<?php $this->options->headerBackground(); ?>" alt="<?php $this->options->title(); ?>" id="header-background">
        <?php endif; ?>
    </header>
