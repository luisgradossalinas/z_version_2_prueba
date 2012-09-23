$(document).ready(function(){
    

var mensajes = 
    $('.flash-message'),
                                s = 'middle',
                                interval = '3000';
                                $.each(mensajes, function(k, v){
                                    var h2 = (1000 * k);
                                    if($(v).hasClass('errorout')){
                                        interval = '9000';
                                    }else{
                                        interval = interval;
                                    }
                                    setTimeout(function(){
                                        $(v).fadeIn(s, h2, function(){
                                            setTimeout(function(){
                                            	if(!$(v).hasClass('msgVisible')){
                                                    $(v).fadeOut(s);
                                                }
                                            	
                                                setTimeout(function(){
                                                    mensajes.remove();
                                                }, h2+ interval);
                                                
                                            } , h2 + interval);
                                        });
                                    },h2);
                                    
                                });
                                
    
  //mensajes;
    
})