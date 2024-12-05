<?php

namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 'confirm');
            $payload['password'] = Hash::make($payload['password']);
            $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 'confirm', 'image', 'old_password');
            $user = $this->userRepository->find($id);
            $oldImage = $user->image;
            if (isset($payload['password'])) {
                $payload['password'] = Hash::make($payload['password']);
            } else if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads'), $imageName);

                $payload['image'] = 'uploads/' . $imageName;

                $oldImagePath = public_path($oldImage);
                if (isset($oldImage) && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            } else {
                $payload['image'] = $oldImage;
            }
            $this->userRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->find($id);
            $image = $user->image;
            if (isset($image)) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $this->userRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }
}