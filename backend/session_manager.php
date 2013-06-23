<?php
class SessionManagement
{
    // property declaration
    public $user_id = 0 ;


    // method declaration
    public function startSession( $_password, $_email ) 
    {
		$mysqli = new mysqli("localhost", "root", "tigerpoop13", "seedapp");
		if ($mysqli->connect_errno) 
		{
			unset( $_SESSION );
			error_log( "DB Connection refused." );
			return 0;
		}
		else
		{
			error_log( "DB Connection success." );
		}
		
		// Sanitize User Data
		//$_password = $this->sanitize( $_password, FILTER_SANITIZE_STRING );
		//$_email = $this->sanitize( $_email, FILTER_SANITIZE_URL );
		
		// Authenticate User Login
		$query = 'SELECT * FROM user '.
				 '  WHERE user_email = "'. $_email .'" '.
				 '    AND user_password = sha1("'. $_password .'") ';
		error_log( $query );
		$results = $mysqli->query( $query );
		
		if( ! $results || $results->num_rows == 0 )
		{
			error_log( "No matches for this login attempt." );
			return "" ;
		}
		elseif( $results->num_rows == 1 )
		{
			$row = $results->fetch_assoc();

			// This user just logged in , destroy any old session triangles
			if( session_id() ) 
			{
				session_destroy();
			}
			$delete_query = "DELETE FROM session_triangle WHERE user_id = ". $row['user_id'] ;
			$mysqli->query( $delete_query );

			// Begin clean session
			session_start();
			
			// Don't put to much crap in here, because Angular will not have access to it
			// You will have to pass the few you need when the Angular App is refreshed
			$_SESSION['user']['id'] = $row['user_id'] ;
			$_SESSION['user']['first_name'] = $row['user_first_name'] ;
			$_SESSION['user']['last_name']  = $row['user_last_name'] ;
			
			// These values may be used for authentication for Private data services 
			$sKey = $this->generateKey( 5, $row['user_id'] ."Z" );
			$this->sessionTriangle( $row['user_id'], $sKey, session_id() );

			return $sKey ;
		}
		else
		{
			error_log( "ERROR: Duplicate Users!" );
			return 0;
			while ($row = $results->fetch_assoc()) 
			{
				
			}
			return "";
		}
		
    }
   

	private function sessionTriangle( $_user_id, $_service_key, $_sid )
	{
		$mysqli = new mysqli("localhost", "root", "tigerpoop13", "seedapp");
		if ($mysqli->connect_errno) 
		{
			error_log( "DB Connection refused." );
			return 0;
		}

		$visitor_ip = $_SERVER['REMOTE_ADDR'];
		$minutes = date("i") + 60 ;
		$later_datetime = time() ;
		$query = 'INSERT INTO session_triangle VALUES ("'.
				   $_service_key .'", "'.
				   $_sid .'", "'.
				   $_SERVER['REMOTE_ADDR'] .'", "'.
				   date('Y-m-d H:i:s') .'", "'.
				   date( "Y-m-d H:i:s", time() + 120*60 ) .'", '.
				   $_user_id .' )';

		$mysqli->query( $query );
	}
	 
    
    private function sessionDataFilter()
    {
		$return_array['user']['id'] = $_SESSION['user']['id'] ;
		$return_array['user']['first_name'] = $_SESSION['user']['first_name'] ;
		$return_array['user']['last_name'] = $_SESSION['user']['last_name'] ;
		$return_array['session']['key'] = $_SESSION['session']['key'] ;
		$return_array['session']['id'] = $_SESSION['session']['id'] ;
		error_log( 'return array : '. print_r( $return_array, true ));
		return $return_array ;
    }
    

/*
mysql> SELECT * FROM session_triangle \G
*************************** 1. row ***************************
session_triangle_service_key: XOKAT1Z
        session_triangle_sid: 6
session_triangle_location_ip: 127.0.0.1
      session_triangle_start: 2013-06-20 16:33:45
    session_triangle_expires: 2013-06-20 18:33:45
                     user_id: 1
1 row in set (0.00 sec)
*/
    
    private function generateKey( $_alpha_digits = 5, $_some_number = ''  )
    {
		$_alpha_string = "";
		for( $ctr = 1; $ctr <= $_alpha_digits ; $ctr++ )
		{
			$_alpha_string .= chr( rand(65, 90)); // A ~ Z ascii
		}
		
		if( $_some_number <> '')
		{
			$_alpha_string .= $_some_number ;
		}
		return $_alpha_string ;
    }
    
    private function sanitize( $_user_string, $_filter )
    {
		$value = trim($value);
		array_filter( $_user_string, $_filter ); // see http://php.net/manual/en/filter.filters.sanitize.php
		return $_user_string ;
    }

}?>
