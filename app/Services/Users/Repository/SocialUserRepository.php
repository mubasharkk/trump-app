<?php

namespace App\Services\Users\Repository;

use App\Services\Dto\AuthPlatform;
use App\Services\Dto\DisplayName;
use App\Services\Dto\UserAccount;
use App\User;
use App\UserSocialite;
use Illuminate\Database\Eloquent\Collection;

final class SocialUserRepository
{
    private function buildUserAccount(User $user):UserAccount
    {
        list($firstName, $lastName) = explode(' ', $user->name);
        $account = new UserAccount(
            $user->id,
            $user->username,
            $user->email,
            new DisplayName($firstName, $lastName),
            $user->created_at
        );

        foreach ($user->platforms as $item) {
            $account->addPlatform(
                $item->driver,
                $item->user_id,
                $item->username,
                $item->token
            );
        }
        return $account;
    }

    public function createUser(string $email, string $username, string $password, string $name): UserAccount
    {
        $user = new User;
        $user->email = $email;
        $user->username = $username;
        $user->name = $name;
        $user->password = bcrypt($password);
        $user->save();

        return $this->buildUserAccount($user);
    }

    public function addPlatform(UserAccount $user, AuthPlatform $platform, \stdClass $userObject): UserAccount
    {
        $socialite = new UserSocialite;
        $socialite->user_id = $platform->id();
        $socialite->driver = $platform->driver();
        $socialite->username = $platform->username();
        $socialite->email = $user->email();
        $socialite->token = $platform->token();
        $socialite->user_object = json_encode($userObject, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $socialite->save();

        $user->addPlatform(
            $platform->driver(),
            $platform->id(),
            $platform->username(),
            $platform->token()
        );

        return $user;
    }

    public function fetchUserByEmail(string $email): UserAccount
    {
        $user = User::where('email', $email)->firstOrFail();
        return $this->buildUserAccount($user);
    }

    public function fetchUserPlatforms($email): Collection
    {
        return UserSocialite::where('email', $email)->get()->map(function(UserSocialite $item) {
            return new AuthPlatform(
                $item->driver,
                $item->user_id,
                $item->username,
                $item->token
            );
        });
    }
}