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
	OP::Template('404.php');
	return;
}

//	...
$command = OP::Request('command');

//	...
switch( $command ){
	case 'update':
	case 'fetch':
	case 'pick':
	case 'pull':
	case 'submodule/add':
	case 'submodule/delete':
	case 'submodule/foreach':
	case 'submodule/remote/add':
		//	...
		if(!file_exists($path = realpath("./{$command}.php")) ){
			OP::Html("File does not exists: {$path}");
		}

		//	...
		chdir(_ROOT_GIT_);

		//	...
		include($path);
		return;
	break;
}

?>

# Please select follow command:

 * update
 * fetch
 * pick
 * pull
 * submodule/add
 * submodule/delete
 * submodule/foreach
 * submodule/remote/add

# Usage

```
php app.php _develop/git command=pull
```
