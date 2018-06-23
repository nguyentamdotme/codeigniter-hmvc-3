<?php defined( 'BASEPATH' ) or die( 'Forbidden!!!' );

interface MY_Model_Interface {
	public function get_table_name();

	public function get_one( $id );

	public function count_all();

	public function get_all( $params = [] );

	public function create( $params );

	public function update( $id, $params );

	public function delete( $id );
}
