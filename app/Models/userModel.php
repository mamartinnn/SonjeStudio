<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

$user = UserModel::find(1);
$user->bookmarks = json_encode(['bookmark1', 'bookmark2']);
$user->save();

$bookmarks = json_decode($user->bookmarks);

class userModel extends Model
{
    use HasFactory;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    protected $fillable = [
        'username',
        'email',
        'password',
        'nohp',
        'bookmarks',
    ];

    protected $casts = [
        'bookmarks' => 'array',
    ];

    protected $table = 'user';

    public function setBookmarksAttribute($value)
    {
        $this->attributes['pookmarks'] = bycrpt($passwpord);
    }
}
