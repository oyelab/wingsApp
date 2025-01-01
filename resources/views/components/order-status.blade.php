@switch($status)
    @case(0)
        Pending
        @break
    @case(1)
        Completed
        @break
    @case(2)
        Processing
        @break
    @case(3)
        Shipped
        @break
    @case(4)
        Refunded
        @break
    @case(5)
        Cancelled
        @break
    @case(6)
        Failed
        @break
    @case(7)
        Refund Requested
        @break
    @default
        Unknown Status
@endswitch