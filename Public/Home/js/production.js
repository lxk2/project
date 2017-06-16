
        $(function(){


            $('.NEWS .NEWSl a').click(function(){
      
                $('.NEWS .NEWSz ul li:last').after($('.NEWS .NEWSz ul li:first'));
            });
            $('.NEWS .NEWSr a').click(function(){
        // clearInterval(time);
        $('.NEWS .NEWSz ul li:first').before($('.NEWS .NEWSz ul li:last'));
    });
            var time=setInterval(function(){
            $('.NEWS .NEWSl a').click();
        },2000);
            $('.NEWSl').mouseenter(function(){
        clearInterval(time);
    });
    $('.NEWS1').mouseleave(function(){
        // clearInterval(time);
        time = setInterval(function(){
            $('..NEWSr a').click();
        },2000);
            });
        })