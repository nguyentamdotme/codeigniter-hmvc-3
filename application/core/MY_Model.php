<?php defined( 'BASEPATH' ) or die( 'Forbidden!!!' );

require_once dirname( __FILE__ ) . '/MY_Model_Interface.php';

class MY_Model extends CI_Model implements MY_Model_Interface {
	public function get_table_name() {
		return '';
	}


	public function get_one( $id ) {
		$query = $this->db->get_where( $this->get_table_name(), compact( 'id' ) );
		$row   = $query->row_array();

		return $row;
	}


	public function get_by_slug( $slug ) {
		$query = $this->db->get_where($this->get_table_name(), compact( 'slug' ));
		$row   = $query->row_array();

		return $row;
	}

	public function count_all() {
		$this->db->from( $this->get_table_name() );
		$num_rows = $this->db->count_all_results();

		return $num_rows;
	}

	public function get_all( $params = [] ) {
		$this->db->order_by( 'id', 'desc' );
		// if limit result
		if ( ! empty( $params['limit'] ) && ! empty( $params['offset'] ) ) {
			$this->db->limit( $params['limit'], $params['offset'] );
		}
		// if except ids list
		if ( ! empty( $params['exclude'] ) ) {
			$exclude_ids = (array) $params['exclude'];
			$this->db->where( 'id NOT IN (' . implode( ',', $exclude_ids ) . ')' );
		}

		$query = $this->db->get( $this->get_table_name() );
		$rows  = $query->result_array();

		return $rows;
	}

	public function create( $params ) {
		$this->db->insert( $this->get_table_name(), $params );
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	public function update( $id, $params ) {
		$this->db->where( 'id', $id );

		return $this->db->update( $this->get_table_name(), $params );
	}

	public function delete( $id ) {
		return $this->db->delete( $this->get_table_name(), [ 'id' => $id ] );
	}

	/**
	 * Check meta value has exist in DB
	 *
	 * @param $meta_key - column name in DB
	 * @param $meta_value
	 * @param int $except_id - use when update
	 *
	 * @return bool
	 */
	function exist_meta_data( $meta_key, $meta_value, $except_id = 0 ) {
		/** @var CI_DB_result $result * */
		$result = $this->db->get_where( $this->get_table_name(), array( $meta_key => $meta_value ) );
		if ( $result->num_rows() ) {
			// case have row
			$row = $result->row();

			return $row->id != $except_id;
		}

		// case no row
		return false;
	}

}
