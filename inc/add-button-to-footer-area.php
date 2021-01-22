<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

// the_contentの直後に取得したブロックの情報を出力
add_filter( 'the_content', 'add_under_content_list_of_blocks', '10' );
function add_under_content_list_of_blocks( $content ) {
	// 取得したブロックの情報を全て変数に代入
	$list_of_blocks = display_list_of_blocks();

	if ( $list_of_blocks ) :
		// 表示する内容を取得.
		ob_start();
		?>
	<div class="block-name-accordion js-accordion">
		<aside class="block-name-area">
			<input type="checkbox" id="list-of-blocks" class="block-name__btn" aria-hidden="true">
			<label for="list-of-blocks" aria-expanded="false" id="list-of-blocks-label"><h2>このページで利用しているブロックを一覧表示</h2><span  id="state-panel" class="state__panel">開く</span></label>
			<div id="block-name-panel" class="block-name__panel closed" aria-hidden="true">
				<div class="block-name__panel-content"><?php echo wp_kses_post( $list_of_blocks ); ?></div>
			</div>
		</aside>
	</div>
		<?php
		// 記事コンテンツに取得したデータ全て追加して返す
		return $content . ob_get_clean();
	endif;
	return $content;
}
