<?php
/**	op-asset-git:/submodule/remote/add.php
 *
 *  Add remote to all submodules.
 *
 * <pre>
 * config : Specify the .gitmodules file to reference.
 * name   : Specify the remote name to add.
 * test   : Specify 1 explicitly to execute.
 * ```sh
 * php git.php asset/git/submodule/remote/add.php config=.gitmodules name=upstream display=1 debug=0 test=1
 * ```
 * </pre>
 *
 * @created    2023-02-13
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
$usage = "\nUsage: php app.php _develop/git command=submodule/remote/add config=.gitmodules_local name=local test=1\n";

//	...
if(!function_exists('OP') ){
	echo $usage;
	return true;
}

/*
//	...
$display = OP::Request('display') ?? 1;
$test    = OP::Request('test')    ?? 1;
$config  = OP::Request('config');
$name    = OP::Request('name');

//	...
foreach( ['config','name'] as $key ){
	if( empty(${$key}) ){
		echo $usage;
		return true;
	}
}

//	...
if( $test === '' ){
	$test = '1';
}
//	...
if( $test ){
	$display = $test;
	D('This is test mode. (test=1)');
}
*/

if( OP::Request('config') and OP::Request('name') ){
	//	OK
}else{
	echo $usage;
	return true;
} // ...

if( OP::Request('test') > 0 ? true : false ){
	D('This is test mode: test=1');
} // ...

/* @var $git UNIT\Git */
/*
$git = OP::Unit('Git');

//	...
$configs = $git->SubmoduleConfig($config);

//	...
foreach( $configs as $config ){
	//	...
	$url  = $config['url'];
	$meta = 'git:/'.$config['path'];
	$path = OP::Path($meta);
	if(!chdir($path) ){
		throw new \Exception("chdir was failed. ($path)");
	}
	if( $display ){ D("Change Directory: $meta"); }

	//	...
	if( $git->Remote()->isExists($name) ){
		D("This remote name is already exists. ({$name})");
		continue;
	}

	//	...
	if( $test ){
		D("git remote add {$name} {$url}");
	}else{
		$git->Remote()->Add($name, $url);
	}
}
*/

//	Do
GitSubmoduleRemote( OP()->Path('git:/') );

/**	Add a remote repository to the Git submodules.
 *
 */
function GitSubmoduleRemote( string $git_root )
{
	//	Save current dirctory.
	$current_dir = getcwd();

	//	Change git root.
	chdir($git_root);

	//	Init
	$test     = OP::Request('test') > 0 ? true: false;
	$config   = OP::Request('config');
	$name     = OP::Request('name');
	$git_root = getcwd();

	/* @var $git UNIT\Git */
	$git = OP::Unit('Git');

	//	Get sumodule config.
	$configs = $git->SubmoduleConfig( OP::Request('config') );

	//	Loop of config.
	foreach( $configs as $config ){
		//	...
		$url  = $config['url'];
		$path = $config['path'];

		//	...
		chdir($git_root.'/'.$path);

		//	...
		if( $git->Remote()->isExists($name) ){
			D("This remote name is already exists. ({$path})");
		}else{
			//	...
			if( $test ){
				D("git remote add {$name} {$url}");
			}else{
				$git->Remote()->Add($name, $url);
			}
		}

		//	...
		if( $config['submodule'] ?? 0 ){
			D("Has submodule: $git_root/$path");
			GitSubmoduleRemote( $git_root.'/'.$path );
		}
	}

	//	...
	chdir($current_dir);
}
