<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

/**
 * ブロックの一覧をページコンテンツ最下部に表示
 */

// モバイルからのアクセスだったら表示しない.
if ( wp_is_mobile() ) :
	return;

// それ以外だったら.
else :
	function display_list_of_blocks() {
		// 投稿データを取得.
		global $post;
		// コンテンツ内のブロックの情報を取得.
		$blocks = parse_blocks( $post->post_content );

		// 表示する内容を取得.
		ob_start();
		?>
<aside class="dlb-blocks">
	<h2>このページで利用しているブロックの情報</h2>
	<ul class="dlb-lists">
		<?php
		// 取得したコンテンツ内のブロック群をループして個別の情報を取得.
		foreach ( $blocks as $block ) :
			// 変数を定義
			$blocklist   = '';      // ブロック名.
			$className   = array(); // クラス名.
			$innerBlocks = array(); // 入れ子の中のブロックのデータ.

			// ブロック名が空の場合はスキップ.
			if ( null === $block['blockName'] ) {
				continue;
			}

			// ブロック名を変数に代入.
			$blockname = $block['blockName'];
			// クラス名を変数に代入.
			if ( isset( $block['attrs']['className'] ) ) {
				$className = $block['attrs']['className'];
			}
			// 入れ子の中のブロックのデータを変数に代入.
			if ( isset( $block['innerBlocks'] ) ) {
				$innerBlocks = $block['innerBlocks'];
			}
			?>
		<li class="dlb-list">
			外枠のブロック名：<?php echo esc_html( $blockname ); ?>
			<?php
			// クラス名の変数か入れ子の中のブロックの変数があったら.
			if ( $className || $innerBlocks ) :
			?>
			<ul>
				<?php
				// クラス名の変数があったら.
				if ( $className ) :
					// 取得したクラス名の中に 'RJE' が含まれていたら.
					if ( strpos( $className, 'RJE' ) !== false ) :
						?>
				<li style="font-weight:bold">外枠のクラス名：<?php echo esc_html( $className ); ?></li>
				<?php
					// なかったら.
					else :
				?>
				<li>外枠のクラス名：<?php echo esc_html( $className ); ?></li>
					<?php
					endif;
				endif;

				// 入れ子の中のブロックの変数があったら.
				if ( $innerBlocks ) :
					// 変数を定義
					$innerBlockClassName = array(); // 入れ子の中のブロック名.
					// 入れ子の中のブロックをループで個別に取得.
					foreach ( $innerBlocks as $innerBlock ) :

						// ブロック名が空の場合はスキップ.
						if ( null === $innerBlock['blockName'] ) {
							continue;
						}

						// 内部ブロック名を変数に代入.
						$innerBlockName = $innerBlock['blockName'];
						// 内部ブロックのクラス名を変数に代入.
						if ( isset( $innerBlock['attrs']['className'] ) ) {
							$innerBlockClassName = $innerBlock['attrs']['className'];
						}
						?>
				<li>
					内枠のブロック名：<?php echo esc_html( $innerBlockName ); ?>
						<?php
						// 内部ブロックのクラス名の変数があったら.
						if ( $innerBlockClassName ) :
						?>
					<ul>
							<?php
							// 取得したクラス名の中に 'RJE' が含まれていたら.
							if ( strpos( $innerBlockClassName, 'RJE' ) !== false ) :
							?>
						<li style="font-weight:bold">内枠のクラス名：<?php echo esc_html( $innerBlockClassName ); ?></li>
							<?php
							// なかったら.
							else :
							?>
						<li>内枠のクラス名：<?php echo esc_html( $innerBlockClassName ); ?></li>
						<?php endif; ?>
					</ul>
					<?php endif; ?>
				</li>
						<?php
					endforeach;
				endif;
				?>
			</ul>
		<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
</aside>
		<?php
		// 取得したデータ全てを返す
		return ob_get_clean();
	}

	// the_contentの直後に出力
	add_filter( 'the_content', 'add_under_content_list_of_blocks', '10' );
	function add_under_content_list_of_blocks( $content ) {
		// 取得したブロックの情報を全て変数に代入
		$list_of_blocks = display_list_of_blocks();
		// 記事コンテンツにブロックの情報を付加
		return $content . $list_of_blocks;
	}
endif;
