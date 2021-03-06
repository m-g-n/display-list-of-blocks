/**
* 折り畳み表示
*
* 「使っているブロックを一覧表示」をクリックしたときのaria属性の制御
*/
var tabBtn   = document.getElementById('list-of-blocks'),
	state    = document.getElementById('state-panel'),
	tabPanel = document.getElementById('block-name-panel');

tabBtn.onclick = function() {
	if(tabPanel.classList.contains('closed')){
		tabPanel.classList.remove('closed');
		tabPanel.classList.add('opend');
		tabPanel.setAttribute('aria-hidden', false);
		this.setAttribute('aria-expanded', true);
		state.textContent='閉じる';
	}else{
		tabPanel.classList.remove('opend');
		tabPanel.classList.add('closed');
		tabPanel.setAttribute('aria-hidden', true);
		this.setAttribute('aria-expanded', false);
		state.textContent='開く';
	};
};
