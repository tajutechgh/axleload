<?php

namespace App\Policies;

use App\Model\user\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct() 
    {
        //
    }

    public function accessControl(User $user)
    {
        return $this->getPermission($user,1); 
    }

    public function accessPermissions(User $user)
    {
        return $this->getPermission($user,2);
    }

    public function accessRoles(User $user)
    {
        return $this->getPermission($user,3);
    }

    public function accessUsers(User $user)
    {
        return $this->getPermission($user,4);
    }

    public function transactions(User $user)
    {
        return $this->getPermission($user,5);
    }

    public function transactionEnquiry(User $user)
    {
        return $this->getPermission($user,6);
    }

    public function weighingEnquiry(User $user)
    {
        return $this->getPermission($user,7);
    }

    public function fineEnquiry(User $user)
    {
        return $this->getPermission($user,8);
    }

    public function transactionFines(User $user)
    {
        return $this->getPermission($user,9);
    }

    public function blacklistedVehicles(User $user)
    {
        return $this->getPermission($user,10);
    }

    public function reports(User $user)
    {
        return $this->getPermission($user,11);
    }

    public function setups(User $user)
    {
        return $this->getPermission($user,12);
    }

    public function stationsSetup(User $user)
    {
        return $this->getPermission($user,13);
    }

    public function typeOfVehiclesSetup(User $user)
    {
        return $this->getPermission($user,14);
    }

    public function commoditiesSetup(User $user)
    {
        return $this->getPermission($user,15);
    }

    public function heightSetup(User $user)
    {
        return $this->getPermission($user,16);
    }

    public function regionsSetup(User $user)
    {
        return $this->getPermission($user,17);
    }

    public function finesSetup(User $user)
    {
        return $this->getPermission($user,18);
    }

    public function generalSettingsSetup(User $user)
    {
        return $this->getPermission($user,19);
    }

    public function systemSetup(User $user)
    {
        return $this->getPermission($user,20);
    }

    public function partPaymentAction(User $user)
    {
        return $this->getPermission($user,21);
    }

    public function paidAlreadyAction(User $user)
    {
        return $this->getPermission($user,22);
    }

    public function pardonAction(User $user)
    {
        return $this->getPermission($user,23);
    }

    protected function getPermission($user,$p_id)
    {
        foreach ($user->roles as $role) {

            foreach ($role->permissions as $permission) {

                if ($permission->id == $p_id) {

                    return true;
                }
            }
        }

        return false;
    }
}
