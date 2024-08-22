<?php

namespace App;

class Constant
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';

    public const CART_STATUS_NEW = 'new';
    public const CART_STATUS_PROCESSING = 'processing';
    public const CART_STATUS_COMPLETED = 'completed';
    public const CART_STATUS_CANCELED = 'canceled';

    public const CART_PAYMENT_STATUS_PENDING = 'pending';
    public const CART_PAYMENT_STATUS_SUCCESS = 'success';
    public const CART_PAYMENT_STATUS_FAILED = 'failed';

    public const CART_PAYMENT_METHOD_CASH = 'cash';
    public const CART_PAYMENT_METHOD_TRANSFER = 'transfer';

    public const MAX_PRODUCT = 999;
    public const LIMIT_PAGINATION_PRODUCT = 8;
}
