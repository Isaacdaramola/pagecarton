<?php
/**
 * PageCarton Content Management System
 *
 * LICENSE
 *
 * @category   PageCarton CMS
 * @package    Ayoola_Api_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: Delete.php 4.17.2012 7.55am ayoola $
 */

/**
 * @see Ayoola_Api_Abstract
 */
 
require_once 'Application/Backup/Abstract.php';


/**
 * @category   PageCarton CMS
 * @package    Ayoola_Api_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class Ayoola_Api_Delete extends Ayoola_Api_Abstract
{
	
    /**
     * The method does the whole Class Process
     * 
     */
	public function init()
    {
		try
		{ 
			if( ! $data = self::getIdentifierData() ){ return false; }
			$this->createConfirmationForm( 'Delete ' . $data['api_label'],  'Delete' );
			$this->setViewContent( $this->getForm()->view(), true );
			if( $this->deleteDb( false ) )
			{ 
				$this->setViewContent( 'Api deleted successfully', true ); 
			}
		}
		catch( Ayoola_Api_Exception $e ){ return false; }
    } 
	// END OF CLASS
}
