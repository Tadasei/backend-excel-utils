<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\{
	Factories\HasFactory,
	Relations\BelongsTo,
	Relations\MorphOne,
	Model,
};

class Export extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		"type",
		"user_id",
		"timezone",
		"requested_at",
		"processed_at",
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			"requested_at" => "datetime",
			"processed_at" => "datetime",
		];
	}

	/**
	 * Get the user that requested the export.
	 */
	public function requester(): BelongsTo
	{
		return $this->belongsTo(User::class, "user_id");
	}

	/**
	 * Get the export's file.
	 */
	public function file(): MorphOne
	{
		return $this->morphOne(File::class, "fileable");
	}

	/**
	 * Scope a query to only include pending exports.
	 */
	public function scopePending(Builder $query): void
	{
		$query->whereNull("processed_at");
	}

	/**
	 * Scope a query to only include processed exports.
	 */
	public function scopeProcessed(Builder $query): void
	{
		$query->whereNotNull("processed_at");
	}

	/**
	 * Scope a query to only include successful processed exports.
	 */
	public function scopeSuccessful(Builder $query): void
	{
		$query->processed()->has("file");
	}

	/**
	 * Scope a query to only include unsuccessful processed exports.
	 */
	public function scopeUnsuccessful(Builder $query): void
	{
		$query->processed()->doesntHave("file");
	}
}
