 $(function(){
    var window_width = $(window).width()+'px';
    var banner_i = 0;
    var banner_len = $('.banner .list li').length;
    console.log(window_width);
    console.log(banner_len);
    //banner lunbo
    //左右
    $('.banner .direction .left').click(function(){
      $('.banner .banner_dot li.on').removeClass('on');
      $('.banner .banner_dot li').eq(banner_i).addClass('on');
      $('.banner .list li').stop(true,true).eq(banner_i).animate({'left':'-'+window_width},1000);
      banner_i+=1;
      // console.log(banner_i);//d当前x显示图片下标
      // 当banner_i+1  > 最后一张的下标时 就是说当前是最后一张时 把下一张改为第一张0
      if(banner_i > banner_len - 1){
        banner_i = 0;
      }
      $('.banner .list li').eq(banner_i).css('left',window_width).animate({'left':0},1000);

    });

    $('.banner .direction .right').click(function(){
      $('.banner .list li').stop(true,true).eq(banner_i).animate({'left':window_width},1000);
      if(banner_i == 0){
        banner_i = banner_len;
      }
      banner_i-=1;
      $('.banner .list li').eq(banner_i).css('left','-'+window_width).animate({'left':0},1000);
    });
    //轮播点击点的时候
    $('.banner .banner_dot li').click(function(){
      var index = $(this).index();
      if(index == banner_i){
        return false;
      }
      $('.banner .banner_dot li.on').removeClass('on');
      $(this).addClass('on');
      $('.banner .list li').stop(true,true).eq(banner_i).animate({'left':'-'+window_width},1000);
      banner_i =  index;
      $('.banner .list li').eq(banner_i).css('left',window_width).animate({'left':0},1000);
    });
    //banner 定时
    var banner_time = setInterval(function(){
      //定时执行 .left 的点击事件 
      $('.banner .direction .left').click();
    },2000);

    $('.banner').mouseover(function(){
      clearInterval(banner_time);
      banner_time = '';
    });
    $('.banner').mouseout(function(){
      banner_time = setInterval(function(){
        //定时执行 .left 的点击事件 
        $('.banner .direction .left').click();
      },2000);
    });

    $('.link span').mouseenter(function(){
      $('.link ul').show();
    });
    $('.link span').mouseleave(function(){
      $('.link ul').hide();
    });
    $('.product .left').click(function(){
      // alert(123);
      var ul = $('.product ul');
      var li_first = $('.product ul li:first');
      var li_last = $('.product ul li:last');
      var width = $('.product ul li').eq(0).width()+'px';
      // console.log(width)
      ul.animate({'left':'-'+width},1000,function(){
        li_last.after(li_first);
        ul.css('left','0');
      });   
      return false;
    });

    $('.product .right').click(function(){
      // alert(123);
      var ul = $('.product ul');
      var li_first = $('.product ul li:first');
      var li_last = $('.product ul li:last');
      var width = $('.product ul li').eq(0).width()+'px';

      li_first.before(li_last);
      ul.css('left','-'+width).animate({'left':0},1000);
      return false;
    });

    var time = setInterval(function(){
      //定时执行 .left 的点击事件 
      $('.product .left').click();
    },1500);

    $('.product').mouseover(function(){
      clearInterval(time);
      time = '';
    });
    $('.product').mouseout(function(){
      time = setInterval(function(){
        //定时执行 .left 的点击事件 
        $('.product .left').click();
      },1500);
    });
  });