<?php
/**	op-asset-git:/branch.php
 *
 * Switch to default branch by .gitmodules file.
 *
 * <pre>
 * ```sh
 * php git.php asset/git/branch.php
 * ```
 * </pre>
 *
 * @created    2023-11-30
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
if(!function_exists('OP') ){
	echo "Usage: php git.php asset/git/branch.php\n";
	exit(__LINE__);
}

/* @var $git UNIT\Git */
$git      = OP::Unit('Git');
$git_root = RootPath('git');
$_branch  = OP::Request('branch') ?? _OP_APP_BRANCH_;

//	...
$configs = $git->SubmoduleConfig();

//	...
foreach( $configs as $config ){
	//	...
	$path   = $config['path'];
	$branch = $config['branch'] ?? null;

	//	...
	if(!$branch ){
		$branch = $_branch;
	}

	//	...
	chdir($git_root.$path);

	//	...
	$git->Switch($branch);
}
