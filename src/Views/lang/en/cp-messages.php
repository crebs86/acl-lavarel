<?php
/**
 * Created by PhpStorm.
 * User: crebs
 * Date: 28/05/18
 * Time: 17:24
 */

return [
    "account_verified"=>"Account verified. Now you can use your account.",
    "account_check_error"=>"Error. This account was really checked or was deleted. Try login bellow.",
    "account_check_error_logged"=>"Error. This account was really checked or was deleted.",
    "active_account_error"=>"Your account must be active to login. Contact the administrator for more information.",
    "active_account_autologout"=>"This account has been deactivated. Contact the administrator for more information.",
    "no_have_access"=>"Your account must be validated to continue.",

    "admin_mail_check"=>"A email verification was send to e-mail :email",
    "user_mail_check"=>"A email verification was send to you account e-mail. Please verify account :email",
    "user_register_no_mail_check"=>"This account was created successfully",

    'profile_created'=>'Profile created successfully',
    'profile_edited'=>'Profile edited successfully',

    'denies_access_login_form'=>'You don\'t have permission to this',



    'settings_updated_success'=>'This settings was updated successfully',
    'settings_created_success'=>'Setting <strong>:settingname</strong> created successfully',

    /**
     * ----------------------
     * Roles => view and RoleController
     * ----------------------
     */
    'edit_role_success'=> 'Role <strong>:papel</strong> edited successfully',
    'create_role_success'=> 'Role <strong>:rolename</strong> created successfully',
    'remove_role_success'=> 'Role <strong>:rolename</strong> deleted successfully',
    'role_add_permission'=>'Permission <strong>:permissionname</strong> added successfully on role',
    'role_remove_permission'=>'Permission <strong>:permissionname</strong> removed successfully on role',

    /**
     * ----------------------
     * Permissions => view and PermissionController
     * ----------------------
     */
    'remove_permission_success'=>'Permission <strong>:permissionname</strong> deleted successfully',
    'create_permission_success'=> 'Permission <strong>:permissionname</strong> created successfully',
    'edit_permissions_success' => 'Permission <span class="font-weight-bold text-danger">:permissionname</span> edited successfully',

    /**
     * ----------------------
     * User => view and UserController
     * ----------------------
     */
    'user_add_role'=>'Role added successfully',
    'user_remove_role'=>'Role removed successfully',
    'change_pass_no_matches'=>'Your current password does not matches with the password you provided. Please try again.',
    'change_pass_same'=>'New Password cannot be same as your current password. Please choose a different password.',
    'change_pass_success'=>'Password changed successfully!',
    'change_account_success'=>'Account edited successfully!',

    'user_logged_try_mail_verify'=>'You really login. Before try check mail address you must logout',
];
