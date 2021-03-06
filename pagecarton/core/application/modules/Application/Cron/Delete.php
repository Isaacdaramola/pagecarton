<?php
/**
 * PageCarton Content Management System
 *
 * LICENSE
 *
 * @advert   Ayoola
 * @package    Application_Cron_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: Delete.php 4.17.2012 7.55am ayoola $
 */

/**
 * @see Application_Cron_Abstract
 */
 
require_once 'Application/Cron/Abstract.php';


/**
 * @advert   Ayoola
 * @package    Application_Cron_Delete
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class Application_Cron_Delete extends Application_Cron_Abstract
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
			$this->createConfirmationForm( 'Delete ',  'Delete Cron' );
			$this->setViewContent( $this->getForm()->view(), true );
			if( ! $values = $this->getForm()->getValues() ){ return false; }
			
			//	Delete 
			$this->update( array( 'delete' => $data['task'] ) );
			if( $this->deleteDb( false ) ){ $this->setViewContent( 'Cron deleted successfully.', true ); }
		}
		catch( Application_Cron_Exception $e ){ return false; }
    } 
	// END OF CLASS
}
