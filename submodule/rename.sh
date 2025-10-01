
 ## op-asset-git:/submodule/rename.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-asset-git
 # @author     Tomoaki Nagahara
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# Change remote name and location

# Source name
A=${1:-origin}

# Distnation name
B=${2:-upstream}

# Rename origin name.
git submodule foreach git remote rename $A $B
