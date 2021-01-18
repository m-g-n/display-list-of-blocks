<?php
/**
 * Plugin name: Display List of Blocks
 * Description: 各ページで利用しているブロックの一覧をページコンテンツ最下部に表示します。類人猿パターンブロック関連のクラスがついていたら太字で表示します
 * Version: 0.0.5
 * Author: mgn Inc.,
 * Author URI: https://www.m-g-n.me/
 * License: GPL-2.0+
 *
 * @package display-list-of-blocks
 */

/**
 * 定数を宣言
 */
define( 'MGN_DLB_URL', plugins_url( '', __FILE__ ) );      // プラグインURL.
define( 'MGN_DLB_PATH', plugin_dir_path( __FILE__ ) );     // プラグインPATH.
// define( 'MGN_DLB_BASENAME', plugin_basename( __FILE__ ) ); // プラグインベースネーム.

/**
 * テキストドメインを宣言
 */
// function mgn_dlb_load_textdomain() {
// 	load_plugin_textdomain( 'display-list-of-blocks', false, dirname( MGN_DLB_BASENAME ) . '/languages/' );
// }
// add_action( 'plugins_loaded', 'mgn_dlb_load_textdomain' );

/**
 * ファイルの読み込み
 */
// コンテンツからブロックを解析し、一覧を出力する関数.
require_once MGN_DLB_PATH . 'inc/parse-blocks.php';
// 複数のJSONファイルを1つのJSONファイルにまとめる関数.
require_once MGN_DLB_PATH . 'inc/merge-json.php';
// ブロック名を日本語で取得するJSONファイルを読み込み.
require_once MGN_DLB_PATH . 'inc/json-decode.php';
// 表示用のボタンを追加.
require_once MGN_DLB_PATH . 'inc/add-button-to-footer-area.php';
// スタイルを読み込み.
require_once MGN_DLB_PATH . 'inc/enqueue.php';
