<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 *
 * @property int $id
 * @property int $user_id
 * @property string $user_alias
 * @property string $caption
 * @property string $body
 * @property \DateTime $created_at
 */
class Post extends Model
{
    protected $fillable = [
        'id', 'user_id', 'user_alias', 'caption', 'body', 'created_at'
    ];

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getUserAlias(): string
    {
        return $this->user_alias;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }


    /**
     * @return array
     */
    public function getPostRules(): array
    {
        $rules = [
            'caption' => 'string|min:3|max:100',
            'body' => 'string|min:1|max:5000'
        ];
        return $rules;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
