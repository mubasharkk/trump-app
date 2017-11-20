<?php

namespace App\Services\Users;

use App\Services\Dto\AuthPlatform;
use App\Services\Dto\UserAccount;
use App\Services\Users\Repository\SocialUserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\AbstractUser;
use Ramsey\Uuid\Uuid;

final class SocialUsers
{
    private $repository;

    public function __construct(SocialUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(AbstractUser $account, string $driver): UserAccount
    {
        try {
            $user = $this->repository->fetchUserByEmail($account->email);
        } catch (ModelNotFoundException $ex) {
            $user = $this->repository->createUser($account->email, $account->nickname, Uuid::uuid4(), $account->name);
        }

        if (!$user->isAuthenticatedWith($driver)) {
            $user = $this->repository->addPlatform(
                $user,
                new AuthPlatform($driver, $account->id, $account->nickname, $account->token),
                (object)$account->getRaw()
            );
        }

        return $user;
    }
}