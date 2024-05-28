<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserPhotoService
{
    const BASE_PHOTO_PATH = "upload/photos/user";

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function uploadUserPhoto(User $user, UploadedFile $photo): User
    {
        $data['photo_path'] = $this->handlerUploadPhoto($photo, $user);

        return $this->userRepository->update($user, $data);
    }

    public function deleteUserPhoto(User $user): User
    {
        $this->handlerDeletePhoto($user);

        $data['photo_path'] = null;

        return $this->userRepository->update($user, $data);
    }

    private function handlerUploadPhoto(UploadedFile $photo, User $user): string|false
    {
        $name = time() . '.webp';

        $image = Image::read($photo->getPath());
        $image->resizeCanvas(512, 512);
        $image->save($photo->getPath());

        $path = Storage::putFileAs(self::BASE_PHOTO_PATH, $photo, $name);

        if (!empty($user)) {

            $deletePath = $user->photo_path;

            if (is_string($deletePath) && Storage::exists($deletePath)) {

                Storage::delete($deletePath);
            }
        }

        return $path;
    }

    private function handlerDeletePhoto(User $user): void
    {
        if (!empty($user) && !empty($user)) {

            $deletePath = $user->photo_path;

            if (is_string($deletePath) && Storage::exists($deletePath)) {

                Storage::delete($deletePath);
            }
        }
    }
}
