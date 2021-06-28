<?php

namespace App\Models;

class PaymentMethod extends BaseModel
{
    const TYPE_PAYPAL       = 1;
    const TYPE_CREDIT_CARD  = 2;
    const TYPE_MANUAL       = 3;
    const TYPE_OTHERS       = 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_methods';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_name',
        'type',
        'website',
        'help_doc_url',
        'admin_help_doc_link',
        'terms_conditions_link',
        'description',
        'instructions',
        'admin_description',
        'enabled',
        'order',
    ];
}
