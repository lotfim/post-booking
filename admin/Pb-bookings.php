<?php
/**
 * Created by PhpStorm.
 * User: lotfi
 * Date: 03/07/2019
 * Time: 16:53
 */

if (!class_exists('WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class PbBookings extends WP_List_Table {

	protected $plugin_name;

	protected $data;

	public function __construct($args = array(), $plugin_name) {
		parent::__construct($args);
		$this->plugin_name = $plugin_name;
		$this->processRequest();
	}

	public function get_columns() {
		$columns = array(
			'name'   => __('Name', $this->plugin_name),
			'post'   => __('Session', $this->plugin_name),
			'date'   => __('Date', $this->plugin_name),
			'action' => __('Action', $this->plugin_name),
		);

		return $columns;
	}

	public function prepare_items() {
		$columns = $this->get_columns();
		$this->get_data();
		$hidden                = array();
		$sortable              = array();
		$this->_column_headers = array($columns, $hidden, $sortable);

		$this->items = $this->data;
	}

	public function get_data() {
		global $wpdb;
		$this->data = array();
		$results    = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='order' ORDER BY meta_id DESC");
		foreach ($results as $result) {
			$resultArray              = unserialize($result->meta_value);
			$finnishBookingActionLink = '?page=' . $_REQUEST['page'] . '&action=deliverservice&booking=' . $result->meta_id;
			$data                     = array(
				'ID'     => (int) $result->meta_id,
				'name'   => $resultArray['name'],
				'post'   => get_the_title($result->post_id),
				'date'   => date(__('m/d/Y', $this->plugin_name), $resultArray['order_date']),
				'action' => '<a href="' . $finnishBookingActionLink . '" >' . __('Deliver service', $this->plugin_name) . '</a>',
			);

			$this->data[] = $data;
		}

		return $this->data;
	}

	public function column_default($item, $column_name) {
		switch ($column_name) {
			case 'name':
			case 'post':
			case 'date':
			case 'action':
				return $item[$column_name];
			default:
				return '';
		}
	}

	private function processRequest() {
		$action  = sanitize_text_field($_GET['action']);
		$booking = sanitize_text_field($_GET['booking']);
		if (!empty($action)) {
			switch ($action) {
				case 'deliverservice':
					if (isset($booking) && !empty($booking)) {
						$this->finnishBooking($booking);
					}
				default:
			}
		}
	}

	private function finnishBooking($booking_id) {
		global $wpdb;
		$booking = get_metadata_by_mid('post', $booking_id);
		if ($booking) {
			$bookingInformation                  = $booking->meta_value;
			$bookingInformation['delivery_date'] = time();
			$wpdb->update("{$wpdb->prefix}postmeta", array('meta_key' => 'past_order', 'meta_value' => serialize($bookingInformation)), array('meta_id' => $booking_id));
		}
	}

	public function display() {
		parent::display(); // TODO: Change the autogenerated stub

	}
}