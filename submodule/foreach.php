<?php
/** op-asset-git:/submodule/foreach.php
 *
 * @created    2025-10-20
 * @version    1.0
 * @package    op-asset-git
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
if(!$foreach = OP()->Request('foreach') ){
	?>

# Usage

```
php app.php _develop/git command=submodule/foreach "foreach=git remote -v"
```
	<?php
	return;
}

//	...
$configs = OP()->Unit()->Git()->SubmoduleConfig();

//	...
echo PHP_EOL;
foreach( $configs as $name => $config ){
	chdir(_ROOT_GIT_.$config['path']);
	echo "$name: " . getcwd() . PHP_EOL;
	echo PHP_EOL;
	echo `{$foreach}`.PHP_EOL;
	/*
	echo `git log --pretty=format:"%h %an <%ae> %ad %cn <%ce> %cd" --date=format:'%Y-%m-%d %H:%M:%S' | grep @g`;
	*/
}
