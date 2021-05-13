$(document).ready(function() {
    autoRun();
    //评论表情定位
    Smilies = {
        dom: function(id) {
            return document.getElementById(id);
        },
        grin: function(tag) {
            tag = ' ' + tag + ' ';
            myField = this.dom("textarea");
            document.selection ? (myField.focus(), sel = document.selection.createRange(), sel.text = tag, myField.focus()) : this.insertTag(tag);
        },
        insertTag: function(tag) {
            myField = Smilies.dom("textarea");
            myField.selectionStart || myField.selectionStart == "0" ? (startPos = myField.selectionStart, endPos = myField.selectionEnd, cursorPos = startPos, myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length), cursorPos += tag.length, myField.focus(), myField.selectionStart = cursorPos, myField.selectionEnd = cursorPos) : (myField.value += tag, myField.focus());
        }
    }
});

//加载运行函数
function autoRun(){
    emotion();
    fixComment();
    nightModeBtn();
    scrollCallback();
    window.onscroll = function () {
        scrollCallback();
    };
}

function scrollCallback() {
    var client_height = document.documentElement.clientHeight || document.body.clientHeight;
    var osTop = document.documentElement.scrollTop || document.body.scrollTop;
    $("#gototop").attr("style", osTop >= client_height ? "display:block;opacity:1;" : "display:none;");
    if (document.getElementById("articleBody") && !$("#main").hasClass("main-left")) {
        var num = document.getElementById("header").offsetTop;
        var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
        $("#header-f").attr("style", scrollTop >= num ? "header-fixed" : "");
    }
}

//滚动至顶部
var timer = null;
function scrollTop() {
	cancelAnimationFrame(timer);
	timer = requestAnimationFrame(function sTop() {
		var top = document.body.scrollTop || document.documentElement.scrollTop;
		if(top > 0) {
			document.body.scrollTop = document.documentElement.scrollTop = top - 60;
			timer = requestAnimationFrame(sTop);
		}
		else
			cancelAnimationFrame(timer);
	});
}
$("#gototop").click(scrollTop);

//侧栏开关
function sliderbar_toggle() {
    $("#sliderbar").toggleClass("sliderbar-show");
    $("#main").toggleClass("main-left");
    $("#footer").toggleClass("main-left");
    $("#menu-wrap").toggleClass("menu-wrap-show");
    if ($("#header-f").hasClass("header-fixed"))
        $("#header-f").removeClass("header-fixed");
    else 
        scrollCallback();
}

//评论表情解析
function emotion() {
    if(document.getElementsByClassName("comment-content")) {
        let comments = document.getElementsByClassName("comment-content");
        let i = 0;
        for(i;i<comments.length;i++){
            var hex = '';
            comments[i].innerHTML = comments[i].innerHTML.replace(/\@\((.*?)\)/g,'<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.9/G/IMG/bq/$1.png" class="bq">');
            comments[i].innerHTML = comments[i].innerHTML.replace(/\#\((.*?)\)/g,function(){
                hex = encodeURI(arguments[1]);
                return '#('+hex+')';
            });
            comments[i].innerHTML = comments[i].innerHTML.replace(/\#\((.*?)\)/g,function(){
                return '<img src="https://cdn.jsdelivr.net/gh/youranreus/R@.1.2.2/W/bq/aru/'+arguments[1].replace(/%/g,"")+'.png" class="bq">';
            });
            comments[i].innerHTML = comments[i].innerHTML.replace(/\:\:(.*?)\:(.*?)\:\:/g,'<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.8/W/bq/$1/$2.png" class="bq">');
        }
    }
}

//lazyload准备
function lazyloadReady() {
    $(".typo img").each(function() {
        if (!$(this).hasClass("bq"))
            $(this).attr("data-src", $(this).attr("src")).attr("src", "").addClass("lazy");
    });
}

//instantclick评论定位修复
function fixComment(){
    if(document.getElementsByClassName("comment-reply")){
        let comments = document.getElementsByClassName("comment-reply");
        let i = 0;
        for(i;i<comments.length;i++){
        comments[i].innerHTML = comments[i].innerHTML.replace('<a','<a data-no-instant');
        }
    }

    if(document.getElementsByClassName("cancel-comment-reply")){
        let comments = document.getElementsByClassName("cancel-comment-reply");
        let i = 0;
        for(i;i<comments.length;i++){
            comments[i].innerHTML = comments[i].innerHTML.replace('<a','<a data-no-instant');
        }
    }
}

//表情面板开关
function OwO_show(){
    $("#OwO-container").attr("style", $("#OwO-container").hasClass("display-none") ? "max-height:300px;" : "max-height:0px;").toggleClass("display-none");
}

//夜间模式开关
function switchNightMode(){
    var night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
    if (night == '0') {
        $('link[title="dark"]').removeAttr("disabled");
        document.cookie = "night=1;path=/";
        $("#night-mode").addClass("night-mode-on");
        console.log('夜间模式开启');
    }
    else {
        $('link[title="dark"]').attr("disabled", "");
        document.cookie = "night=0;path=/";
        $("#night-mode").removeClass("night-mode-on");
        console.log('夜间模式关闭');
    }
}

//夜间模式按钮控制
function nightModeBtn() {
    if (document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") == '') {
        if(new Date().getHours() > 22 || new Date().getHours() < 6)
            $("#night-mode").addClass("night-mode-on");
    }
    else {
        var night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
        if(night == '1')
            $("#night-mode").addClass("night-mode-on");
    }
}
