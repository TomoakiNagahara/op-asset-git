<?php
/** op-skeleton-2024:/asset/git/submodule/add.php
 *
 * @created    2024-06-02
 * @version    1.0
 * @package    op-skeleton-2024
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
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

//	Usage
$usage = 'php git.php asset/git/submodule/add.php type=unit name=unit_name branch=' . date('Y') . PHP_EOL;

//  ...
if(!function_exists('OP') ){
	echo "Usage: {$usage}";
	exit(__LINE__);
}

//	...
foreach( ['type','name'] as $key ){
	//	...
	if( empty( OP()->Request($key) ) ){
		echo "\"{$key}\" was empty: {$usage}";
		exit(__LINE__);
	}
}

//	...
$request = OP()->Request();
$type    = $request['type'];
$name    = $request['name'];
$branch  = $request['branch'] ?? null;
$url     = "https://github.com/onepiece-framework/op-{$type}-{$name}.git";
$path    = "asset/{$type}/{$name}";
$branch  = $branch ? "-b {$branch}": '';

//	...
echo "git submodule add --force $branch $url $path \n";
