<?php

namespace App\Models;

use Auth;
use App\User;
use App\Common\Repliable;
use App\Common\Attachable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends BaseModel
{
    use SoftDeletes, Repliable, Attachable;

    const STATUS_NEW    = 1; // default
    const STATUS_UNREAD = 2; // All status before UNREAD value considered as unread
    const STATUS_READ   = 3;
    const STATUS_SPAM   = 4;

    const LABEL_INBOX = 1; // default
    const LABEL_SENT  = 2;
    const LABEL_DRAFT = 3; // All label before this DRAFT can be replied and All labels after DRAFT can be deleted permanently.
    const LABEL_SPAM  = 4;
    const LABEL_TRASH = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'user_id',
        'customer_id',
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'order_id',
        'product_id',
        'status',
        'customer_status',
        'label'
    ];

    /**
     * Get the shop associated with the model.
     */
    public function shop()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the customer associated with the model.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => trans('app.guest_customer')
        ])->withoutGlobalScope('MineScope');
    }

    /**
     * Get the order associated with the model.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the item associated with the model.
     */
    public function item()
    {
        return $this->belongsTo(Inventory::class, 'product_id');
    }

    /**
     * Scope a query to only include records that have the given status.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatusOf($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include records that have the given label.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeLabelOf($query, $label)
    {
        return $query->where('label', $label);
    }

    /**
     * Scope a query to only include records from the user.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyMessages($query)
    {
        return $query->where('customer_id', Auth::id());
    }

    /**
     * Scope a query to only include unread messages.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        $status = $this->getStatusCell();

        return $query->where($status, '<', self::STATUS_READ);
    }

    /**
     * Scope information query to only include spam messages.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSpam($query)
    {
        return $query->where('status', self::STATUS_SPAM);
    }

}
