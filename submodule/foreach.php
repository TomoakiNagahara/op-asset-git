<?php
/**	op-asset-git:/submodule/foreach.php
 *
 * @created    2025-10-20
 * @version    1.0
 * @package    op-asset-git
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

/*
//	...
if( $foreach = OP()->Request('foreach') ){

	//	...
	$configs = OP()->Unit()->Git()->SubmoduleConfig();

	//	...
	echo PHP_EOL;
	foreach( $configs as $name => $config ){
		chdir(_ROOT_GIT_.$config['path']);
		echo "$name: " . getcwd() . PHP_EOL;
		echo PHP_EOL;
		echo `{$foreach}`.PHP_EOL;
		echo `git log --pretty=format:"%h %an <%ae> %ad %cn <%ce> %cd" --date=format:'%Y-%m-%d %H:%M:%S' | grep @g`;
	}

	//	...
	return;
}
*/

define('_FOREACH_' , OP()->Request('foreach')    );
define('_GIT_ROOT_', OP()->Path('git:/') );

//	...
if( _FOREACH_ ){
	if( ChangeDirectory( 'top', _GIT_ROOT_ ) ){
		return true;
	}
}

/**	Change directory
 *
 *
 * @created    2025-10-28
 * @param      string     $path
 */
function ChangeDirectory( string $_name, string $path )
{
	//	...
	if( is_dir($path) ){
		chdir($path);
	}else{
		echo "\nThis is not a directory: {$path}\n\n";
		return;
	}

	//	...
	echo PHP_EOL."$_name: " . getcwd() . PHP_EOL . PHP_EOL;

	/* @var $output array */
	/* @var $status int   */
	exec(_FOREACH_ . ' 2>&1 ', $output, $status);
	echo join("\n", $output).PHP_EOL;

	//	...
	echo `git log --pretty=format:"%h %an <%ae> %ad %cn <%ce> %cd" --date=format:'%Y-%m-%d %H:%M:%S' | grep @g`;

	//	...
	if( file_exists('.gitmodules') ){
		//	...
		$configs = OP()->Unit()->Git()->SubmoduleConfig(getcwd().'/.gitmodules');

		//	...
		foreach( $configs as $name => $config ){
			//	...
			$name = ($_name === 'top') ? $name: "{$_name}-{$name}";
			ChangeDirectory( $name, "{$path}/{$config['path']}");
		}
	}

	//	...
	return true;
}

?>

# Usage

```
php app.php _develop/git command=submodule/foreach "foreach=git remote -v"
```
