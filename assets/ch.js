$(function(){
	$('.contact').click(function(){$(this).attr('href', ':otliam'.split('').reverse().join('') + $(this).attr('href').replace('/','').replace('&','@'));$(this).unbind('click');});
});
