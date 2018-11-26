This bundle adds the functionality of kushki payments in Miguel Alcaino's Mindbody Payments prjects.
It requires Symfony > 3.4 to work properly.

Installation
------------

`composer require miguelalcaino/kushki-bundle`

Configuration
--------------
In your `.env` file add (replace the values with your own data):

```
KUSHKI_PUBLIC_ID=XXXXXXX
KUSHKI_PRIVATE_ID=YYYYYYY
```

Create a `kushki.yaml` file in `config/packages`. And add your payment handler:
```
miguel_alcaino_kushki:
    transaction_record:
        transaction_record_factory: miguel_alcaino.mindbody.transaction_record.factory
```
Leave that value as it is if you want to use the MiguelAlcainoMindbodyPaymentsBundle TransactionRecordFactory. If you are planning to use a custom one
it should implament `MiguelAlcaino\PaymentGateway\Interfaces\Factory\TransactionRecordFactoryInterface`. 


**Install the routes**

Create a new `kushki.yaml` file under `config/routes` and it should look like this:
```
kushki_routes:
    resource: '@MiguelAlcainoKushkiBundle/Controller/'
    type: annotation
```


Usage
--------
TODO