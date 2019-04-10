/* author: f0rt1 | (c) f0rt1.com */
function ShowOpenMenu(gen){
	$('#'+gen).slideToggle();
	$('#plus_'+gen).hide();
	$('#minus_'+gen).show();
}
/*
function ShowCheckMinus(gen){	

	ShowOpenMenu(gen);
	$('#plus_'+gen).show();
	$('#minus_'+gen).hide();
	//$('#kk'+gen).css('background-image',second_image );
	//document.getElementById('kk'+gen).style.backgroundImage=second_image;
	alert('ololo');
}
*/
