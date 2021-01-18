<?php
/**
 * @package display-list-of-blocks
 * @author mgn Inc.,
 * @license GPL-2.0+
 */

/**
 * スタイルの読み込み
 */
function DLB_enqueue() {
	// プラグイン用に用意したスタイルシートの読み込み
	wp_enqueue_style( 'dlb-style', MGN_DLB_URL . '/css/style.css' );
	wp_enqueue_script( 'dlb-script', MGN_DLB_URL . '/js/script.js', array( 'jQuery' ), filemtime( MGN_DLB_PATH . '/js/script.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'DLB_enqueue' );
