<?php


/*
* Privileges:
* role id:
* - 4 - normal user
* - 5 - moderator
* - 6 - admin
*/


class UserPrivilegesChecker
{

            /*
         * Check if user has rights to edit the post
         * There are three scenarios
         * 1 - owner of the post can edit the post.
         * 2 - moderator can edt the post (edit info will be appended)
         * 3 - admin can edit the post (edit info will be appended)
         *
         * Therefore we need to get user's information first
         */

    public static function is_privileged($toCompare){
        // get the logged in user
        if(isset($_SESSION['User']['id'])){
            $iUserId = (int)$_SESSION['User']['id'];
        } else{
            $iUserId = 0;
        }
        // get their role
        $user = new Users();
        $userRoleId = $user->select_user_role_by_id($iUserId);
        $roleId = $userRoleId['user_role_id'];
        // compare the tole to the user passed
        if (
            ($toCompare != $iUserId) &&
            ($roleId != 5) &&
            ($roleId != 6)
        ) {
            return false;
            die();
        }
        return true;
    }

    public static function is_moderator($toCompare){
        /*
         * This function only checks if the logged in
         * user is a moderator
         */

        // get the logged in user
        if(isset($_SESSION['User']['id'])){
            $iUserId = (int)$_SESSION['User']['id'];
        } else{
            $iUserId = 0;
        }

        // get their role
        $user = new Users();
        $userRoleId = $user->select_user_role_by_id($iUserId);
        $roleId = $userRoleId['user_role_id'];

        // compare the tole to the user passed
        if ($roleId != 5) {
            return false;
            die();
        }
        return true;

    }

}