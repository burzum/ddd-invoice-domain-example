# DDD Domain Example

This is a **learning** approach to the tactical aspect of DDD by implementing an invoice domain model.

Any other example in php I found was very trivial and minimalistic. There are a few keys points I'm trying to learn and solve the best way:

* How to hydrate an aggregate root the best with data, from for example a HTTP request?
* How to persist the entity the best? Get the whole data first, merge the entity data to it and then save it to the repository?
* How to construct an aggregate root with lots of properties the best? Factory?
* How to update the entity the best, especially if a lot has changes?
* Is it OK to pass domain services to the aggregate?
* How to deal with the auto-incrementing integer Ids the existing data and system is using?
* Does it make sense that the aggregate has a toArray() method?
* Should the aggregate be immutable and return a new instance when changing state?
* Where would I put a class like the VAT calculator that could be used by more than my current domain?
 * What should it be? A generic domain service?
  * Is it OK to then import that class then into my domain or is there any other way to handle this?

So far the domain code doesn't have any dependency other than dev dependencies for testing and code style.

## Questions asked to the domain expert(s)

* How is an invoice created?
 * Do we already create them manually or only automatic?
  * If we don't create them manually, will we do that in the new version?
   * If we create them manually what is the required data, please name all input that is required
 * Are there any actions taken after a NEW invoice was created?
 * To flag an invoice as "paid", what needs to happen?
  * What actions are taken AFTER an invoice was flagged as paid?
* Can invoices be deleted?
 * If yes, what happens after it was deleted?
 * If no, what else happens to them?
 
**Answers are pending!**

## Business Rules

* All invoice lines added to the invoice must have a price of the same currency as the invoice
* InvoiceNumber is a sequential number based on the DB records incremental id. This is legacy and also an explicit with of the people working with the domain.

## Invoice Domain Model

```
Invoice
├- Id
├- InvoiceNumber
├- InvoiceDate
├- DueDate
├- FirstReminderDate
├- SecondReminderDate
├- Currency
├- PaymentStatus
├- PaidDate
├- Nett
├- Gross
├- VAT
├- VATpercent
├- InvoiceLines (1:N)
|  ├- ItemId
|  ├- ItemName
|  ├- ItemDescription
|  ├- SKU
|  ├- Quantity
|  └- Price
|     └- Value
|     └- Currency
└─ Company (1:1)
   ├─ Id
   └─ Name
└─ Address (1:1)
   ├─ Id
   ├─ FirstName
   ├─ LastName
   ├─ Company
   ├─ Street
   ├─ Street2
   ├─ Zip
   ├─ City
   └─ Country
      ├─ Id
      └─ Name
```

## Things learned (so far)

* It's really nice to focus just on the domain instead of having to worry about any framework
* The code becomes more clear because of the ubiquitous language

## License

GPLv3 

Copyright Florian Krämer
