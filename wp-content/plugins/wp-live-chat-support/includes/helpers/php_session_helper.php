<?php


class TCXPhpSessionHelper {

	public static function clean_session($sessionHandled = false) {
		if(!$sessionHandled) {
			self::start_session();
		}
		$s = $_SESSION;
		foreach($s as $k=>$v) {
			if (substr($k,0,5)=='wplc_') {
				unset($_SESSION[$k]);
			}
		}
		session_regenerate_id(); // is this really needed?
		if(!$sessionHandled) {
			self::close_session();
		}

	}

	public static function start_session() {
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}
	}

	public static function close_session() {
		if (session_status() == PHP_SESSION_ACTIVE) {
			session_write_close();
		}
	}

	public static function set_session($cid) {
		if (!empty($cid)) {
			self::clean_session();
			$wplc_node_token = TCXUtilsHelper::node_server_token_get();
			self::start_session();
			$_SESSION['wplc_session_chat_session_id'] = intval($cid);
			$_SESSION['wplc_session_chat_session_active'] = 1;
			if ($wplc_node_token) {
				$_SESSION['wplc_cloud_token'] = $wplc_node_token;
			}
			self::close_session();
			return $cid;
		}
	}

}