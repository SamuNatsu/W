<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function statUpdate($context) {
    if (!$context->fields->last_update) {
        $context->setField('last_update', 'int', 0, $context->cid);
        $context->setField('total_view', 'int', 0, $context->cid);
        $context->setField('total_post', 'int', 0, $context->cid);
        $context->setField('total_comment', 'int', 0, $context->cid);
        $context->setField('last_update_old', 'int', time(), $context->cid);
        $context->setField('total_view_old', 'int', 0, $context->cid);
        $context->setField('total_post_old', 'int', 0, $context->cid);
        $context->setField('total_comment_old', 'int', 0, $context->cid);
    }

    if (time() - $context->fields->last_update >= Helper::options()->statisticInterval) {
        $context->setField('last_update_old', 'int', $context->fields->last_update, $context->cid);
        $context->setField('total_view_old', 'int', $context->fields->total_view, $context->cid);
        $context->setField('total_post_old', 'int', $context->fields->total_post, $context->cid);
        $context->setField('total_comment_old', 'int', $context->fields->total_comment, $context->cid);

        Typecho_Widget::widget('Widget_Stat')->to($stat);
        $db = Typecho_Db::get();
        $fields = $db->fetchAll($db->select()->from('table.fields')->where('name = ?', 'contents_views'));
        $totView = 0;

        foreach ($fields as $tmp)
            if ($tmp['int_value'] && $db->fetchRow($db->select()->from('table.contents')->where('cid = ? AND status = ?', $tmp['cid'], 'publish')))
                $totView += $tmp['int_value'];

        $context->setField('last_update', 'int', time(), $context->cid);
        $context->setField('total_view', 'int', $totView, $context->cid);
        $context->setField('total_post', 'int', $stat->publishedPostsNum, $context->cid);
        $context->setField('total_comment', 'int', $stat->publishedCommentsNum, $context->cid);
    }
}

function deltaOut($delta) {
    if ($delta) {
        if ($delta > 0)
            echo '<span class="inc" title="据上次统计新增' . $delta . '">(' . $delta . '↑)</span>';
        else 
            echo '<span class="dec" title="据上次统计减少' . $delta . '">(' . $delta . '↓)</span>';
    }
    else 
        echo '<span class="dec" title="据上次统计无变化">(0)</span>';
}

function guguOut($context) {
    $lTime = strtotime(Helper::options()->createDate);
    $hTime = (time() - $lTime) / 3600 / 4;

    $sSum = $context->fields->total_post;
    printf('%.2f', 1 / $sSum * $hTime);
}

function activeOut($context) {
    $lTime = strtotime(Helper::options()->createDate);
    $hTime = (time() - $lTime) / 3600 / 24;

    $pTime = ($context->fields->last_update - $context->fields->last_update_old) / 60;
    $sSum = $context->fields->total_post + $context->fields->total_comment + $context->fields->total_view;
    $pSum = ($context->fields->total_post - $context->fields->total_post_old) + ($context->fields->total_comment - $context->fields->total_comment_old) * 5 + ($context->fields->total_view - $context->fields->total_view_old) * 2;
    printf('%.2f', ($sSum / $hTime + $pSum / $pTime) * 20);
}