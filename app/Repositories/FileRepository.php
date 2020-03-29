<?php

namespace App\Repositories;

use App\User;
use App\File;

class FileRepository
{
  /**
   * Get all of the files for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function forUser(User $user)
  {
      return File::where('user_id', $user->id)
                  ->orderBy('created_at', 'asc')
                  ->get();
  }
}
