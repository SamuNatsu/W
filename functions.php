<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function themeConfig($form) {
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.5/G/CSS/S.css'/>";
    echo "<h2>W主题设置</h2>";
    
    $links = new Typecho_Widget_Helper_Form_Element_Textarea('links', NULL, NULL, _t('友情链接JSON'), _t('输入一个JSON数组，里面每个元素的都是对象<br/>对象中有name、addr、tag、sign和avt字段<br/>字段分别表示名字、博客地址、标签、签名和头像地址'));
    $form->addInput($links);

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);

    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('侧栏头像地址'), _t('填入一个你的头像 URL 地址, 留空则使用gravatar头像'));
    $form->addInput($avatarUrl);

    $bilibiliUrl = new Typecho_Widget_Helper_Form_Element_Text('bilibiliUrl', NULL, NULL, _t('侧栏B站地址'), _t('留空则不显示图标'));
    $form->addInput($bilibiliUrl);
    $weiboUrl = new Typecho_Widget_Helper_Form_Element_Text('weiboUrl', NULL, NULL, _t('侧栏微博地址'), _t('留空则不显示图标'));
    $form->addInput($weiboUrl);
    $TGUrl = new Typecho_Widget_Helper_Form_Element_Text('TGUrl', NULL, NULL, _t('侧栏Telegram地址'), _t('留空则不显示图标'));
    $form->addInput($TGUrl);
    $GHUrl = new Typecho_Widget_Helper_Form_Element_Text('GHUrl', NULL, NULL, _t('侧栏Github地址'), _t('留空则不显示图标'));
    $form->addInput($GHUrl);

    $ICP = new Typecho_Widget_Helper_Form_Element_Text('ICP', NULL, NULL, _t('ICP备案号'), _t('你的备案号是什么🦆'));
    $form->addInput($ICP);

    $createDate = new Typecho_Widget_Helper_Form_Element_Text('createDate', NULL, NULL, _t('建站日期'), _t('什么时候开始建站的🦆'));
    $form->addInput($createDate);

    $profileBG = new Typecho_Widget_Helper_Form_Element_Text('profileBG', NULL, NULL, _t('侧边栏profile背景图'), _t('https://...'));
    $form->addInput($profileBG);

    $bodyBG = new Typecho_Widget_Helper_Form_Element_Text('bodyBG', NULL, NULL, _t('博客背景图'), _t('https://...'));
    $form->addInput($bodyBG);
    $bodyCSS = new Typecho_Widget_Helper_Form_Element_Textarea('bodyCSS', NULL, NULL, _t('博客背景附加CSS属性'), _t('background-position:center;...'));
    $form->addInput($bodyCSS);

    $enableImgShadow = new Typecho_Widget_Helper_Form_Element_Radio('enableImgShadow', array(
        '1' => _t('是') ,
        '0' => _t('否')
    ) , '1', _t('给你的图片加上阴影') , _t('默认为开启'));
    $form->addInput($enableImgShadow);

    $enableCompressHTML = new Typecho_Widget_Helper_Form_Element_Radio('enableCompressHTML', array(
        '1' => _t('是') ,
        '0' => _t('否')
    ) , '1', _t('开启HTML压缩') , _t('默认为开启'));
    $form->addInput($enableCompressHTML);

    $CommentSwitcher = new Typecho_Widget_Helper_Form_Element_Radio('CommentSwitcher', array(
        '1' => _t('侧边栏') ,
        '0' => _t('文章末')
    ) , '1', _t('评论框位置') , _t('默认为侧边栏'));
    $form->addInput($CommentSwitcher);

    $cardSliderbar = new Typecho_Widget_Helper_Form_Element_Radio('cardSliderbar', array(
        '1' => _t('开启') ,
        '0' => _t('不开启')
    ) , '0', _t('移动端开启卡片式侧边栏') , _t('默认不开启'));
    $form->addInput($cardSliderbar);

    $db = Typecho_Db::get();
    $sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:WR'));
    $ysj = $sjdq['value'];
    if(isset($_POST['type'])) {
        if($_POST["type"] == "备份模板数据") {
            if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:WRbackup'))) {
                $update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:WRbackup');
                $updateRows= $db->query($update);
                echo '<div class="tongzhi">备份已更新，请等待自动刷新！如果等不到请点击';
?>
<a href="<?php Helper::options()->adminUrl('options-theme.php');?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
            }
            elseif($ysj) {
                    $insert = $db->insert('table.options')->rows(array('name' => 'theme:WRbackup','user' => '0','value' => $ysj));
                    $insertId = $db->query($insert);
                    echo '<div class="tongzhi">备份完成，请等待自动刷新！如果等不到请点击';
?>
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
            }
        }
        if($_POST["type"] == "还原模板数据") {
            if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:WRbackup'))) {
                $sjdub = $db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:WRbackup'));
                $bsj = $sjdub['value'];
                $update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:WR');
                $updateRows = $db->query($update);
                echo '<div class="tongzhi">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?>
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
            }
            else
                echo '<div class="tongzhi">没有模板备份数据，恢复不了哦！</div>';
        }
        if($_POST["type"] == "删除备份数据") {
            if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:WRbackup'))) {
                $delete = $db->delete('table.options')->where ('name = ?', 'theme:WRbackup');
                $deletedRows = $db->query($delete);
                echo '<div class="tongzhi">删除成功，请等待自动刷新，如果等不到请点击';
?>
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
            }
            else
                echo '<div class="tongzhi">不用删了！备份不存在！！！</div>';
        }
    }
    echo '<div id="backup"><form class="protected Data-backup" action="?Wbf" method="post"><h4>数据备份</h4><input type="submit" name="type" class="btn btn-s" value="备份模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="还原模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" /></form></div>';
}

//感谢泽泽大佬的代码
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Wx', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Wx', 'addButton');

class Wx {
    public static function addButton() {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.7/G/CSS/OwO.min.css?v=2" rel="stylesheet"/><style>.wmd-button-row{height:auto}.wmd-button{color:#999}.OwO{background:#fff}#g-shortcode{line-height:30px;background:#fff}#g-shortcode a{cursor:pointer;font-weight:bold;font-size:14px;text-decoration:none;color:#999!important;margin:5px;display:inline-block}</style><script src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.2.1/W/editor.js?v=1"></script>';
    }
}

/**
* 时间友好化
*
* @access public
* @param mixed
* @return
*/
function formatTime($time) {
    $text = '';
    $time = $time === NULL || $time > time() ? time() : intval($time);
    $t = time() - $time; //时间差 （秒）
    if ($t == 0)
        $text = '刚刚';
    elseif ($t < 60)
        $text = $t . '秒前'; // 一分钟内
    elseif ($t < 60 * 60)
        $text = floor($t / 60) . '分钟前'; //一小时内
    elseif ($t < 60 * 60 * 24)
        $text = floor($t / (60 * 60)) . '小时前'; // 一天内
    elseif ($t < 60 * 60 * 24 * 3)
        $text = floor($time / (60 * 60 * 24)) == 1 ? '昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time); //昨天和前天
    elseif ($t < 60 * 60 * 24 * 30)
        $text = date('m月d日 H:i', $time); //一个月内
    elseif ($t < 60 * 60 * 24 * 365)
        $text = date('m月d日', $time); //一年内
    else
        $text = date('Y年m月d日', $time); //一年以前
    return $text;
}

/**
* 文章内容解析（短代码，表情）
*
* @access public
* @param mixed
* @return
*/
function emotionContent($content, $url) {
    //表情解析
    $fcontent = preg_replace('#\@\((.*?)\)#', '<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.0.3/G/IMG/bq/$1.png" class="bq">', $content);
    //输出最终结果
    echo $fcontent;
}

function getBuildTime($date) {
    // 在下面按格式输入本站创建的时间
    if ($date == '') {
        echo '';
        return;
    }
    $site_create_time = strtotime($date);
    $time = time() - $site_create_time;
    if (is_numeric($time)) {
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0, "minutes" => 0, "seconds" => 0
        );
        $value["days"] = floor($time / 86400);
        echo '<span class="btime">' . $value['days'] . ' Days</span>';
    }
    else
        echo '';
}

function prev_post($archive) {
    $db = Typecho_Db::get();
    $content = $db->fetchRow($db->select()
                                ->from('table.contents')
                                ->where('table.contents.created < ?', $archive->created)
                                ->where('table.contents.status = ?', 'publish')
                                ->where('table.contents.type = ?', $archive->type)
                                ->where('table.contents.password IS NULL')
                                ->order('table.contents.created', Typecho_Db::SORT_DESC)
                                ->limit(1));
    if ($content) {
        $content = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($content);
        echo '<a class="prev" href="' . $content['permalink'] . '" rel="prev"><span>上一篇</span><br/>' . $content['title'] . '</a>';
    }
    else
        echo "<p class=\"prev\"><span>没有更多了</span></p>";
}

function next_post($archive) {
    $db = Typecho_Db::get();
    $content = $db->fetchRow($db->select()
                                ->from('table.contents')
                                ->where('table.contents.created > ? AND table.contents.created < ?', $archive->created, Helper::options()->gmtTime)
                                ->where('table.contents.status = ?', 'publish')
                                ->where('table.contents.type = ?', $archive->type)
                                ->where('table.contents.password IS NULL')
                                ->order('table.contents.created', Typecho_Db::SORT_ASC)
                                ->limit(1));

    if ($content) {
        $content = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($content);
        echo '<a class="next" href="' . $content['permalink'] . '" rel="next"><span>下一篇</span><br/>' . $content['title'] . '</a>';
    }
    else
        echo "<p class=\"next\"><span>没有更多了</span></p>";
}

// Links
function formatOut($json) {
    $json = json_decode($json, true);
    if ($json == NULL) {
        echo '<p style="text-align:center;"><b style="color:red;">[Links error]</b></p>';
        return;
    }
    foreach ($json as $key)
        echo '<li><a href="' . $key['addr'] . '" title="' . $key['name'] . ' | ' . $key['sign'] . '" target="_blank"></a><img src="' . $key['avt'] . '"/><div><h3>' . $key['name'] . '</h3><span>' . $key['tag'] . '</span><p>' . $key['sign'] . '</p></div></li>';
}

// Compress html
function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        }
        else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        }
        else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        }
        else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//')
                        continue;
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char)
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos)
                            $is_quot = !$is_quot;
                        elseif ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot)
                            $is_apos = !$is_apos;
                        elseif ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', '', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '><', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress . '<!-- COMPRESSED -->';
}