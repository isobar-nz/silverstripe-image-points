<?php

namespace LittleGiant\SilverStripeImagePoints\Forms;
use SilverStripe\Security\Permission;

/**
 * Trait EditableDataObject
 *
 * @package App\Traits
 */
trait EditableDataObject
{
    /**
     * @see \SilverStripe\ORM\DataObject::canView()
     * @param null|\SilverStripe\Security\Member $member
     * @return bool
     */
    public function canView($member = null): bool
    {
        return Permission::checkMember($member, 'CMS_ACCESS');
    }

    /**
     * @see \SilverStripe\ORM\DataObject::canEdit()
     * @param null|\SilverStripe\Security\Member $member
     * @return bool
     */
    public function canEdit($member = null): bool
    {
        return Permission::checkMember($member, 'CMS_ACCESS');
    }

    /**
     * @see \SilverStripe\ORM\DataObject::canDelete()
     * @param null|\SilverStripe\Security\Member $member
     * @return bool
     */
    public function canDelete($member = null): bool
    {
        return Permission::checkMember($member, 'CMS_ACCESS');
    }

    /**
     * @see \SilverStripe\ORM\DataObject::canCreate()
     * @param null|\SilverStripe\Security\Member $member
     * @param array $context
     * @return bool
     */
    public function canCreate($member = null, $context = []): bool
    {
        return Permission::checkMember($member, 'CMS_ACCESS');
    }
}
