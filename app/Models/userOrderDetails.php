<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class userOrderDetails extends Model
{
    use HasFactory;

    protected $table = 'fms_g18_formdetails';

    protected $fillable = [
        'order_id',
        'user_id',
        'firstname',
        'lastname',
        'email',
        'contact', 
        'item',
        'dimensions',
        'LocationFrom',
        'LocationTo',
        'DropOff-Warehouse',
        'consigneeName',
        'receiverContact',
        'receiveraddress',
        'modeSelection',
        'deliveryDate',
        'price',
        'fee',
        'totalAmount'
    ];

    //Data will fetch into Admin and Users Order Tab
    public function user()
    {
        return $this->belongsTo(TbUserAcc::class, 'user_id', 'id'); // Assuming 'user_id' is the foreign key in the 'userformdetails' table
    }

    //searchOrderDetails
    public static function searchOrders($query)
    {
        return static::where('order_id', 'LIKE', "%$query%")
                     ->orWhere('firstname', 'LIKE', "%$query%")
                     ->orWhere('lastname', 'LIKE', "%$query%")
                     ->get();
    }

}
