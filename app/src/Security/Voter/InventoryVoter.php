<?php

namespace App\Security\Voter;

use App\Entity\Inventory;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class InventoryVoter extends Voter
{
    public const FULL_ACCESS = 'INVENTORY_FULL_ACCESS';
    public const EDIT_ITEMS = 'INVENTORY_EDIT_ITEMS';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::FULL_ACCESS, self::EDIT_ITEMS])
            && $subject instanceof Inventory;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $inventory = $subject;

        if ($user instanceof User && $inventory->getOwner() === $user) {
            return true;
        }

        if ($user instanceof User && $user->isUserAdmin()) {
            return true;
        }

        return match ($attribute) {
            self::FULL_ACCESS => false,
            self::EDIT_ITEMS => $inventory->canEditItems($inventory, $user),
            default => false,
        };
    }

    public function canEditItems(Inventory $inventory, UserInterface $user): bool
    {

        if ($inventory->getIsPublic()){
            return true;
        }

        foreach ($inventory->getInventoryAccesses() as $access) {
            if ($access->getEditor() === $user) {
                return true;
            }
        }

        return false;

    }
}
