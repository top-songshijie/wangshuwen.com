(function() {
    $(".carousel-inner .item:not(:first)").removeClass("active");
    $(function() {
        var c = $(".js-latest-article-container");
        var b = Number(c.attr("article-count"));
        var a = Number(c.attr("article-page-size"));
        $(".js-more-article").click(function(g) {
            var d = $(g.target);
            d.hide().parent().prev().show();
            var f = Number($(g.target).attr("curr-no"));
            setTimeout(function(){
                $.ajax({
                    type : 'POST',
                    url : "/portal/article/page",
                    data : {
                        'cate_id' : 0,
                        'page' : f + 1,
                        'num' : 10
                    },
                    dataType : 'json',
                    success :function(data){
                        console.log(data)
                        if(data.code == 1){
                            finishHtml = addHtml(data.data,'');
                            c.append(finishHtml);
                            d.attr("curr-no",f + 1).show().parent().prev().hide();
                        }else{
                            $('.js-more-article').text('没有更多了...');
                            d.attr("curr-no",f + 1).show().parent().prev().hide();
                        }
                    }
                })
            }, 500);
        })


        //append html
        function addHtml(data,html){
            data.forEach(function (item) {
                html += `<article class="excerpt excerpt-1">
                        <a class="focus" href="/portal/article/detail/id/`+item.id+`.html" title="`+item.title+`" draggable="false">
                            <img class="thumb" data-original="`+item.thumb+`" alt="`+item.title+`" src="`+item.thumb+`" draggable="false">
                        </a>
                        <header>
                            <a class="cat" href="#" draggable="false">`+item.cate_name+`</a>
                            <h2>
                                <a href="/portal/article/detail/id/`+item.id+`.html" title="`+item.title+`" draggable="false">`+item.title+`</a>
                            </h2>
                        </header>
                        <p class="meta">
                            <time class="time">
                                <i class="glyphicon glyphicon-time"></i>
                                <span>`+item.create_time+`</span>
                            </time>
                            <span class="views">
                                <i class="glyphicon glyphicon-eye-open"></i>
                                <span>`+item.hits+`次浏览</span>
                            </span>
                            <span class="comment">
                                <i class="glyphicon glyphicon-comment"></i>
                                <span id="url::/portal/article/detail/id/`+item.id+`.html" class="cy_cmt_count">0</span>条评论
                            </span>
                        </p>
                        <p class="note">`+item.briefcontent+`</p>
                    </article>`;
            })
            return html;
        }

    })
})();