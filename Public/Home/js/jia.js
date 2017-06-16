
$(function(){
	
	$('a.jian,a.jia').click(function(){
		return false;
	});
	$('.jian').click(function(){
	
		var num_input = $(this).next();
		var num = num_input.val() * 1;
		 
		 if(num <= 1){
		 	num = 1;
		 }else{
			num -= 1;
		 }
		
		num_input.val(num);
		setTotal();
	});
	$('.jia').click(function(){
		
		var num_input = $(this).prev();
		var num = num_input.val() * 1;
		
		
			num += 1;
		
		num_input.val(num);
		setTotal();
	});
	function checknum(num){
		if(isNaN(num)){
			return num;
		}else{
			return false;
		}
	}
	//结算功能
	function checkAndAll(){
		$('.ckAll').click(function(){
			$(".box-items").each(function(){  
			$(this).prop("checked",!!$(".box-all").prop("checked"));
			});
			setTotal();
		});
	}
	checkAndAll();
	function setTotal(){ 
		var s=0; 
		var a=0;
		$("#records ul").each(function(){ 
		//alert($(this).find("input[type='checkbox']").is(':checked'))
			if($(this).find("input[type='checkbox']").is(':checked')){ 
			  s+=parseInt($(this).find('input[class*=tb]').val()*1)*parseFloat($(this).find('p[class*=price]').text()); 
			  a+=$(this).find('input[class*=tb]').val()*1;
			}else{
				 s+=0;
				 
				}
				
				
		});
		//alert(s); 
		//alert($("#balancer .php").html(s.))
		$(".balancer .php").html(s.toFixed(2));
		$('#selectedTotal').html(a); 
	  } 
	  setTotal();
     $(".check").click(function(){
		          // 给数目输入框绑定keyup事件
       
		  setTotal();
		  cheked();
		  
		
		 
		})	;
		 function cheked(){
			 $("#records ul").each(function() {
				if($(this).find("input[type='checkbox']").is(':checked')){ 
				checkAndAll();
				}else{
					
				$('.box-all').attr('checked',false);	
					}	
        
    			});
		}
		
		
		
	
	


	//地址
	$('.make4p').click(function(){
		$('.make4p').each(function() {
		if($(this).find('input[type*=radio]').is(':checked')){
			var txt = $(this).text();
			$('.make2p .address').text(txt);
			}
		
		
			});
	})
	
	document.onkeyup=function(){
		$("#records ul").each(function(){
			var vall = $(this).find('input[class*=tb]').val()*1;
			vall = isNaN(vall)?1:vall;
			//console.log(vall);
			$(this).find('input[class*=tb]').val(Math.abs(((parseFloat(vall)))))
			//$(this).find('input[type=text]').val(Math.abs($val));parseFloat
			})
		 setTotal();
		
		}

	
});