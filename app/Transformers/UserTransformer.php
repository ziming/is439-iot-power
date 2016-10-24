<?php
namespace App\Transformers;
class UserTransformer extends Transformer
{
    /**
     * @param $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'current_team_id' => $user->current_team_id,
//            'created_at' => $user->created_at,
//            'updated_at' => $user->updated_at,
        ];
    }
}