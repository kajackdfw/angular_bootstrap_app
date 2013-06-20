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
		
		// Sanitize User Data
		$_password = $this->sanitize( $_password, FILTER_SANITIZE_STRING );
		$_email = $this->sanitize( $_email, FILTER_SANITIZE_URL );
		
		// Authenticate User Login
		$query = 'SELECT * FROM user '.
				 '  WHERE user_email = "'. $_email .'" '.
				 '    AND user_password = sha1("'. $_password .'") ';
		error_log( $query );
		$results = $mysqli->query( $query );
		
		if( ! $results || $results->num_rows == 0 )
		{
			error_log( "No matches for this login attempt." );
			return 0 ;
		}
		elseif( $results->num_rows == 1 )
		{
			$row = $results->fetch_assoc();
			error_log( '$row : '. print_r( $row, true ));
			session_start();
			session_id();
			
			// Don't put to much crap in here, because Angular will not have access to it
			// You will have to pass the few you need when the Angular App is refreshed
			$_SESSION['user']['id'] = $row['user_id'] ;
			$_SESSION['user']['first_name'] = $row['user_first_name'] ;
			$_SESSION['user']['last_name']  = $row['user_last_name'] ;
			
			// These values may be used for authentication for Private data services 
			$_SESSION['session']['sKey'] = $this->generateKey( 5, ':'. $row['user_id'] );
			$_SESSION['session']['id'] = session_id();
			error_log( '$session : '. print_r( $_SESSION['session'], true ));
			return $this->sessionDataFilter();
		}
		else
		{
			error_log( "ERROR: Duplicate Users!" );
			return 0;
			while ($row = $results->fetch_assoc()) 
			{
				
			}
		}
		
    }
    
    
    private function sessionDataFilter()
    {
		$return_array['user']['id'] = $_SESSION['user']['id'] ;
		$return_array['user']['first_name'] = $_SESSION['user']['first_name'] ;
		$return_array['user']['last_name'] = $_SESSION['user']['last_name'] ;
		$return_array['session']['key'] = $_SESSION['session']['key'] ;
		$return_array['session']['id'] = $_SESSION['session']['id'] ;
		error_log( print_r( $return_array, true ));
		return $return_array ;
    }
    
    
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