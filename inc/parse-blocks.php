<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

/**
 * ブロックの一覧をページコンテンツ最下部に表示
 */

function display_list_of_blocks() {
	// 投稿データを取得.
	global $post;
	// コンテンツ内のブロックの情報を取得.
	$blocks = parse_blocks( $post->post_content );

	// 表示する内容を取得.
	ob_start();
	?>
<div class="dlb-blocks">
	<h3>このページで利用しているブロックの情報</h3>
	<ul class="dlb-lists">
		<?php
		// 取得したコンテンツ内のブロック群をループして個別の情報を取得.
		foreach ( $blocks as $block ) :
			// 変数を定義
			$blockname   = '';      // ブロック名.
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
			<span class="dlb-list__blockname">外枠のブロック名：<?php echo esc_html( get_jpn_block_name( $blockname ) ); ?></span>
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
				<li class="dlb-list__classname__rje">外枠のクラス名：<?php echo esc_html( $className ); ?></li>
				<?php
					// なかったら.
					else :
				?>
				<li class="dlb-list__classname">外枠のクラス名：<?php echo esc_html( $className ); ?></li>
					<?php
					endif;
				endif;

				// 入れ子の中のブロックの変数があったら.
				if ( $innerBlocks ) :
					// 変数を定義
					$blockname             = '';      // 入れ子の中のブロック名.
					$innerBlockClassName   = array(); // 入れ子の中のブロックのクラス名.
					$innerBlockInnerBlocks = array(); // 入れ子の中のブロックのデータ.
					// 入れ子の中のブロックをループで個別に取得.
					foreach ( $innerBlocks as $innerBlock ) :

						// ブロック名が空の場合はスキップ.
						if ( null === $innerBlock['blockName'] ) {
							continue;
						}

						// 内部ブロック名を変数に代入.
						$blockname = $innerBlock['blockName'];
						// 内部ブロックのクラス名を変数に代入.
						if ( isset( $innerBlock['attrs']['className'] ) ) {
							$innerBlockClassName = $innerBlock['attrs']['className'];
						}
						// 入れ子の中のブロックのデータを変数に代入.
						if ( isset( $innerBlock['innerBlocks'] ) ) {
							$innerBlockInnerBlocks = $innerBlock['innerBlocks'];
						}
						?>
				<li>
					<span class="dlb-list__blockname">内枠1階層めのブロック名：<?php echo esc_html( get_jpn_block_name( $blockname ) ); ?></span>
						<?php
						// 内部ブロックのクラス名の変数か入れ子の中のブロックの変数があったら.
						if ( $innerBlockClassName || $innerBlockInnerBlocks ) :
						?>
					<ul>
						<?php
						// クラス名の変数があったら.
						if ( $innerBlockClassName ) :
							// 取得したクラス名の中に 'RJE' が含まれていたら.
							if ( strpos( $innerBlockClassName, 'RJE' ) !== false ) :
								?>
						<li class="dlb-list__classname__rje">内枠1階層めのクラス名：<?php echo esc_html( $innerBlockClassName ); ?></li>
						<?php
							// なかったら.
							else :
						?>
						<li class="dlb-list__classname">内枠1階層めのクラス名：<?php echo esc_html( $innerBlockClassName ); ?></li>
							<?php
							endif;
						endif;

						// 入れ子の中のブロックの変数があったら.
						if ( $innerBlockInnerBlocks ) :
							// 変数を定義
							$innerBlockInnerBlockClassName = array(); // 入れ子の中のブロック名.
							// 入れ子の中のブロックをループで個別に取得.
							foreach ( $innerBlockInnerBlocks as $innerBlockInnerBlock ) :

								// ブロック名が空の場合はスキップ.
								if ( null === $innerBlockInnerBlock['blockName'] ) {
									continue;
								}

								// 内部ブロック名を変数に代入.
								$blockname = $innerBlockInnerBlock['blockName'];
								// 内部ブロックのクラス名を変数に代入.
								if ( isset( $innerBlockInnerBlock['attrs']['className'] ) ) {
									$innerBlockInnerBlockClassName = $innerBlockInnerBlock['attrs']['className'];
								}
								?>
						<li>
							<span class="dlb-list__blockname">内枠2階層めのブロック名：<?php echo esc_html( get_jpn_block_name( $blockname ) ); ?></span>
								<?php
								// 内部ブロックのクラス名の変数があったら.
								if ( $innerBlockInnerBlockClassName ) :
								?>
							<ul>
									<?php
									// 取得したクラス名の中に 'RJE' が含まれていたら.
									if ( strpos( $innerBlockInnerBlockClassName, 'RJE' ) !== false ) :
									?>
								<li class="dlb-list__classname__rje">内枠2階層めのクラス名：<?php echo esc_html( $innerBlockInnerBlockClassName ); ?></li>
									<?php
									// なかったら.
									else :
									?>
								<li class="dlb-list__classname">内枠2階層めのクラス名：<?php echo esc_html( $innerBlockInnerBlockClassName ); ?></li>
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
						<?php
					endforeach;
				endif;
				?>
			</ul>
		<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
	<?php
	// 取得したデータ全てを返す
	return ob_get_clean();
}
