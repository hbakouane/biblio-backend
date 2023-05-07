<?php

namespace Modules\Core\Entities;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Contains all the permissions and roles
 */
class Roles
{
    /**
     * All the possible roles
     */
    const ROLE_SUPER_ADMIN = 'Admin';
    const ROLE_PUBLISHER = 'Publisher';
    const ROLE_CUSTOMER = 'Customer';

    /**
     * List of all the roles
     */
    const ALL_ROLES = [
        self::ROLE_SUPER_ADMIN,
        self::ROLE_PUBLISHER,
        self::ROLE_CUSTOMER
    ];

    /**
     * Possible permissions for users
     */
    const PERMISSION_READ_USER = 'Read User';
    const PERMISSION_CREATE_USER = 'Create User';
    const PERMISSION_EDIT_USER = 'Edit User';
    const PERMISSION_DELETE_USER = 'Delete User';

    /**
     * Possible permissions for user's profile
     */
    const PERMISSION_INACTIVATE_PROFILE = 'Inactivate Profile';
    const PERMISSION_EDIT_PROFILE = 'Edit Profile';
    const PERMISSION_DELETE_PROFILE = 'Delete Profile';

    /**
     * Possible permissions for categories
     */
    const PERMISSION_READ_CATEGORY = 'Read Category';
    const PERMISSION_CREATE_CATEGORY = 'Create Category';
    const PERMISSION_EDIT_CATEGORY = 'Edit Category';
    const PERMISSION_DELETE_CATEGORY = 'Delete Category';

    /**
     * Possible permissions for books
     */
    const PERMISSION_READ_BOOK = 'Read Book';
    const PERMISSION_CREATE_BOOK = 'Create Book';
    const PERMISSION_EDIT_BOOK = 'Edit Book';
    const PERMISSION_DELETE_BOOK = 'Delete Book';

    /**
     * Possible permissions for orders
     */
    const PERMISSION_READ_ORDER = 'Read Order';
    const PERMISSION_CREATE_ORDER = 'Create Order';
    const PERMISSION_EDIT_ORDER = 'Edit Order';
    const PERMISSION_DELETE_ORDER = 'Delete Order';


    const ALL_PERMISSIONS = [
        self::PERMISSION_READ_USER,
        self::PERMISSION_CREATE_USER,
        self::PERMISSION_EDIT_USER,
        self::PERMISSION_DELETE_USER,

        self::PERMISSION_INACTIVATE_PROFILE,
        self::PERMISSION_EDIT_PROFILE,
        self::PERMISSION_DELETE_PROFILE,

        self::PERMISSION_READ_CATEGORY,
        self::PERMISSION_CREATE_CATEGORY,
        self::PERMISSION_EDIT_CATEGORY,
        self::PERMISSION_DELETE_CATEGORY,

        self::PERMISSION_READ_BOOK,
        self::PERMISSION_CREATE_BOOK,
        self::PERMISSION_EDIT_BOOK,
        self::PERMISSION_DELETE_BOOK,

        self::PERMISSION_READ_ORDER,
        self::PERMISSION_CREATE_ORDER,
        self::PERMISSION_EDIT_ORDER,
        self::PERMISSION_DELETE_ORDER,
    ];

    /**
     * Assign permissions to each role
     */
    const ROLE_ADMIN_PERMISSIONS = [
        // Managing users
        self::PERMISSION_READ_USER,
        self::PERMISSION_CREATE_USER,
        self::PERMISSION_EDIT_USER,
        self::PERMISSION_DELETE_USER,

        // Managing profile
        self::PERMISSION_INACTIVATE_PROFILE,
        self::PERMISSION_EDIT_PROFILE,
        self::PERMISSION_DELETE_PROFILE,

        // Managing categories
        self::PERMISSION_READ_CATEGORY,
        self::PERMISSION_CREATE_CATEGORY,
        self::PERMISSION_EDIT_CATEGORY,
        self::PERMISSION_DELETE_CATEGORY,

        // Managing books
        self::PERMISSION_READ_BOOK,
        self::PERMISSION_CREATE_BOOK,
        self::PERMISSION_EDIT_BOOK,
        self::PERMISSION_DELETE_BOOK,

        // Managing orders
        self::PERMISSION_READ_ORDER,
        self::PERMISSION_CREATE_ORDER,
        self::PERMISSION_EDIT_ORDER,
        self::PERMISSION_DELETE_ORDER
    ];

    const ROLE_PUBLISHER_PERMISSIONS = [
        // Managing profile
        self::PERMISSION_INACTIVATE_PROFILE,
        self::PERMISSION_EDIT_PROFILE,
        self::PERMISSION_DELETE_PROFILE,

        // Managing books
        self::PERMISSION_READ_BOOK,
        self::PERMISSION_CREATE_BOOK,
        self::PERMISSION_EDIT_BOOK,
        self::PERMISSION_DELETE_BOOK,

        // Managing orders
        self::PERMISSION_READ_ORDER
    ];

    const ROLE_CUSTOMER_PERMISSIONS = [
        // Managing profile
        self::PERMISSION_INACTIVATE_PROFILE,
        self::PERMISSION_EDIT_PROFILE,
        self::PERMISSION_DELETE_PROFILE,

        // Managing books
        self::PERMISSION_READ_BOOK,

        // Managing orders
        self::PERMISSION_READ_ORDER,
        self::PERMISSION_CREATE_ORDER,
        self::PERMISSION_EDIT_ORDER
    ];

    /**
     * Get the list of admin's permissions
     *
     * @return string[]
     */
    public static function getAdminPermissions()
    {
        return self::ROLE_ADMIN_PERMISSIONS;
    }

    /**
     * Get the list of publisher's permissions
     *
     * @return string[]
     */
    public static function getPublisherPermissions()
    {
        return self::ROLE_PUBLISHER_PERMISSIONS;
    }

    /**
     * Get the list of customer's permissions
     *
     * @return string[]
     */
    public static function getCustomerPermissions()
    {
        return self::ROLE_CUSTOMER_PERMISSIONS;
    }

    public function registerRoles()
    {
        $roles = [];

        foreach (self::ALL_ROLES as $role) {
            $roles[] = Role::create(['name' => $role]);
        }

        return $roles;
    }

    public function registerPermissions()
    {
        $permissions = [];

        foreach (self::ALL_PERMISSIONS as $permission) {
            $permissions[] = Permission::create(['name' => strtolower($permission)]);
        }

        return $permissions;
    }

    public function registerRolesAndPermissionsAndAssignPermissionsToRoles()
    {
        $roles = $this->registerRoles();

        $this->registerPermissions();

        foreach ($roles as $role) {
            $constName = 'ROLE_' . strtoupper($role->name) . '_PERMISSIONS';
            $thisClass = new \ReflectionClass(__CLASS__);
            $permissions = $thisClass->getConstant($constName);

            foreach ($permissions as $permission) {
                $role->givePermissionTo(strtolower($permission));
            }
        }

        return true;
    }
}
