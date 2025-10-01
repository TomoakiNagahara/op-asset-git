<?php
/** op-asset-git:/sync.php
 *
 * <pre>
 * ```sh
 * php git.php asset/git/sync.php display=1 debug=0
 * ```
 * </pre>
 *
 * @created    2023-07-21
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

//  Get arguments.
$display = OP::Request('display') ?? 1;

/* @var $git UNIT\Git */
$git = OP::Unit('Git');

//  Get configuration from .gitmodules file.
$configs = $git->SubmoduleConfig();

//  Loop each submodules.
foreach( $configs as $config ){
    //  Change directory.
    $meta = 'git:/'.$config['path'];
    $path = OP::Path($meta);
    if(!chdir($path) ){
        throw new \Exception("chdir was failed. ({$meta}, {$path})");
    }
    if( $display ){ D("Change Directory: {$meta}"); }

    //  Switch branch.
    $branch = $config['branch'] ?? 'master';
    $io     = $git->Switch($branch);
    if( $display ){
        if( $io ){
            D("Change branch: {$branch}");
        }
    }
}
