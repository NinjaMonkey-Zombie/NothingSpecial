$((function() {
	$('.comment_post').click(function(event) {
		$('#inputCont').css({'top':'50px','left':'auto','right':'auto'})
			.fadeIn('slow');
		var postValue = $(this).prev('.postID').val();
		$('#PostNum').val(postValue);
	});
});

$((function() {
	$('#make_post').click(function(event) {
		$('#inputCont').css({'top':'50px','left':'auto','right':'auto'})
			.fadeIn('slow');
	});
});

$(function() {
	$(document).keydown(function(e) {
		if (e.which != 27) 
			return;
		$('#inputCont').fadeOut('slow');	
	});
	$('#close').click(function() {
		$('#inputCont').fadeOut('slow');
	});
});

$((function() {
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

