<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    protected $fillable = [
        'account_number',
        'shaba_number',
        'bank_name',
        'user_id'
      ];
      public function user(){
        return $this->belongsTo(User::class);  // Assuming User model has a foreign key 'id' for the user_id field.  If it's different, adjust the model name and foreign key accordingly.  Also, this assumes the BankInfo model has a foreign key 'user_id' for the user_id field.  If it's different, adjust the field name accordingly.  This relationship is one-to-one.  If you need a many-to-many relationship, you'll need to use a pivot table.  This relationship assumes the User model has a hasMany relationship with the BankInfo model.  If it's different, adjust the model name and the relationship method accordingly.  This relationship is one-to-many.  If you need a one-to-one relationship, you'll need to use the belongsTo method instead of hasOne.  This relationship assumes the BankInfo model has a belongsTo relationship with the User
      }
}
