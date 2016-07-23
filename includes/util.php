<?php
    require_once 'constants.php';

    function getRequest( $varName)
    {
        if (isset($_REQUEST[$varName]))
            return $_REQUEST[$varName];
        else 
            return "null"; 
    }

    function getRequestDefault( $varName, $default)
    {
        if (isset($_REQUEST[$varName]))
            return $_REQUEST[$varName];
        else 
            return $default; 
    }
    
    function getPost( $varName)
    {
        if (isset($_POST[$varName]))
            return $_POST[$varName];
        else 
            return "null"; 
    }
       
    function getPostDefault( $varName, $default)
    {
        if (isset($_POST[$varName]))
            return $_POST[$varName];
        else 
            return $default; 
    }
    
    function getRequestPost( $varName) {
        if (isset($_REQUEST[$varName]))
            return $_REQUEST[$varName];
        elseif (isset($_POST[$varName]))
            return $_POST[$varName];
        else 
            return "null"; 
    }
    
    function getRequestPostDefault( $varName, $default) {
        if (isset($_REQUEST[$varName]))
            return $_REQUEST[$varName];
        elseif (isset($_POST[$varName]))
            return $_POST[$varName];
        else 
            return $default; 
    }
    
    function getSession ($varName)
    {
        if (isset($_SESSION[$varName] ))
            return $_SESSION[$varName] ;
        else 
            return "null";         
    }
     
    function getSessionDefault ($varName, $default)
    {
        if (isset($_SESSION[$varName] ))
            return $_SESSION[$varName] ;
        else 
            return $default;         
    }
    
    function cleanValue ($mysqli, $varName)
    {
        return $mysqli->real_escape_string(trim(stripslashes($varName)));
    }
    
    /** 
     * The letter l (lowercase L) and the number 1 
     * have been removed, as they can be mistaken 
     * for each other. 
     */ 
    function createRandomPassword() { 
            $chars 	= "abcdefghijkmnopqrstuvwxyz023456789"; 
            srand((double)microtime()*1000000); 
            $i 		= 0; 
            $pass 	= '' ; 

            while ($i <= 4) { 
                    $num 	= rand() % 33; 
                    $tmp 	= substr($chars, $num, 1); 
                    $pass 	= $pass . $tmp; 
                    $i++; 
            } 

            return $pass; 
    }
	
	/**
     * Creates SQL WHERE clause with logic:
     *    - IF searchText contain a space ' ' CHAR, 
     *          Extract the first word before space CHAR
     *          Create reverseWord by second word + ' ' + firstword
     *          RETURN SQL 'OR name LIKE' + reverseWord 
     *    - ELSE
     *          RETURN ''
     * 
     * Example: 
     *    - INPUT $searchText = 'Head Hand'
     *    - RETURN ' OR name LIKE '%Hand%Head%'
     * 
     * @param type $searchText
     * @return type
     */
    function createReverseNameSql($searchText){
        
        $sqlLikeReverseName     = '';
        $firstSpaceCharPosition = strpos($searchText, ' ' );
        if ($firstSpaceCharPosition !== false)
        {
            $firstWord              = substr ( $searchText, 0 , $firstSpaceCharPosition );
            $secondWord             = substr ( $searchText, $firstSpaceCharPosition + 1 );
            $searchTextRevearse     = $secondWord. ' ' .$firstWord;
            $searchTextRevearse     = str_replace(' ', '%', $searchTextRevearse);
            $sqlLikeReverseName     = " OR name LIKE '%$searchTextRevearse%' ";
        }
	
        return $sqlLikeReverseName;
    }
    
	
?>
