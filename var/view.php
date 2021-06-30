<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

function viewUpdate($context) {
    if ($context->is('single') && !$context->is('index')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = base64_decode($cookie, true);
        $cookie = $cookie ? explode(',', $cookie) : array();

        if (!in_array($context->cid, $cookie)) {
            $context->incrIntField('contents_views', 1, $context->cid);
            array_push($cookie, $context->cid);
            $cookie = implode(',', $cookie);
            $cookie = base64_encode($cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
}

function viewOut($fields, $format = '%d') {
    if (isset($fields->contents_views))
        printf($format, $fields->contents_views);
    else
        printf($format, 0);
}