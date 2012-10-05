/*
//Image on-click
$(function() {
	var mouseX, mouseY;
	$(document).mousemove(function(e){
		mouseX = e.pageX - 20;
		mouseY = e.pageY - 30;		
	});
	$('#ZombieBlog').mouseup(function() {
		var img = $('<img src="images/Splat.png" width="50px" height="50px" class="click"/>');
		$(document.body).append(img);
		img.css({'top':mouseY, 'left':mouseX}).fadeIn('slow');
		setTimeout(function() {
			img.fadeOut('slow');
		}, 5000);
	});
});

*/

$(document).ready(function() {
    $("#DynHTML").load("Home.html");//Default Load Home Page
    
    $("#Home").click(function HPL() { //Home Page Link
        //Pull Hope Page HTML
        $.ajax ({
            url:"Home.html",
            success:function(result) {
                $('#DynHTML').replaceWith(result);
            }
        })
    });

    $("#Events").click(function EPL() { //Events Forum Link
        //pull Event HTML
        $.ajax({
            url:"EventHandler.php",
            success:function(result) {
                $("#DynHTML").replaceWith(result);
            }
        });

    });

    $("#BlogPosts").click(function BPL() { //Blog Page Link
        //Pull Blog HTML
        $.ajax ({
            url:"BlogHandler.php",
            success:function(result) {
                $("#DynHTML").replaceWith(result);
                //pop input box from comment link
                $('.comment_post').click(function() {
                        $('#inputCont').css({'top':'50px'}).fadeIn('slow');
                        var postValue = $(this).prev('.postID').val();
                        $('#PostNum').val(postValue);
                });


            //pop input box from post button
                $('#make_post').click(function() {
                        $('#inputCont').css({'top':'50px'}).fadeIn('slow');
                });


            //close input modal and keep blog entries showing on input modal close
                $(document).keydown(function(e) {
                        if (e.which != 27) 
                                return;
                        $('#inputCont').fadeOut('slow');	
                });
                $('#close').click(function() {
                        $('#inputCont').fadeOut('slow');	
                });
            }
        })
        
    });

    $("#Login-Link").click(function LPL() { //Login Page Link
       
       alert("Login system is coming soon!");
       
       /*/Pull Login Page HTML
        $.ajax ({
            url:"LoginHandler.php",
            success:function(result) {
                $("#DynHTML").replaceWith(result);
            }
        })
        */
        
    });
    
    $("#More").click(function(){
        alert("More content coming soon!!");
    })


 
});
