<?php
/**	op-asset-git:/index.php
 *
 * @created    2025-07-21
 * @version    1.0
 * @package    op-asset-git
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

//	...
OP()->MIME('text/plain');

//	...
if(!OP::isAdmin() ){
	OP::Html('Your not admin.');
	return;
}

//	...
$command = OP::Request('command');

//	...
switch( $command ){
	case 'update':
	case 'fetch':
	case 'pick':
	case 'submodule/add':
	case 'submodule/delete':
	case 'submodule/remote/add':
		//	...
		if(!file_exists($path = realpath("./{$command}.php")) ){
			OP::Html("File does not exists: {$path}");
		}

		//	...
		chdir(_ROOT_GIT_);

		//	...
		if( include($path) ){
			return;
		}
	break;
}

?>

# Please select follow command:

 * update
 * fetch
 * pick
 * submodule/add
 * submodule/remote/add
