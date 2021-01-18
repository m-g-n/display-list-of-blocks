<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

/**
 * 複数の json ファイルを1つの json ファイルにまとめる関数
 */
function merge_json() {
	// 生成するファイル名の定義.
	$file_name = 'dictionary.json';
	// dictionary.json の値をデータベースから取得.
	$transient = get_transient( MGN_DLB_PATH . $file_name );

	// WP_DEBUG が true か $transient がなかったら.
	if ( WP_DEBUG || ! $transient ) {
		// 変数を定義
		$dictionary      = array();                // 辞書オブジェクト.
		$json_path       = MGN_DLB_PATH . 'json/'; // `json` ディレクトリまでのPATH.
		$dictionary_path = '';                     // dictionary.json までのPATH.

		// `json` ディレクトリ内のファイルをそれぞれループで取得.
		foreach( glob( $json_path . '*.json' ) as $filename ) {
			// データ保存用の配列を用意
			$data       = [];
			// JSONファイルのコンテンツをオブジェクトとして取得.
			$data       = json_decode( file_get_contents( $filename ), true );
			// 取得したオブジェクトを `dictionary` にまとめる.
			$dictionary = array_merge( $dictionary, $data );
		}
		// 取得したオブジェクトをJSON形式にエンコード.
		$dictionary = json_encode( $dictionary, true );
		// 取得したオブジェクトを `dictionary.json` に書き込む.
		file_put_contents( MGN_DLB_PATH . $file_name, $dictionary );

		// dictionary.json の値を一時的にデータベースへ保存.
		set_transient( $file_name, $dictionary_path, 60 * 60 );
	// $transient があったら.
	} else {
		// dictionary.json までのPATHを取得.
		$dictionary_path = $transient;
	}

	// dictionary.json までのPATHが取得できなかったら抜ける.
	if ( ! $dictionary_path ) {
		return;
	}
}
add_action( 'plugins_loaded', 'merge_json' );
