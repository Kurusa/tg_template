<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property bool $is_blocked
 * @property string|null $user_name
 * @property string|null $first_name
 * @property int $chat_id telegram chat ID of the user. Negative for group chats.
 * @property UserStatus $status
 * @property string $language
 */
class User extends Model
{
    protected $fillable = [
        'is_blocked',
        'user_name',
        'first_name',
        'chat_id',
        'status',
        'language',
    ];

    protected $casts = [
        'status' => UserStatus::class,
        'is_blocked' => 'boolean',
    ];

    public function matchStatus(UserStatus $status): bool
    {
        return $this->status === $status;
    }

    public function setStatus(UserStatus $status): void
    {
        $this->update([
            'status' => $status,
        ]);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function isAdmin(): bool
    {
        return $this->chat_id == config('telegram.admin_chat_id');
    }

    public function isGroupChat(): bool
    {
        return $this->chat_id < 0;
    }
}
