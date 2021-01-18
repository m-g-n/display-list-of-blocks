/**
* 折り畳み表示
*
* 「使っているブロックを一覧表示」をクリックしたときのaria属性の制御
*/
(function($){
	var tabBtn   = $('#list-of-blocks'),
	    label    = $('#list-of-blocks+label'),
	    state    = $('.state__panel'),
	    tabPanel = $('.block-name__panel');

	tabBtn.stop().on('click', function() {
		if(tabPanel.hasClass('closed')){
			tabPanel.removeClass('closed').addClass('opened').attr('aria-hidden', false);
			label.attr('aria-expanded', true);
			state.html('閉じる');
		}else{
			tabPanel.removeClass('opened').addClass('closed').attr('aria-hidden', true);
			label.attr('aria-expanded', false);
			state.html('開く');
		}
	});
})(jQuery);
