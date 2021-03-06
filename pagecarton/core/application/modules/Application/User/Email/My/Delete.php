<?php
/**
 * PageCarton Content Management System
 *
 * LICENSE
 *
 * @user   Ayoola
 * @package    Application_User_Email_My_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: Delete.php 4.17.2012 7.55am ayoola $
 */

/**
 * @see Application_User_Email_My_Abstract
 */
 
require_once 'Application/User/Email/Abstract.php';


/**
 * @user   Ayoola
 * @package    Application_User_Email_My_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class Application_User_Email_My_Delete extends Application_User_Email_My_Abstract
{
	
    /**
     * The method does the whole Class Process
     * 
     */
	protected function init()
    {
		try
		{ 
			if( ! $data = self::getIdentifierData() ){ return false; }
		//	var_export( $data );
			$this->createConfirmationForm( 'Delete ' . $data['email'],  'Delete notification message' );
			$this->setViewContent( $this->getForm()->view(), true );
			if( ! $values = $this->getForm()->getValues() ){ return false; }
			if( ! $provider = Application_Settings_Abstract::getSettings( 'E-mail', 'provider' ) )
			{
				$provider = 'ayoola';
			}
		//	var_export( $provider );
			switch( $provider )
			{
				case 'ayoola':
				//	$values = array_merge( $data, $values );
					$response = Application_User_Email_My_Api_Delete::send( $data );
		//	var_export( $response );
					if( ! empty( $response['data'] ) )
					{
						$this->setViewContent( 'Email Account deleted', true );
					}
				break;
				case 'self':
					if( $this->deleteDb( false ) ){ $this->setViewContent( 'Email Account deleted', true ); }
				break;
			
			}
		}
		catch( Exception $e ){ return false; }
    } 
	// END OF CLASS
}
