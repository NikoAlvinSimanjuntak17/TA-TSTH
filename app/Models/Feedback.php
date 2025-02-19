<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'message'];
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }


        /**
         * @return mixed
         */
        public function getFillable() {
            return $this->fillable;
        }

        /**
         * @param mixed $fillable
         * @return self
         */
        public function setFillable($fillable): self {
            $this->fillable = $fillable;
            return $this;
        }

}