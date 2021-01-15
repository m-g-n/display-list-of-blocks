<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

/**
 * json ファイルを読み込んでブロック名を日本語で表示する関数
 */
function get_jpn_block_name( $blockname ) {
	// JSONファイルのパスを取得.
	$json_path = MGN_DLB_PATH . 'json/core-ja.json';

	// JSONファイルがあったら.
	if ( file_exists( $json_path ) ) {
		// ファイルコンテンツを取得.
		$json = file_get_contents( $json_path );
		// 文字エンコーディングを 'UTF8' に変換.
		$json = mb_convert_encoding( $json, 'UTF8', 'ASCII, JIS, UTF-8, EUC-JP, SJIS-WIN' );
		// JSON データをオブジェクトに格納.
		$obj = json_decode( $json, true );
		// オブジェクトの中から 'core' 以下を取得.
		$obj = $obj[0]['core'];

		// 変数 $blockname に 'core/' が含まれていたら.
		if ( strpos( $blockname, 'core/' ) !== false ) {
			// $blockname から 'core/' を除いたブロック名だけの変数を定義.
			$DLB_blockname = str_replace( 'core/', '', $blockname );
			// オブジェクトをループ.
			foreach( $obj as $key => $val ) {
				// ブロック名の変数とループの中のブロック名が一致したら.
				if ( $DLB_blockname === $val['blockName'] ) {
					// もともとのブロック名に日本語のブロック名称を代入.
					$blockname = $val['ja'];
					// 日本語のブロック名を返す.
					return $blockname;
				}
			}

		}
	}
	// 条件に合致しなかったらそのまま返す.
	return $blockname;
}
