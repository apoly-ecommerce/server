<?php

namespace App\Common;

use Auth;
use App\Helpers\Authorize;
use App\Http\Resources\ApiStatusResource;
use Illuminate\Support\Str;

/**
 * Attache this trait to a User (or other model) for easier read/writes on Addresses.
 *
 * @author PhamDinhHung <phamdinhhung2k1.it@gmail.com>
 */
trait Authorizable
{

    private $abilities = [
        'index'                     => 'view',
        'show'                      => 'view',
        'view'                      => 'view',
        'totalInfo'                 => 'view',
        'all'                       => 'view',
        'getRolePermissionsByUser'  => 'view',
        'allTrashed'                => 'view',
        'infoUserLogin'             => 'view',
        'hierarchy'                 => 'view',
        'mine'                      => 'view',
        'byCountry'                 => 'view',
        'infoUserLogged'            => 'view',
        'userAuth'                  => 'view',
        'paginate'                  => 'view',
        'trashedPaginate'           => 'view',
        'setup'                     => 'view',
        'general'                   => 'view',
        'unread'                    => 'view',
        'notification'              => 'view',
        'friends'                   => 'view',
        'exportPdf'                 => 'view',

        'generate'    => 'add',
        'create'      => 'add',
        'add'         => 'add',
        'store'       => 'add',
        'find'        => 'add',
        'restore'     => 'add',
        'massRestore' => 'add',

        'edit'                  => 'edit',
        'update'                => 'edit',
        'massUpdate'            => 'edit',
        'toggleMaintenanceMode' => 'edit',
        'toggleNotification'    => 'edit',
        'updatePassword'        => 'edit',
        'toggleConfig'          => 'edit',
        'markAsRead'            => 'edit',

        'delete'      => 'delete',
        'trash'       => 'delete',
        'destroy'     => 'delete',
        'massDestroy' => 'delete',
        'massTrash'   => 'delete',
        'emptyTrash'  => 'delete',
        'destroyAll'  => 'delete',
    ];

    /**
     * List of modules that grouped into a common module named 'vendor modules'
     * This will help to set the role permissions.
     *
     * @var array
     */
    private $vendor_modules = [
        'shop',
        'merchant'
    ];

    /**
     * List of modules that grouped into a common module named 'utility modules'
     * This will help to set the role permissions.
     *
     * @var array
     */
    private $utility_modules = [
        'faq',
        'faqTopic',
    ];

    /**
     * List of modules that grouped into a common module name 'appearance modules'
     * This will help to set the role permissions.
     *
     * @var array
     */
    private $appearance_modules = [
        'theme',
        'banner',
        'slider',
    ];

    /**
     * List of modules that grouped into a common module name 'update exception modules'
     * This will help to set the role permissions.
     *
     * @var array
     */
    private $update_exception_modules = [
        'message',
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param method $method
     * @param parameters $parameters
     *
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if (! $this->checkPermission('', $parameters)) {
            return (new ApiStatusResource([
                'errors' => $this->getSlug(),
                'status' => 403
            ]))->setStatusCode(403);
        }
        return parent::callAction($method, $parameters);
    }

    /**
     * CheckPermission for this action with the given slug.
     * If the logged in user is the Super Admin Or
     * the given slug is 'Dashboard' then no need to check the permission
     *
     * @param string $slug
     * @param [type] $model
     *
     * @return bool : false if the permission not granted
     */
    private function checkPermission($slug = '', $model = null) : bool
    {
        $slug = $slug ? $slug : $this->getSlug();
        return (new Authorize(Auth::user(), $slug, $model))->check();
    }

    /**
     * Get the slug to check the action permission
     *
     * @param $action
     * @param $module
     * @return string $slug
     */
    private function getSlug($action = null, $module = null)
    {
        $nameOfRoutes = explode('.', \Request::route()->getName());

        $module = $module ? $module : array_splice($nameOfRoutes, -2, 1)[0];
        $action = $action ? $action : array_splice($nameOfRoutes, -1, 1)[0];

        if ($this->isVendor($module)) {
            return $this->abilities[$action].'_vendor';
        }

        if ($this->isUtility($module)) {
            return $this->abilities[$action].'_utility';
        }

        if ($this->isAppearance($module)) {
            return 'customize_appearance';
        }

        if ($action == 'update') {
            if ($this->isUpdateExceptionModules($module)) {
                return $action.'_'.Str::snake($module);
            }
        }

        return array_key_exists($action, $this->abilities) ? $this->abilities[$action].'_'.Str::snake($module) : $action;
    }

    /**
     * Check if module is an Vendor Module.
     *
     * @param string $module
     *
     * @return bool
     */
    private function isVendor($module) : bool
    {
        return in_array($module, $this->vendor_modules);
    }

    /**
     * Check if module is an Utility Module.
     *
     * @param string $module
     *
     * @return bool
     */
    private function isUtility($module) : bool
    {
        return in_array($module, $this->utility_modules);
    }

    /**
     * Check if module is an Appearance Module.
     *
     * @param string $module
     *
     * @return bool
     */
    private function isAppearance($module) : bool
    {
        return in_array($module, $this->appearance_modules);
    }

    /**
     * Check if module is an Update Exception Module.
     *
     * @param string $module
     *
     * @return bool
     */
    private function isUpdateExceptionModules($module) : bool
    {
        return in_array($module, $this->update_exception_modules);
    }

}
