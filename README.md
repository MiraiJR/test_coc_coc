## How to run

```
composer install
php -S localhost:8000
```

## How to call API

### Postman

Endpoint:

```
http://localhost:8000/public/api/order/calculate_gross_price.php
```

Method: POST <br>
Body: Raw -> JSON

```
{
    "order_id": 1
}
```

## Answer the 8th question

I applied strategy and composite design pattern to handle use case "we add fee by product type without change shipping fee code". <br>
I create one FeeStrategy interface with one method: calculateFee.<br>
Two detail class implement FeeStrategy interface:<br>

- WeightFeeStrategy
- DimensionFeeStrategy

In the future, if we need add fee by product type, we only need create new class ProductTypeFeeStrategy to implement.<br>

About composite, I applied to calculate shipping fee. The shipping fee still implements FeeStrategy interface.<br>
The CompositeShippingFeeStrategy has one property including many fee strategies. <br>
The calculateFee method loops feeStrategies, and find max of returned result from the calculateFee method of each feeStrategies.
