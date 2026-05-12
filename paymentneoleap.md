Public - عام

## AL RAJHI PAYMENT GATEWAY

## MERCHANT INTEGRATION GUIDE - REST API’S

# Version 1. 31

This document explains the step-by-step procedures to integrate Al Rajhi

payment gateway in merchants’ application.

Publishing Date: December 2024


Public - عام ARB Merchant Implementation Guide – REST **|** Version

©2024 AlRajhi Bank API Guide Page 2 of 313

## Version History

The following table displays the version history of this document:

```
Version
No.
```
```
Created or
Updated By
```
```
Reason for Change
```
```
Created or
Updated on
```
```
1.23 AlRajhi Bank 3DS 2.0 Parameters 13 October, 2021
```
```
1.24 AlRajhi Bank URPAY Wallet as Payment Option 16 June, 2022
```
```
1.25 AlRajhi Bank Card Number Masking, Expiry Date 02 August, 2022
```
```
1.26 AlRajhi Bank Webhook Changes 06 October, 2023
```
```
1.27 AlRajhi Bank
```
```
Manual Refund Changes, Tranportal
Decrypted ApplePay Changes & Duplicate
Invoice ID Changes
```
```
01 November 2023
```
1. 28 AlRajhi Bank

```
Tranportal Decrypted Applepay Changes &
Merchant Hosted URPay Changes
```
```
22 Novemeber
2023
```
```
1.29 AlRajhi Bank
```
```
UDF7 Parameter Changes for Non Saved
Card Capture Transactons
```
```
29 January, 2024
```
```
1.30 AlRajhi Bank Credit Card Installment Changes Updated 26 August, 2024
```
```
1.31 AlRajhi Bank
```
```
Addition of Mandatory Request Header for
Security Enhancement Under “Chapter 2
Integration Guidelines”
```
```
24 December 2024
```

## Public - عام ARB Merchant Implementation Guide – REST | Version





ARB Merchant Implementation Guide - REST APIs | Introduction

© 20 24 AlRajhi Bank API Guide Page 7 of 313

## Chapter 1 INTRODUCTION

PURPOSE OF THE DOCUMENT .................................................................................................. 8

TARGET AUDIENCE .............................................................................................................. 8


ARB Merchant Implementation Guide - REST APIs | Introduction

© 20 24 AlRajhi Bank API Guide Page 8 of 313

## PURPOSE OF THE DOCUMENT

The Payment Gateway follows industry standards and norms as prescribed by Master-Card and

Visa International as well in conformity with Payment Card Industry – Data Security Standards

commonly referred to as PCI – DSS.

In order that the AL Rajhi Bank merchants are integrated in a secure and mandated manner, this

reference document is being shared. The expectation being that the merchant’s system integrator

or auditor can refer to a document while performing integration as well as post integration. It

contains the technical integration details including message formats to be used in communicating

to the Payment Gateway irrespective of the merchant platform being used. The document also

shares the best practices and recommendations the merchant should follow during the integration

with Payment Gateway.

## TARGET AUDIENCE

This document is intended for Partner integration teams, project managers, developers, and

testers.


ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 9 of 313

## CHAPTER 2 GETTING STARTED

START BUILDING WITH ARB PAYMENT GATEWAY ......................................................................... 10

BASIC UNDERSTANDING OF ARB PAYMENT GATEWAY .................................................................... 11

BASICS OF COLLECTING PAYMENTS WITH ARB PAYMENT GATEWAY .................................................... 12

INTEGRATION GUIDELINES ................................................................................................... 13

TEST INSTRUMENTS ........................................................................................................... 13

_This chapter contains detailed instructions of building merchant application with ARB Payment_

_Gateway._


ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 10 of 313

## START BUILDING WITH ARB PAYMENT GATEWAY

Alrajhi Payment Gateway offers a secure, PCI-DSS compliant approach to save Debit card, Credit

card, Net-Banking, UPI and Wallet payments from the merchants.

1. Once the Merchant on-boarded on ARB payment gateway, merchant would be provided with

```
Payment gateway application URL and login credentials.
```
```
Notes: Generate your staging account credentials. These are required to explore
ARB Payment Gateway integration solutions.
```
2. Merchant to logs in to ARB payment gateway merchant portal and download the following:

```
 Tranportal ID & Tranportal password
```
**- Tranportal ID** and **Tranportal password** are unique values provided by ARB
    Payment Gateway via registered mail as well.
**-** The details are required for integration with ARB payment gateway.
 Resource Key
**- Resource key** is a unique secret key used for secure encryption and decryption of
every request.
**- This should not be shared with anyone.**


ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 11 of 313

## BASIC UNDERSTANDING OF ARB PAYMENT GATEWAY

The ARB payment gateway’s merchant application is a well secured interface that captures

payment related data between the merchant and the customer:

Some of the features are :

```
 View payments received from your customers
 View transactions ARB PG makes into your account
 Initiate and track the refund
 Generate and download all kinds of transaction reports
```

ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 12 of 313

## BASICS OF COLLECTING PAYMENTS WITH ARB PAYMENT GATEWAY

1. A user adds goods & services in cart and clicks the **Alrajhi Payment Gateway** button
    in your application (the merchant’s application).
2. A checkout form is shown where the user fills in the payment details and authorizes
    the payment.
    There are two ways of processing the payment with ARB payment gateway with API
    integration:
     Bank Hosted setup
     Merchant Hosted setup
3. After completion of a transaction, Alrajhi Payment Gateway posts the response
    (success or failed) on a Callback URL defined by you (the merchant).
4. Based on the response received, you display the order status to the customer.
5. See a real-time summary of payments received and other detail in the merchant portal
    URL:

```
https://digitalpayments.alrajhibank.com.sa/mrchptl/merchant.htm
```
```
Navigation to transaction detail report in merchant portal is as below :
Merchant Portal ->Reports->Transaction Reports->Transaction Detail Report
```
6. Receive payments collected from customers in your bank account on the next business
    day.


ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 13 of 313

## INTEGRATION GUIDELINES

Mandatory steps to be followed by Merchant Integration Team:

1. Verify the endpoints by sending request in postman application.
2. Frame the Json request of **Plain Trandata** with request parameters as specified in the
    document
3. Encrypt the plain json request with the **Resource Key** received in the mail.
4. Frame the encrypted request and send it to ARB Payment Gateway endpoint URL
    shared via mail.
5. After receiving the response from ARB Payment Gateway, decrypt the encrypted
    trandata using the resource key received in the mail.
6. Process the plain trandata - response message.

**Important Note: It is mandatory to include the customer’s IP Address in the merchant’s**

**request for both bank-hosted and merchant-hosted transactions. Failure to do so will**

**result in the payment gateway declining the transaction due to a risk assessment**

**failure.**

**Below is the required Request Header**

X-FORWARDED-FOR – The Customer IP Address must be listed first, followed by other IPs,

separated by commas, if applicable.

**Here is an example of the X-FORWARDED-FOR header:**

X-FORWARDED-FOR:203.0.113.195, 1 72. 2 0.2.

**In this example:**

**203.0.113. 195** is the customer’s IP address (must always be listed first).

**1 72. 2 0.2.10** are additional IPs, separated by commas, if applicable.

## TEST INSTRUMENTS

ARB PG APIs are complete RESTFUL API’s; Merchants can test the API’s on sandbox setup before

testing on Live environment.

Test Card details.


ARB Merchant Implementation Guide - REST APIs | Getting Started

© 20 24 AlRajhi Bank API Guide Page 14 of 313

```
Card type Card Number Expiry Date CVV
```
```
Credit 4012001037141112 12/2027 212
```
```
Credit 5297412201764352 01/2022 999
```

## ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

## CHAPTER 3 TRANSACTION FLOW

- ©2024 AlRajhi Bank API Guide Page 3 of
- CHAPTER 1 INTRODUCTION Table of Contents
- PURPOSE OF THE DOCUMENT
- TARGET AUDIENCE
- CHAPTER 2 GETTING STARTED
- START BUILDING WITH ARB PAYMENT GATEWAY
- BASIC UNDERSTANDING OF ARB PAYMENT GATEWAY
- BASICS OF COLLECTING PAYMENTS WITH ARB PAYMENT GATEWAY
- INTEGRATION GUIDELINES
- TEST INSTRUMENTS
- CHAPTER 3 TRANSACTION FLOW
- BANK HOSTED INTEGRATION
   - Request - Payment Token Generation API
      - MADA Mandatory Parameters
      - Split Payment or Payout.
      - SADAD
      - Airline
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- BANK HOSTED INTEGRATION (FASTER CHECKOUT)
   - Request - Payment Token Generation API
      - Payout Future
      - SADAD
      - Airline
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- BANK HOSTED INTEGRATION (IFRAME)
   - Request - Payment Token Generation API
      - Payout Future
      - SADAD
      - Airline
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- ©2024 AlRajhi Bank API Guide Page 4 of Public - عام ARB Merchant Implementation Guide – REST | Version
- MERCHANT HOSTED TRANSACTION (3D SECURE)
   - Request - Payment Token Generation API
      - Payout Future
      - SADAD
      - Airline
   - Initial Response - Payment ID and Payment Processing Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- MERCHANT HOSTED TRANSACTION (NON 3D SECURE)
   - Request - Payment Token Generation API
      - Payout Future
      - SADAD
      - Airline
   - Final Response – Transaction Status
- MERCHANT HOSTED CARD ON FILE TRANSACTIONS (3D SECURE)
   - Saving Cards During Transaction (Card Registration)
   - Request - Payment Token Generation API
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- MERCHANT HOSTED CARD ON FILE TRANSACTIONS (NON-3D SECURE)
   - Saving Cards During Transaction (Card Registration)
   - Request - Payment Token Generation API
   - Final Response – Transaction Status
- MERCHANT HOSTED CARD ON FILE REGISTRATIONS (WITHOUT TRANSACTION)
   - Request – Card Registration Token Generation API
   - Response – Card Registration Status
- MERCHANT HOSTED CARD ON FILE DEREGISTRATION
   - Request – Card Deregistration Token Generation API
   - Response – Card Deregistration Status
- MERCHANT HOSTED TRANSACTION FLOW (INQUIRY, VOID, REFUND, CAPTURE TRANSACTIONS)
   - Request
   - Response
- BANK HOSTED INTEGRATION FLOW (APPLE PAY)
   - Request - Payment Token Generation API
      - MADA Mandatory Parameters
      - Split Payment or Payout.
      - SADAD
      - Airline
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY)
- ©2024 AlRajhi Bank API Guide Page 5 of Public - عام ARB Merchant Implementation Guide – REST | Version
   - Request - Payment Token Generation API
      - SADAD
   - Final Response – Transaction Status
- PRE-AUTHENTICATION TRANSACTIONS (AIRLINE)
   - Request
      - Payout Future
      - SADAD
   - Response
- INVOICE PAYMENT TRANSACTION FLOW
   - Request - Payment Token Generation API
   - Initial Response - Payment ID and Processing Page URL
   - Final Response
- WEBHOOK MERCHANT NOTIFICATION FLOW
- MERCHANT NOTIFICATION FLOW FOR BANK HOSTED TRANSACTIONS
   - Request - Notification Generation API
   - Response - Acknowledgement
   - Final response to merchant
   - Response – No Acknowledgement
- ISSUER COUNTRY API (CARD BIN CHECK)
   - Response from PG to Merchant
- BANK HOSTED RECURRING TRANSACTION FLOW (3D SECURE)
   - Request - Payment Token Generation API
      - Split Payment or Payout.
      - SADAD
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- MERCHANT HOSTED RECURRING TRANSACTION FLOW (3D SECURE)
   - Request - Payment Token Generation API
      - Payout Future
      - SADAD
   - Initial Response - Payment ID and Payment Page URL
   - Framing Payment URL
   - Final Response – Transaction Status
- PAGE URL RECURRING PAYMENT FOR MADA – MERCHANT INITIATED INITIAL RESPONSE - PAYMENT ID AND PAYMENT
   - Request
   - Response
- MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY PSP INTEGRATION)
- JS WIDGET INTEGRATION
- MERCHANT HOSTED TRANSACTION FLOW (CREDIT CARD INSTALLMENT INTEGRATION)
   - Initial - Get Installment Plans
      - Request - Get Installment Plans
- ©2024 AlRajhi Bank API Guide Page 6 of Public - عام ARB Merchant Implementation Guide – REST | Version
      - Response - Get Installment Plans
   - Merchant Hosted Credit Card Installment Transaction
      - Request - Payment Token Generation API
      - Initial Response - Payment ID and Payment Page URL
      - Framing Payment URL
      - Final Response – Transaction Status
- BEST PRACTICES
- PRIVATE AND PUBLIC KEY
- SETTING UP YOUR SERVER
- APPLE PAY PROCESS FOR MERCHANT REGISTRATION AND CERTIFICATES
- COMMANDS TO GENERATE MERCHANT IDENTITY CERTIFICATE AND PAYMENT PROCESSING CERTIFICATE
- MERCHANT HOSTED URPAY INTEGRATION
- FAQS ON INTEGRATION PROCESS
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVA
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVASCRIPT
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR PHP..........................................................
- CHAPTER 4 TROUBLESHOOTING
- KNOWN ERROR CODES
- HANDLING FINAL RESPONSE FROM PAYMENT GATEWAY
- CHAPTER 5 INDEX
- © 20 24 AlRajhi Bank API Guide Page 15 of
- BANK HOSTED INTEGRATION Chapter 3 TRANSACTION FLOW
- BANK HOSTED INTEGRATION (FASTER CHECKOUT)
- BANK HOSTED INTEGRATION (IFRAME)
- MERCHANT HOSTED TRANSACTION (3D SECURE)
- MERCHANT HOSTED TRANSACTION (NON 3D SECURE)
- MERCHANT HOSTED CARD ON FILE TRANSACTIONS (3D SECURE)
- MERCHANT HOSTED CARD ON FILE TRANSACTIONS (NON-3D SECURE)
- MERCHANT HOSTED CARD ON FILE REGISTRATIONS (WITHOUT TRANSACTION)
- MERCHANT HOSTED CARD ON FILE DEREGISTRATION
- MERCHANT HOSTED TRANSACTION FLOW (INQUIRY, VOID, REFUND, CAPTURE TRANSACTIONS)
- BANK HOSTED INTEGRATION FLOW (APPLE PAY)
- MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY)
- PRE-AUTHENTICATION TRANSACTIONS (AIRLINE)
- INVOICE PAYMENT TRANSACTION FLOW
- WEBHOOK MERCHANT NOTIFICATION FLOW
- MERCHANT NOTIFICATION FLOW FOR BANK HOSTED TRANSACTIONS
- ISSUER COUNTRY API (CARD BIN CHECK)
- BANK HOSTED RECURRING TRANSACTION FLOW (3D SECURE)
- MERCHANT HOSTED RECURRING TRANSACTION FLOW (3D SECURE)
- URL RECURRING PAYMENT FOR MADA – MERCHANT INITIATED INITIAL RESPONSE - PAYMENT ID AND PAYMENT PAGE
- MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY PSP INTEGRATION)
- JS WIDGET INTEGRATION
- MERCHANT HOSTED TRANSACTION FLOW (CREDIT CARD INSTALLMENT INTEGRATION)
- BEST PRACTICES
- PRIVATE AND PUBLIC KEY
- SETTING UP YOUR SERVER
- APPLE PAY PROCESS FOR MERCHANT REGISTRATION AND CERTIFICATES
- COMMANDS TO GENERATE MERCHANT IDENTITY CERTIFICATE AND PAYMENT PROCESSING CERTIFICATE
- MERCHANT HOSTED URPAY INTEGRATION
- FAQS ON INTEGRATION PROCESS
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVA
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVASCRIPT
- SAMPLE ENCRYPTION AND DECRYPTION CODE FOR PHP................................................................


ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 16 of 313

## BANK HOSTED INTEGRATION

This section illustrates how you can integrate the bank hosted flow on your website application.


ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 17 of 313

1. User visits the merchant application and creates order.
2. Merchant application backend server calls **Payment Token Generation API** to get the
    transaction token.
3. ARB Payment gateway internally validates the request.

```
 In case of successful validation, ARB PG provides Payment ID and Payment Page
URL in the response.
```
- Merchant needs to frame the payment page URL with Payment ID, Hence the ARB
    payment page is displayed.
 In case of failure, ARB PG provides **Error Code** and **Description**.

```
Note: If merchant notification is disabled, then ARB Payment gateway will provide the final
response in URL redirection.
```
4. User enters the payment details and authorizes the transaction on the ARB PG bank’s
    page.
5. The ARB PG application process the transaction and returns the transaction response to
    the merchant site.
6. Merchant server calls the transaction status API to verify the transaction response.
7. Finally, the merchant application displays the transaction status to user.


ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 18 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
3
```
```
responseUR
L
```
```
M Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization: 4
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant portal.
```
```
4 id M Alphanum
```
```
Tranportal ID. Merchant download the
same in merchant portal
```
```
5
```
```
currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 19 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
12
```
```
response
URL
```
```
M Alphanum
```
```
The merchant success URL where
Payment Gateway send the notification
request.
```
```
13 errorURL M Alphanum
```
```
The merchant error URL where Payment
Gateway send the response in case any
error while processing the transaction.
```
```
14 langid O Alphabetic
```
```
Language ID. Based on language ID
arabic language will be displayed on
payment page. Value should be 'ar' or
'AR' for arabic language.
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 20 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata> ”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource Key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 21 of 313

```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```
```
}]
```
#### MADA Mandatory Parameters

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same
in merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 22 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
##### {

```
//MADA Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 2 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
11 responseURL M
```
```
Alphanu
m
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
12 errorURL M
```
```
Alphanu
m
```
```
The merchant error URL where Payment Gateway
send the response in case any error while
Processing the transaction.
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 23 of 313

```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```
```
}]
```
#### Split Payment or Payout.

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//Conditional if Merchant Opted for Split Payment or Payout.
```
```
"accountDetails":[
```
```
{"bankIdCode":"12345d6f","iBanNum": "567896743281926354276254",
```
```
"benificiaryName":"AlRajhi Bank Services",
```
```
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode":"1234ret3","iBanNum": "987656743281926354276254",
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
##### 4

```
benificiaryNa
me C^
```
```
Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
##### 5

```
serviceAmoun
t C^ Numeric^ Service Amount^
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 24 of 313

```
"benificiaryName":"DIGITAL CO",
```
```
"serviceAmount":"300.00","valueDate":"202 012 31" }] ,
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"POSTP
AID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### },

```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY' 'PAY_SAVE'
'ADVANCE' 'PARTIAL_PAYMENT' 'OVER_PAYMENT'
```
```
2 billerID C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount C Numeric billAmount
```
```
4 billType^ C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in advance -
POSTPAID : Paid at the end
```
```
5 billNumber^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 25 of 313

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline C JSON Object Conditional - for Airline Merchant
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number
```
```
1.1.1 itinerary^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1.1.1 leg^ C JSON Array Conditional -^ for Airline Merchant^
```
```
1.1.1.1.1 carrierCode C Alphanum The carrier code for the leg
```
```
1.1.1.1.2 departureAirport C Alphanum The departure airport for the passenger
1.1.1.1.3 departureDate C Alphanum The departure date for the leg
1.1.1.1.4 departureTime^ C Alphanum The departure airport for the passenger^
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg^
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg
```
```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1.9 flightNumber^ C Alphanum The flight number for the leg^
1.1.1.1.10 travelClass^ C Alphanum The class of service for the leg^
1.1.1.2 numberInParty C Alphanum
1.1.1.3 originCountry C Alphanum The origin Country of the itinerary
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName^ C Alphanum The passenger first^ name^
1.1.2.2 lastName^ C Alphanum The passenger last name
1.1.3 ticket C JSON Object Conditional - for airline merchant
1.1.3.1 issue C JSON Object Conditional - for airline merchant
1.1.3.1.1 carrierCode^ C Alphanum Code of the airline that issuing the ticket^
1.1.3.1.2 carrierName^ C Alphanum Name of the airline that is issuing the ticket.^
1.1.3.1.3 travelAgentCode C Alphanum Code of the Travel Agent that issuing the ticket
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the ticket
```
```
1.1.3.2 totalFare C Numeric Ticket Total Fare
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 26 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ { "carrierCode":
"MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11", "departureTime":
"06:50:00Z", "destinationAirport": "KUL", "destinationArrivalDate": "2021- 05 - 11",
"destinationArrivalTime": "10:35:00Z", "fareBasis": "BOWMPH6", "flightNumber":
"0805", "travelClass": "B" }, { "carrierCode": "UL", "departureAirport": "KUL",
"departureDate": "2021- 05 - 11", "departureTime": "15:00:00Z", "destinationAirport":
"CMB", "destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime":
"16:05:00Z", "fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName": "KAI
MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees": "59518.00",
"totalTaxes": "4600.00" } } }
```
##### }]

```
1.1.3.3 totalFees^ C Numeric Total fee for the ticket.^
1.1.3.4 totalTaxes^ C Numeric Tax portion of the order amount.^
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 27 of 313

### Initial Response - Payment ID and Payment Page URL

```
Attributes - Initial Response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then
status will be ‘1’. If the validation failed,
then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if
the validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway
will provide the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway
will provide the respective error description
```
```
Sample JSON Response - Initial Response from ARB PG to Merchant
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response in case of successful validation, if failure then error code and
description will be provided. The below response will be in plain format and there is no
encryption for the below. Merchant can directly parse the response-based status and result
fields as mentioned below.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"100201931620827468:https://securepayments.alrajhibank.com.sa/pg/p
aymentpage.htm", //Payment ID:Paymentpage URL
```
```
“error”: null,
```
```
“errorText”: null }]
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 28 of 313

```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

After Initial Response from ARB PG, merchant needs to frame the payment page URL like the

below sample.

https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=1002019316208

27468


ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 29 of 313

### Final Response – Transaction Status

```
Attribute - Final URL redirection response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique payment Id generated by PG and
merchant can use this ID to match the
response from PG
```
```
2 trandata C Alphanum All the below response parameters
encrypted and send the encrypted value
in trandata
```
```
3 error C Alphanum If any error, PG will send the error code
```
```
4 errorText C Alphanum If any error, PG will send the error
description
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by payment
gateway. Based on this payment Id
merchant can match the final URL
redirection response
```
```
2 result M Alphanum Transaction status. Value will be
'CAPTURED' for purchase successful
and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric Unique transaction Id generated by
Payment gateway and merchant can
use this id for initiating supported
transactions (Void, refund and
inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these
fields. The field data is passed along
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 30 of 313

```
S. No Fields M/C/O Field Type Description
```
```
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
10 udf 4 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
11 udf5 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by PG
```
```
14 authCode M Numeric 6 digit authorization code received
from switch
```
```
15 cardType M Alphabetic Card Brand name. Value will be "Visa"
or "MasterCard" or "Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 31 of 313

```
S. No Fields M/C/O Field Type Description
```
```
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
17 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
If Merchant notification is disabled, then ARB Payment gateway will provide the final response
in URL redirection. Below is the sample response from ARB PG to merchant
```
```
[{
```
```
//Redirection Parameters
```
```
“paymentId”:” 100201935166676976 ”,
```
```
“trandata”:”<encrypted trandata>”,
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:” 100201935166676976 ”,
```

ARB Merchant Implementation Guide - REST APIs | Transaction FLOW

© 20 24 AlRajhi Bank API Guide Page 32 of 313

```
”result”: ”CAPTURED”,
```
```
”transId”:201935166561122,
```
```
”ref”:”935110000001”,
```
```
”date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2-4 Digits
```
##### }]


©2024 API Guide Page 33 of 313

## BANK HOSTED INTEGRATION (FASTER CHECKOUT)

## BANK HOSTED INTEGRATION (FASTER CHECKOUT)

This section illustrates how you can integrate the bank hosted (Faster checkout) flow on your

website application. Faster Checkout functionality is supported for the merchants only when

Faster Checkout flag is enabled at the terminal level.


©2024 API Guide Page 34 of 313

1. User visits the merchant application and creates order.
2. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token.
3. ARB Payment gateway internally validates the request.

```
 In case of successful validation, ARB PG provides Payment ID and Payment Page
URL in the response.
```
- Merchant needs to frame the payment page URL with Payment ID, Hence the
    ARB payment page is displayed.
 In case of failure, ARB PG provides **Error Code** and **Description**.

```
Note: If merchant notification is disabled, then ARB Payment gateway will provide the
final response in URL redirection.
```
4. Select the payment details already stored in the bank’s database. (Faster checkout)
    Or
    User enters the payment details and authorizes the transaction on the ARB PG bank’s
    page. (Standard checkout)
5. The ARB PG application process the transaction and returns the transaction response
    to the merchant site.
6. Merchant server calls the transaction status API to verify the transaction response.
7. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 35 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
3
```
```
responseUR
L
```
```
M Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant portal.
```
```
4 id M Alphanum
```
```
Tranportal ID. Merchant download the
same in merchant portal
```
```
5
```
```
currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```

©2024 API Guide Page 36 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
12
```
```
response
URL
```
```
M Alphanum
```
```
The merchant success URL where
Payment Gateway send the notification
request.
```
```
13 errorURL M Alphanum
```
```
The merchant error URL where Payment
Gateway send the response in case any
error while processing the transaction.
```
```
14 langid O Alphabetic
```
```
Language ID. Based on language ID
arabic language will be displayed on
payment page. Value should be 'ar' or
'AR' for arabic language.
```
```
15 custid M Numeric Unique Customer ID generated on faster
checkout registration.
```
```
16 cust_card
HolderNa
me
```
```
O Alphabetic Cardholder Name
```

©2024 API Guide Page 37 of 313

```
S. No Fields M/C/O Field Type Description
```
```
17 cust_mobi
le_numbe
r:
```
```
O Numeric Customer Mobile Number
```
```
18 cust_emai
lId
```
```
O Alphanum Customer E-mail ID
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata> ”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource Key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```

©2024 API Guide Page 38 of 313

```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```
```
//conditional if Merchant opted for Faster Checkout.
```
```
"custid":"201936122890007",
```
```
"cust_cardHolderName":"Test",
```
```
"cust_mobile_number":"7788667755",
```
```
"cust_emailId":”Test@gmail.com”
```
```
}]
```
#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```

©2024 API Guide Page 39 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
3 iBanNum C
```
```
Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
##### 5

```
serviceAmoun
t C^ Numeric^ Service Amount^
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```
```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE' 'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount^ C Numeric billAmount^
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in
advance - POSTPAID : Paid at the end
```

©2024 API Guide Page 40 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
5 billNumber^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number^
```
```
1.1.1 itinerary C JSON Object Conditional - for Airline Merchant
```
```
1.1.1.1 leg C JSON Array Conditional - for Airline Merchant
```
```
1.1.1.1.1 carrierCode^ C Alphanum The carrier code for the leg^
```
```
1.1.1.1.2 departureAirport^ C Alphanum The departure airport for the passenger^
1.1.1.1.3 departureDate C Alphanum The departure date for the leg
1.1.1.1.4 departureTime C Alphanum The departure airport for the passenger
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg^
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg^
```

©2024 API Guide Page 41 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ {
"carrierCode": "MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11",
"departureTime": "06:50:00Z", "destinationAirport": "KUL",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "10:35:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0805", "travelClass": "B" }, {
"carrierCode": "UL", "departureAirport": "KUL", "departureDate": "2021- 05 - 11",
"departureTime": "15:00:00Z", "destinationAirport": "CMB",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "16:05:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName":
"KAI MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees":
"59518.00", "totalTaxes": "4600.00" } } }
```
##### }]

```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg^
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1.9 flightNumber C Alphanum The flight number for the leg
1.1.1.1.10 travelClass C Alphanum The class of service for the leg
1.1.1.2 numberInParty C Alphanum
1.1.1.3 originCountry^ C Alphanum The origin Country of the itinerary^
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName C Alphanum The passenger first name
1.1.2.2 lastName C Alphanum The passenger last name
1.1.3 ticket C JSON Object Conditional - for airline merchant
1.1.3.1 issue^ C JSON Object Conditional -^ for airline merchant^
1.1.3.1.1 carrierCode^ C Alphanum Code of the airline that issuing the ticket^
1.1.3.1.2 carrierName C Alphanum Name of the airline that is issuing the ticket.
1.1.3.1.3 travelAgentCode C Alphanum Code of the Travel Agent that issuing the ticket
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the
ticket
```
```
1.1.3.2 totalFare^ C Numeric Ticket Total Fare^
1.1.3.3 totalFees^ C Numeric Total fee for the ticket.^
1.1.3.4 totalTaxes C Numeric Tax portion of the order amount.
```

©2024 API Guide Page 42 of 313

### Initial Response - Payment ID and Payment Page URL

```
Attributes - Initial Response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then
status will be ‘1’. If the validation failed,
then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if
the validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway
will provide the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway
will provide the respective error description
```
```
Sample JSON Response - Initial Response from ARB PG to Merchant
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response in case of successful validation, if failure then error code and
description will be provided. The below response will be in plain format and there is no
encryption for the below. Merchant can directly parse the response-based status and result
fields as mentioned below.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"100201931620827468:https://securepayments.alrajhibank.com.sa/pg/pa
ymentpage.htm", //Payment ID:Paymentpage URL
```
```
“error”: null,
```
```
“errorText”: null }]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```

©2024 API Guide Page 43 of 313

```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

After Initial Response from ARB PG, merchant needs to frame the payment page URL like the

below sample.

https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=1002019316

20827468


©2024 API Guide Page 44 of 313

### Final Response – Transaction Status

```
Attribute - Final URL redirection response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique payment Id generated by PG and
merchant can use this ID to match the
response from PG
```
```
2 trandata C Alphanum All the below response parameters
encrypted and send the encrypted value
in trandata
```
```
3 error C Alphanum If any error, PG will send the error code
```
```
4 errorText C Alphanum If any error, PG will send the error
description
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by payment
gateway. Based on this payment Id
merchant can match the final URL
redirection response
```
```
2 result M Alphanum Transaction status. Value will be
'CAPTURED' for purchase successful
and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 fcCustId M Numeric
```
```
Unique Customer ID generated on
faster checkout registration.
```
```
5 transId M Numeric Unique transaction Id generated by
Payment gateway and merchant can
use this id for initiating supported
transactions (Void, refund and
inquiry)
```
```
6 date M Numeric Transaction date and time
```
```
7 trackId M Numeric Merchant unique reference no
```

©2024 API Guide Page 45 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf1 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
9 udf2 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
10 udf3 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
11 udf 4 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
12 udf5 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
13 amt M Numeric Transaction amount
```
```
14 authRespCode M Numeric Auth response code provided by PG
```
```
15 authCode M Numeric 6 digit authorization code received
from switch
```
```
16 cardType M Alphabetic Card Brand name. Value will be "Visa"
or "MasterCard" or "Mada".
```

©2024 API Guide Page 46 of 313

```
S. No Fields M/C/O Field Type Description
```
```
17 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
18 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
19 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
20 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
If Merchant notification is disabled, then ARB Payment gateway will provide the final
response in URL redirection. Below is the sample response from ARB PG to merchant
```
```
[{
```
```
//Redirection Parameters
```
```
“paymentId”:” 100201935166676976 ”,
```
```
“trandata”:”<encrypted trandata>”,
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```
```
Plain Trandata:
```
##### [{

```
“paymentId”:”100201935166676976”,
```
```
”result”:”CAPTURED”,
```

©2024 API Guide Page 47 of 313

```
”transId”:”201935166561122”,
```
```
"fcCustId":"201936122890007",
```
```
”ref”:”935110000001”,
```
```
”date”:”1217”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
“actionCode”:”1” ,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06",
```
```
"expYear":"2024" //2-4 Digits
```
```
}]
```

©2024 API Guide Page 48 of 313

## BANK HOSTED INTEGRATION (IFRAME)

## BANK HOSTED INTEGRATION (IFRAME)

Payment gateway shall support Iframe integration to enable merchants to accept online

payments on their own checkout page without having to be a PCI compliant. Instead of

being redirected to ARB Payment page, customers will remain on merchant website to make

payments. However, at the back end, ARB PG will securely collect the payment information

and get it authorized.


©2024 API Guide Page 49 of 313

1. User visits the merchant application and creates order.
2. Merchant application backend server calls Payment Token Generation API to get the
    transaction token.
3. ARB Payment gateway internally validates the request.
     In case of successful validation, ARB PG provides Payment ID and Payment Page
       URL in the response.
- Merchant needs to frame the payment page URL with Payment ID, Hence the
ARB payment page is displayed.
- Merchant needs to add the code snippet to load the payment page in an iframe
window.
     In case of failure, ARB PG provides **Error Code** and **Description**.

```
Note: If merchant notification is disabled, then ARB Payment gateway will provide the
final response in URL redirection.
```
4. Select the payment details already stored in the bank’s database. (For faster checkout)
    Or
    User enters the payment details and authorizes the transaction on the ARB PG bank’s
    page.
5. The ARB PG application process the transaction and returns the transaction response
    to the merchant site.
6. Merchant server calls the transaction status API to verify the transaction response.
7. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 50 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
3
```
```
responseUR
L
```
```
M Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant portal.
```
```
4 id M Alphanum
```
```
Tranportal ID. Merchant download the
same in merchant portal
```
```
5
```
```
currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```

©2024 API Guide Page 51 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 M Alphanum
```
```
Merchant needs to send value 'iframe' in
the UDF3 field.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
12
```
```
response
URL
```
```
M Alphanum
```
```
The merchant success URL where
Payment Gateway send the notification
request.
```
```
13 errorURL M Alphanum
```
```
The merchant error URL where Payment
Gateway send the response in case any
error while Processing the transaction.
```
```
14 langid O Alphabetic
```
```
Language ID. Based on language ID
arabic language will be displayed on
payment page. Value should be 'ar' or
'AR' for arabic language.
```
```
15 custid M Numeric Unique Customer ID generated on faster
checkout registration.
```
```
16 cust_card
HolderNa
me
```
```
O Alphabetic Cardholder Name
```
```
17 cust_mobi
le_numbe
r:
```
```
O Numeric Customer Mobile Number
```

©2024 API Guide Page 52 of 313

```
S. No Fields M/C/O Field Type Description
```
```
18 cust_emai
lId
```
```
O Alphanum Customer E-mail ID
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata> ”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource Key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”,
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”udf3”:”iframe”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```

©2024 API Guide Page 53 of 313

```
”errorURL”: ”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```
```
}]
```
#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C JSON
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C
```
```
Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
##### 5

```
serviceAmoun
t C^ Numeric^ Service Amount^
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 54 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE' 'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount C Numeric billAmount
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in
advance - POSTPAID : Paid at the end
```
```
5 billNumber^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 55 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number^
```
```
1.1.1 itinerary C JSON Object Conditional - for Airline Merchant
```
```
1.1.1.1 leg C JSON Array Conditional - for Airline Merchant
```
```
1.1.1.1.1 carrierCode C Alphanum The carrier code for the leg
```
```
1.1.1.1.2 departureAirport^ C Alphanum The departure airport for the passenger^
1.1.1.1.3 departureDate^ C Alphanum The departure date for the leg^
1.1.1.1.4 departureTime C Alphanum The departure airport for the passenger
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg^
```
```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg^
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1.9 flightNumber C Alphanum The flight number for the leg
1.1.1.1.10 travelClass C Alphanum The class of service for the leg
1.1.1.2 numberInParty^ C Alphanum
1.1.1.3 originCountry^ C Alphanum The origin Country of the itinerary^
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName C Alphanum The passenger first name
```

©2024 API Guide Page 56 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ {
"carrierCode": "MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11",
"departureTime": "06:50:00Z", "destinationAirport": "KUL",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "10:35:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0805", "travelClass": "B" }, {
"carrierCode": "UL", "departureAirport": "KUL", "departureDate": "2021- 05 - 11",
"departureTime": "15:00:00Z", "destinationAirport": "CMB",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "16:05:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName":
"KAI MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees":
"59518.00", "totalTaxes": "4600.00" } } }
```
##### }]

```
1.1.2.2 lastName^ C Alphanum The passenger last name
1.1.3 ticket^ C JSON Object Conditional -^ for airline merchant^
1.1.3.1 issue^ C JSON Object Conditional -^ for airline merchant^
1.1.3.1.1 carrierCode C Alphanum Code of the airline that issuing the ticket
1.1.3.1.2 carrierName^ C Alphanum Name of the airline that is issuing the ticket.^
1.1.3.1.3 travelAgentCode^ C Alphanum Code of the Travel Agent that issuing the ticket^
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the
ticket
1.1.3.2 totalFare C Numeric Ticket Total Fare
1.1.3.3 totalFees C Numeric Total fee for the ticket.
1.1.3.4 totalTaxes C Numeric Tax portion of the order amount.
```

©2024 API Guide Page 57 of 313

### Initial Response - Payment ID and Payment Page URL

```
Attributes - Initial Response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then
status will be ‘1’. If the validation failed,
then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if
the validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway
will provide the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway
will provide the respective error description
```
```
Sample JSON Response - Initial Response from ARB PG to Merchant
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response in case of successful validation, if failure then error code and
description will be provided. The below response will be in plain format and there is no
encryption for the below. Merchant can directly parse the response-based status and result
fields as mentioned below.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"100201931620827468:https://securepayments.alrajhibank.com.sa/pg/pa
ymentpage.htm", //Payment ID:Paymentpage URL
```
```
“error”: null,
```
```
“errorText”: null }]
```
**Failure:**

```
[{
```
```
"status": "2",
```

©2024 API Guide Page 58 of 313

```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```

©2024 API Guide Page 59 of 313

### Framing Payment URL

After Initial Response from ARB PG, merchant needs to frame the payment page URL like the

below sample.

https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=1002019316

20827468

Merchant needs to add the following code snippet to load the payment page in an iframe

window:

**Code Snippet**

```
if("iframe".equals(pipe.getUdf3()))
```
```
{
```
```
%>
```
```
<script>
```
```
if(window.parent.document.getElementById("iframe")!=null)
```
```
{
```
```
var division=document.createElement("div");
```
```
division.setAttribute("id", "payframe");
```
```
division.setAttribute("style", "min-height: 100%; position:
fixed; top: 0px; left: 0px; width: 100%; height: 100%; background: rgba(0,
0, 0, 0); padding-right: 0px; padding-left: 0px;padding-top: 0px;");
```
```
division.innerHTML ='<div style="position: absolute;right:
0px;top: 0px;cursor: pointer;font-size: 24px;opacity: .6;width:
100%;text-align: center;line-height: 0px;z-index: 1;" class="close"
id="F" onclick="javascript:
window.parent.document.getElementById(\'iframe\').parentNode.removeChil
d(window.parent.document.getElementById(\'iframe\'));window.parent.docu
ment.getElementById(\'payframe\').parentNode.removeChild(window.parent.
document.getElementById(\'payframe\'));">x</div><iframe id="iframe"
style="opacity: 7; height: 100%; position: relative; background: none;
display: block; border: 0px none transparent; margin-left: 0%; padding:
0px; z-index: 2; width: 100%; margin-top: 0%" allowtransparency="true"
frameborder="0" allowpaymentrequest="true"
src="<%=pipe.getWebAddress()%>"></iframe>';
```

©2024 API Guide Page 60 of 313

```
document.body.appendChild(division);
```
```
}
```
```
else
```
```
{
```
```
var division=document.createElement("div");
```
```
division.setAttribute("id", "payframe");
```
```
division.setAttribute("style", "min-height: 100%;
transition: all 0.3s ease-out 0s; position: fixed; top: 0px; left: 0px;
width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); padding-right:
10px; padding-left: 250px;padding-top: 0px;");
```
```
division.innerHTML ='<div style="position: absolute;right:
0px;top: 0px;cursor: pointer;font-size: 24px;opacity: .6;width:
24px;text-align: center;line-height: 0px;z-index: 1;" class="close"
id="F" onclick="javascript:
window.parent.document.getElementById(\'iframe\').parentNode.removeChil
d(window.parent.document.getElementById(\'iframe\'));window.parent.docu
ment.getElementById(\'payframe\').parentNode.removeChild(window.parent.
document.getElementById(\'payframe\'));">x</div><iframe id="iframe"
style="opacity: 7; height: 100%; position: relative; background: none;
display: block; border: 0px none transparent; margin-left: 7%; padding:
0px; z-index: 2; width: 65%; margin-top: 0%" allowtransparency="true"
frameborder="0" allowpaymentrequest="true"
src="<%=pipe.getWebAddress()%>"></iframe>';
```
```
document.body.appendChild(division);
```
```
}
```
```
</script>
```
```
}
```
```
else
```
```
{
```
```
response.sendRedirect(pipe.getWebAddress());
```
```
}
```

©2024 API Guide Page 61 of 313

### Final Response – Transaction Status

```
Attribute - Final URL redirection response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique payment Id generated by PG and
merchant can use this ID to match the
response from PG
```
```
2 trandata C Alphanum All the below response parameters
encrypted and send the encrypted value
in trandata
```
```
3 error C Alphanum If any error, PG will send the error code
```
```
4 errorText C Alphanum If any error, PG will send the error
description
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by payment
gateway. Based on this payment Id
merchant can match the final URL
redirection response
```
```
2 result M Alphanum Transaction status. Value will be
'CAPTURED' for purchase successful
and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 fcCustId M Numeric
```
```
Unique Customer ID generated on
faster checkout registration.
```
```
5 transId M Numeric Unique transaction Id generated by
Payment gateway and merchant can
use this id for initiating supported
transactions (Void, refund and
inquiry)
```
```
6 date M Numeric Transaction date and time
```
```
7 trackId M Numeric Merchant unique reference no
```

©2024 API Guide Page 62 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf1 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
9 udf2 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
10 udf3 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
11 udf 4 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
12 udf5 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
13 amt M Numeric Transaction amount
```
```
14 authRespCode M Numeric Auth response code provided by PG
```
```
15 authCode M Numeric 6 digit authorization code received
from switch
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
```

©2024 API Guide Page 63 of 313

```
S. No Fields M/C/O Field Type Description
```
```
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
17 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
If Merchant notification is disabled, then ARB Payment gateway will provide the final
response in URL redirection. Below is the sample response from ARB PG to merchant
```
```
[{
```
```
//Redirection Parameters
```
```
“paymentId”:” 100201935166676976 ”,
```
```
“trandata”:”<encrypted trandata>”,
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:”100201935166676976”,
```

©2024 API Guide Page 64 of 313

```
”result”:”CAPTURED”,
```
```
”transId”:”201935166561122”,
```
```
"fcCustId":"201936122890007",
```
```
”ref”:”935110000001”,
```
```
”date”:”1217”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" // 2 – 4 Digits
```
```
}]
```

©2024 API Guide Page 65 of 313

## MERCHANT HOSTED TRANSACTION (3D SECURE)

## MERCHANT HOSTED TRANSACTION (3D SECURE)

The merchant will collect the customer’s card details on their own website hence, the customer

will not be redirected to the ARB payment gateway payment page, as the payment option and

card details are already received by merchant. The card details are later posted to ARB

payment gateway.


©2024 API Guide Page 66 of 313

This section illustrates how you can integrate the merchant hosted flow on your website

application.

1. User visits the merchant application and creates order.
2. User enters the payment details.
3. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token.
4. ARB Payment gateway internally validates the request.

```
 In case of successful validation, ARB PG provides Payment ID and Payment
Processing Page URL in the response.
```
- Merchant needs to frame the payment processing page URL with Payment ID,
    Hence the ARB payment processing page is displayed.
 In case of failure, ARB PG provides **Error Code** and **Description**.
5. Upon authorization, the customer redirects to ARB Payment gateway.

```
The flow takes the user to the login ACS page of the bank, where the user needs to
complete the transaction by using the OTP sent by the bank to the registered mobile
number. PG then process for authorization with the respective schemes. Once payment
response received from respective scheme, then ARB Payment gateway returns the
response to merchant. This is URL redirection.
```
6. After authorization, the ARB PG application process the transaction and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
7. Merchant server calls the transaction status API to verify the transaction response.
8. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 67 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
3
```
```
responseUR
L
```
```
M Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanum Tranportal password. Merchant
download the same in merchant portal.
```
```
4 id M Alphanum Tranportal ID. Merchant download the
same in merchant portal
```
```
5 currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
```

©2024 API Guide Page 68 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
```
```
9 udf4 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
```
```
10 udf3 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
```
```
11 udf5 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
12 response
URL
```
```
M Alphanum The merchant success URL where
Payment Gateway send the notification
request.
```
```
13 errorURL M Alphanum The merchant error URL where Payment
Gateway send the response in case any
error while Processing the transaction.
```
```
14 expYear M Numeric Expiry year of card
```
```
15 expMonth M Numeric Expiry month of card
```
```
16 member M Alphanum Card holder name
```
```
17 cvv2 M Numeric CVV of the card
```
```
18 cardNo M Numeric Cardholders card number
```
```
19 cardType M Alphanum Card type Ex : Credit card – C, Debit Card –
D
```

©2024 API Guide Page 69 of 313

```
S. No Fields M/C/O Field Type Description
```
```
20 browserLa
nguage
```
M (^) Alphanum Value representing the browser language
Returned from "navigator.language"
property. Length 1 to 8 characters.
21 browserCol
orDepth
M (^) Alphanum Value representing the bit depth of the colour
palette for displaying images, in bits per
pixel. Obtained from Cardholder browser
using the "screen.colorDepth" property.
Length 1 to 2 characters.
Values Accepted :
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits
22 browserScr
eenHeight
M (^) Alphanum Total height of the Cardholder’s screen in
pixels. Value is returned from the
screen.height property. Length 1 to 6
characters.
23 browserScr
eenWidth
M (^) Alphanum Total width of the cardholder’s screen in
pixels. Value is returned from the
screen.width property. Length 1 to 6
characters.
24 browserJav
aEnabled
M (^) Alphanum Value is returned from the
navigator.javaEnabled property. Boolean
value.
25 browserTZ M (^) Alphanum Time difference between UTC time and the
Cardholder browser local time, in minutes.
Value is returned from the
getTimezoneOffset() method. Length 1 to 5
characters.
26 jsEnabled M (^) Alphanum Value whether the java script is enabled in
browser or not.
**Sample JSON request - Request from Merchant to ARB PG**
[{


©2024 API Guide Page 70 of 313

```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```

©2024 API Guide Page 71 of 313

```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```
```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```
```
"jsEnabled":"true",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
}]
```
#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C JSON
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```

©2024 API Guide Page 72 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
3 iBanNum C
```
```
Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
##### 5

```
serviceAmoun
t C^ Numeric^ Service Amount^
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```
```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE' 'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount^ C Numeric billAmount^
```

©2024 API Guide Page 73 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
4 billType^ C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in
advance - POSTPAID : Paid at the end
```
```
5 billNumber^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline C JSON Object Conditional - for Airline Merchant
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number
```
```
1.1.1 itinerary^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1.1.1 leg^ C JSON Array Conditional -^ for Airline Merchant^
```
```
1.1.1.1.1 carrierCode C Alphanum The carrier code for the leg
```
```
1.1.1.1.2 departureAirport C Alphanum The departure airport for the passenger
```

©2024 API Guide Page 74 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ {
"carrierCode": "MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11",
"departureTime": "06:50:00Z", "destinationAirport": "KUL",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "10:35:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0805", "travelClass": "B" }, {
"carrierCode": "UL", "departureAirport": "KUL", "departureDate": "2021- 05 - 11",
"departureTime": "15:00:00Z", "destinationAirport": "CMB",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "16:05:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName":
"KAI MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
```
```
1.1.1.1.3 departureDate^ C Alphanum The departure date for the leg^
1.1.1.1.4 departureTime^ C Alphanum The departure airport for the passenger^
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg^
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg
```
```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg^
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1.9 flightNumber^ C Alphanum The flight number for the leg^
1.1.1.1.10 travelClass C Alphanum The class of service for the leg
1.1.1.2 numberInParty C Alphanum
1.1.1.3 originCountry^ C Alphanum The origin Country of the itinerary^
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName^ C Alphanum The passenger first^ name^
1.1.2.2 lastName C Alphanum The passenger last name
1.1.3 ticket C JSON Object Conditional - for airline merchant
1.1.3.1 issue^ C JSON Object Conditional -^ for airline merchant^
1.1.3.1.1 carrierCode^ C Alphanum Code of the airline that issuing the ticket^
1.1.3.1.2 carrierName C Alphanum Name of the airline that is issuing the ticket.
1.1.3.1.3 travelAgentCode C Alphanum Code of the Travel Agent that issuing the ticket
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the
ticket
1.1.3.2 totalFare^ C Numeric Ticket Total Fare^
1.1.3.3 totalFees^ C Numeric Total fee for the ticket.^
1.1.3.4 totalTaxes C Numeric Tax portion of the order amount.
```

©2024 API Guide Page 75 of 313

```
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees":
"59518.00", "totalTaxes": "4600.00" } } }
```
##### }]


©2024 API Guide Page 76 of 313

### Initial Response - Payment ID and Payment Processing Page URL

```
Attributes - Initial Response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then
status will be ‘1’. If the validation failed,
then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if
the validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway
will provide the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway
will provide the respective error description
```
```
Sample JSON Response - Initial Response from ARB PG to Merchant
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response in case of successful validation, if failure then error code and
description will be provided.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"700212030953264091:https://securepayments.alrajhibank.com.sa/p
g/TranportalVbv.htm?paymentId=700212030953264091&id=r9Ht8R4U6g9dYtY",
//Payment ID:Payment URL
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```

©2024 API Guide Page 77 of 313

**Failure:**

```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

After Initial Response from ARB PG, merchant needs to frame the payment page URL like the

below sample.

https://securepayments.alrajhibank.com.sa/pg/TranportalVbv.htm?paymentId=700112030

953264091&id=r9Ht8R4U6g9dYtYg


©2024 API Guide Page 78 of 313

### Final Response – Transaction Status

```
Merchant needs to redirects the customer to ARB Payment gateway.
```
```
The flow takes the user to the login ACS page of the bank, where the user needs to
complete the transaction by using the OTP sent by the bank to the registered mobile
number. PG then process for authorization with the respective schemes. Once payment
response received from respective scheme, then ARB Payment gateway returns the
response to merchant. This is URL redirection.
```
```
Attribute - Final URL redirection response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by Payment gateway.
Merchant can store the payment ID to match
the final URL redirection response
```
```
2 trandata C Alphanum All the below response parameters
encrypted and send the encrypted value in
trandata
Ex:
[{“paymentId”:1002019351666769
76,”result”:”CAPTURED”,”ref”:”
935110000001”,”transId”:201935
166561122,”date”:1217,”trackId
”:”1003383844”,”udf1”:””,”udf2
”:””,”udf3”:”8870091137”,”udf4
”:”FC”,”udf5”:”Tidal5”,”amt”:”
70.0,”authRespCode”,”00”}]
```
```
3 Error C Numeric If any error, PG will provide the error code
```
```
4 ErrorText C Alphanum PG will provide the error description if any
transaction declined.
```

©2024 API Guide Page 79 of 313

```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment
gateway. Based on this payment
Id merchant can match the final
URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status. Value will be
'CAPTURED' for purchase
successful and 'APPROVED' for
authorization successful.
```
```
3 ref M Numeric Transaction reference number
(RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated
by Payment gateway and
merchant can use this id for
initiating supported transactions
(Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines
these fields. The field data is
passed along with a transaction
request and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines
these fields. The field data is
passed along with a transaction
request and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines
these fields. The field data is
passed along with a transaction
request and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```

©2024 API Guide Page 80 of 313

```
S. No Fields M/C/O Field Type Description
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines
these fields. The field data is
passed along with a transaction
request and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines
these fields. The field data is
passed along with a transaction
request and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by
PG
```
```
14 authCode M Numeric
```
```
6 digit authorization code
received from switch
```
```
15 cardType M Alphabetic
```
```
Card Brand name. Value will be
"Visa" or "MasterCard" or
"Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction.
Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization
Extension(MADA)
```
```
17 card C AlPhanume
ric
```
```
Card Number used for
Performing Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```

©2024 API Guide Page 81 of 313

```
Sample JSON Response - Final
```
```
If Merchant notification is disabled, then ARB Payment gateway will provide the final
response in URL redirection. Below is the sample response from ARB PG to merchant
```
```
[{
```
```
“paymentId”:”100201935044735860”,
```
```
"trandata": "<encrypted trandata>",
```
```
“Error”:””,
```
```
“ErrorText”:””
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:” 100201935166676976 ”,
```
```
”result”: ”CAPTURED”,
```
```
”transId”:201935166561122,
```
```
”ref”:”935110000001”,
```
```
”date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```

©2024 API Guide Page 82 of 313

```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
##### }]


©2024 API Guide Page 83 of 313

## MERCHANT HOSTED TRANSACTION (NON 3D SECURE)

## MERCHANT HOSTED TRANSACTION (NON 3D SECURE)

This section illustrates how you can integrate the merchant hosted flow (Non 3D Secure) on

your website application.


©2024 API Guide Page 84 of 313

1. User visits the merchant application and creates order.
2. User enters the payment details.
3. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token and to process payment via Alrajhi Payment gateway
4. After authorization, the ARB PG application process the transaction and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
5. Merchant server calls the transaction status API to verify the transaction response.
6. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 85 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanum Tranportal password. Merchant download
the same in merchant portal.
```
```
4 id M Alphanum Tranportal ID. Merchant download the same
in merchant portal
```
```
5 currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
8 udf2 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
9 udf3 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
```

©2024 API Guide Page 86 of 313

```
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
(^10) udf4 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
11 udf5 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
12 expYear M Numeric Expiry year of card
13 expMonth M Numeric Expiry month of card
14 member M Alphanum Card holder name
15 cvv2 M Numeric CVV of the card
16 cardNo M Numeric Cardholders card number
17 cardType M Alphanum Card type Ex : Credit card – C, Debit Card -
D
**Sample JSON request - Request from Merchant to ARB PG**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”
}]
**Plain Trandata:**
[{


©2024 API Guide Page 87 of 313

```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
}]
```

©2024 API Guide Page 88 of 313

#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C
```
```
Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
```
5 serviceAmoun
t
```
```
C Numeric Service Amount
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 89 of 313

#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }

```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE' 'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount^ C Numeric billAmount^
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in
advance - POSTPAID : Paid at the end
```
```
5 billNumber C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber^ C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 90 of 313

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline C JSON Object Conditional - for Airline Merchant
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number
```
```
1.1.1 itinerary^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1.1.1 leg^ C JSON Array Conditional -^ for Airline Merchant^
```
```
1.1.1.1.1 carrierCode C Alphanum The carrier code for the leg
```
```
1.1.1.1.2 departureAirport C Alphanum The departure airport for the passenger
1.1.1.1.3 departureDate^ C Alphanum The departure date for the leg^
1.1.1.1.4 departureTime^ C Alphanum The departure airport for the passenger^
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg^
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg
```
```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1.9 flightNumber^ C Alphanum The flight number for the leg^
1.1.1.1.10 travelClass C Alphanum The class of service for the leg
1.1.1.2 numberInParty C Alphanum
1.1.1.3 originCountry C Alphanum The origin Country of the itinerary
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName^ C Alphanum The passenger first^ name^
1.1.2.2 lastName C Alphanum The passenger last name
1.1.3 ticket C JSON Object Conditional - for airline merchant
1.1.3.1 issue C JSON Object Conditional - for airline merchant
1.1.3.1.1 carrierCode^ C Alphanum Code of the airline that^ issuing the ticket^
1.1.3.1.2 carrierName^ C Alphanum Name of the airline that is issuing the ticket.^
1.1.3.1.3 travelAgentCode C Alphanum Code of the Travel Agent that issuing the ticket
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the
ticket
1.1.3.2 totalFare^ C Numeric Ticket Total Fare^
```

©2024 API Guide Page 91 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ {
"carrierCode": "MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11",
"departureTime": "06:50:00Z", "destinationAirport": "KUL",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "10:35:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0805", "travelClass": "B" }, {
"carrierCode": "UL", "departureAirport": "KUL", "departureDate": "2021- 05 - 11",
"departureTime": "15:00:00Z", "destinationAirport": "CMB",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "16:05:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName":
"KAI MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees":
"59518.00", "totalTaxes": "4600.00" } } }
```
##### }]

```
1.1.3.3 totalFees^ C Numeric Total fee for the ticket.^
1.1.3.4 totalTaxes^ C Numeric Tax portion of the order amount.^
```

©2024 API Guide Page 92 of 313

### Final Response – Transaction Status

```
The ARB payment gateway verifies the transaction and returns the response to the same
request.
```
```
Attribute - Final response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata M AlphaNum All the below response parameters will be
provided in trandata field
```
```
2 error C Alphanum If any error during processing, PG will
provide the error code
```
```
3 errorText C Alphanum If any error during processing, PG will
provide the error description
```
```
4 status M Alphanum If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway.
Based on this payment Id merchant can
match the final URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status. Value will be
'CAPTURED' for purchase successful and
'APPROVED' for authorization successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by
Payment gateway and merchant can use
this id for initiating supported transactions
(Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```

©2024 API Guide Page 93 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
11 udf5^ O^ Alphanum^
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by PG
```
```
14 authCode M Numeric
```
```
6 digit authorization code received from
switch
```
```
15 cardType M Alphabetic
```
```
Card Brand name. Value will be "Visa" or
"MasterCard" or "Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```

©2024 API Guide Page 94 of 313

```
S. No Fields M/C/O Field Type Description
```
```
17 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
The ARB payment gateway verifies the transaction and returns the response to the same
request.
```
```
[{
```
```
“tranid”: “201931951332346”,
```
```
"trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:-1,
```
```
”result”:”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:”1221”,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```

©2024 API Guide Page 95 of 313

```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:”1242345345234”,
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”
```
##### }]


©2024 API Guide Page 96 of 313

## MERCHANT HOSTED CARD ON FILE TRANSACTIONS (3D SECURE)

## MERCHANT HOSTED CARD ON FILE TRANSACTIONS (3D SECURE)


©2024 API Guide Page 97 of 313

1. User visits the merchant application and creates order.
2. User enters the payment card details.
3. The card details are saved as token with the merchant as well the card registration
    information is later posted to PG.
4. The Merchant application backend server calls **Payment Token Generation API** to
    get the transaction token.
5. ARB Payment gateway internally validates the request.

```
 In case of successful validation, ARB PG provides Payment ID and Payment
Processing Page URL in the response.
```
- Merchant needs to frame the payment processing page URL with Payment ID,
    Hence the ARB payment processing page is displayed.
 In case of failure, ARB PG provides **Error Code** and **Description**.
6. Upon authorization, the customer redirects to ARB Payment gateway.

```
The flow takes the user to the login ACS page of the bank, where the user needs to
complete the transaction by using the OTP sent by the bank to the registered mobile
number. PG then process for authorization with the respective schemes. Once payment
response received from respective scheme, then ARB Payment gateway returns the
response to merchant. This is URL redirection.
```
7. After authorization, the ARB PG application process the transaction and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
8. Merchant server calls the transaction status API to verify the transaction response.
9. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 98 of 313

### Saving Cards During Transaction (Card Registration)

When the merchant hosted transaction is in progress, the sensitive card information entered

by the customer is saved as token in the PCI compliant merchant’s database as well the

information is later posted to PG. The next time the customer makes any transactions, the

customer can pay directly by entering the CVV of the card and OTP received.

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the Tranportal
id from Merchant portal
```
```
2 trandata M Alphanum All the below request parameters encrypted and pass
the encrypted value in trandata.
3 responseURL M Alphanum The merchant success URL where Payment Gateway
send the notification request.
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain trandata request parameters
```
```
S.No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
3 password M Alphanum Tranportal password. Merchant download the same in
merchant portal.
4 id M Alphanum Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
8 udf2 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
```

©2024 API Guide Page 99 of 313

```
S.No Fields M/C/O Field Type Description
```
```
9 udf3 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
10 udf5 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
11 responseURL M Alphanum The merchant success URL where Payment Gateway
send the notification request.
```
```
12 errorURL M Alphanum The merchant error URL where Payment Gateway send
the response in case any error while Processing the
transaction.
13 expYear M Numeric Expiry year of card
```
```
14 expMonth M Numeric Expiry month of card
```
```
15 member M Alphanum Card holder name
```
```
16 cvv2 M Numeric CVV of the card
```
```
17 cardNo M Numeric Cardholders card number
```
```
18 cardType M Alphanum Card type Ex : Credit card – C, Debit Card – D
```
```
19 cardOnFileAct
ion
```
```
M Alphanum
```
```
Card on File action .Mandatory field for Card On File.
Value should be "transaction" for Card On File
transactions.
```
##### 20

```
cardOnFileTok
en C^ Numeric^
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves
the first card. Merchant needs to send this field only
for saving subsequent cards for the customer and for
transaction using saved cards.
```
```
21 browserLangu
age
```
M (^) Alphanu
m
Value representing the browser language Returned
from "navigator.language" property. Length 1 to 8
characters.
22 browserColor
Depth
M (^) Alphanu
m
Value representing the bit depth of the colour palette for
displaying images, in bits per pixel. Obtained from
Cardholder browser using the "screen.colorDepth"
property. Length 1 to 2 characters.
Values Accepted :


©2024 API Guide Page 100 of 313

```
S.No Fields M/C/O Field Type Description
```
```
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits
```
```
23 browserScree
nHeight
```
M (^) Alphanu
m
Total height of the Cardholder’s screen in pixels. Value
is returned from the screen.height property. Length 1 to
6 characters.
24 browserScree
nWidth
M (^) Alphanu
m
Total width of the cardholder’s screen in pixels. Value is
returned from the screen.width property. Length 1 to 6
characters.
25 browserJavaE
nabled
M (^) Alphanu
m
Value is returned from the navigator.javaEnabled
property. Boolean value.
26 browserTZ M (^) Alphanu
m
Time difference between UTC time and the Cardholder
browser local time, in minutes. Value is returned from
the getTimezoneOffset() method. Length 1 to 5
characters.
27 jsEnabled M (^) Alphanu
m
Value whether the java script is enabled in browser or
not.
**Request from Merchant to ARB Payment gateway:**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”,
"responseURL":"https://merchantpage/PaymentResult.jsp",
"errorURL":"https://merchantpage/PaymentResult.jsp"
}]
**Plain Trandata**


©2024 API Guide Page 101 of 313

```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
"cardOnFileAction":"transaction",
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```
```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```

©2024 API Guide Page 102 of 313

```
"jsEnabled":"true",
```
```
//Conditional - To be excluded when a customer saves first card. Required
for saving subsequent cards for a customer.
```
```
"cardOnFileToken":" 201936122890007 ",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”
```
```
}]
```

©2024 API Guide Page 103 of 313

### Request - Payment Token Generation API

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanum All the below request parameters encrypted and pass
the encrypted value in trandata.
3 responseURL M Alphanum The merchant success URL where Payment Gateway
send the notification request.
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain trandata request parameters
```
```
S.No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
3 password M Alphanum Tranportal password. Merchant download the same in
merchant portal.
4 id M Alphanum Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
8 udf2 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
9 udf3 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field left blank when no data needs to be
passed.
```

©2024 API Guide Page 104 of 313

```
S.No Fields M/C/O Field Type Description
```
```
10 udf5 O Alphanum The user (merchant) defines these fields. The field data
passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
11 responseURL M Alphanum The merchant success URL where Payment Gateway
send the notification request.
```
```
12 errorURL M Alphanum The merchant error URL where Payment Gateway send
the response in case any error while Processing the
transaction.
13 member M Alphanum Card holder name
```
```
14 cvv2 M Numeric CVV of the card
```
```
15 cardType M Alphanum Card type Ex : Credit card – C, Debit Card – D
```
##### 16

```
cardOnFileAct
ion M^ Alphanum^
```
```
Card on File action .Mandatory field for Card On File.
Value should be "transaction" for Card On File
transactions
```
##### 17

```
cardOnFileTok
en M^ Numeric^
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves
the first card.
```
##### 18

```
maskedCardN
o M^ Alphanum^
```
```
Masked card number for card on file. First 6 and last 4
digits visible.
```
```
19 browserLangu
age
```
M (^) Alphanu
m
Value representing the browser language Returned
from "navigator.language" property. Length 1 to 8
characters.
20 browserColor
Depth
M (^) Alphanu
m
Value representing the bit depth of the colour palette for
displaying images, in bits per pixel. Obtained from
Cardholder browser using the "screen.colorDepth"
property. Length 1 to 2 characters.
Values Accepted :
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits


©2024 API Guide Page 105 of 313

```
S.No Fields M/C/O Field Type Description
```
```
21 browserScree
nHeight
```
M (^) Alphanu
m
Total height of the Cardholder’s screen in pixels. Value
is returned from the screen.height property. Length 1 to
6 characters.
22 browserScree
nWidth
M (^) Alphanu
m
Total width of the cardholder’s screen in pixels. Value is
returned from the screen.width property. Length 1 to 6
characters.
23 browserJavaE
nabled
M (^) Alphanu
m
Value is returned from the navigator.javaEnabled
property. Boolean value.
24 browserTZ M (^) Alphanu
m
Time difference between UTC time and the Cardholder
browser local time, in minutes. Value is returned from
the getTimezoneOffset() method. Length 1 to 5
characters.
25 jsEnabled M (^) Alphanu
m
Value whether the java script is enabled in browser or
not.
**Request from Merchant to ARB Payment gateway:**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”,
"responseURL":"https://merchantpage/PaymentResult.jsp",
"errorURL":"https://merchantpage/PaymentResult.jsp"
}]
**Plain Trandata**
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value **PGKEYENCDECIVSPC** under Resource key.
[{ //Mandatory Parameters
“amt”:”12.00”,


©2024 API Guide Page 106 of 313

```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardType”:”C”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
"cardOnFileAction":"transaction",
```
```
"cardOnFileToken":" 201936122890007 ",
```
```
"maskedCardNo":"545301******5539",
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```
```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```
```
"jsEnabled":"true",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```

©2024 API Guide Page 107 of 313

```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”
```
```
}]
```

©2024 API Guide Page 108 of 313

### Initial Response - Payment ID and Payment Page URL

```
Initial Response from PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then status will be ‘1’.
If the validation failed, then status will be ‘2’
```
```
2 result C Alphanu
m
```
```
It contains payment ID and Payment URL if the
validation success else this will be null
3 error C Alphanu
m
```
```
If validation failed, then Payment gateway will provide
the respective error code
4 errorText C Alphanu
m
```
```
If validation failed, then Payment gateway will provide
the respective error description
```
```
Plain Response:
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response if the validation success. If failure then, Error code and
description will be provided.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":" 700212030953264091 :https://securepayments.alrajhibank.com.sa/pg/
TranportalVbv.htm?paymentId=700212030953264091&id=r9Ht8R4U6g9dYtY",
//Payment ID:Payment URL
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```

©2024 API Guide Page 109 of 313

```
“errorText”:” Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

Merchant needs to frame the URL like the below sample

https://securepayments.alrajhibank.com.sa/pg/TranportalVbv.htm?paymentId=700112030

953264091&id=r9Ht8R4U6g9dYtYg


©2024 API Guide Page 110 of 313

### Final Response – Transaction Status

Merchant needs to redirects the customer to ARB Payment gateway.

Customer browser will redirect to ACS page and will complete the authentication. PG then process for
authorization with the respective schemes. Once payment response received from respective scheme,

then ARB Payment gateway returns the response to merchant. This is URL redirection. Below is sample
response from ARB PG to merchant,

```
Final Response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by Payment gateway. Merchant can
store the payment ID to match the final URL redirection
response
2 trandata C Alphanu
m
```
```
All the response parameters encrypted and sent in
encrypted value in trandata
3 Error C Numeric If any error, PG will provide the error code
4 ErrorText C Alphanu
m
```
```
PG will provide the error description if any transaction
declined.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway. Based on this
payment Id merchant can match the final URL
redirection response
```
```
2 result M Alphanu
m
```
```
Transaction status. Value will be 'CAPTURED' for
purchase successful and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment gateway
and merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 111 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 amt M Numeric Transaction amount
```
```
12 authRespCod
e
```
```
M Numeric Auth response code provided by PG
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 cardType M Alphabet
ic
```
```
Card Brand name. Value will be "Visa" or "MasterCard"
or "Mada".
```
##### 15

```
cardOnFileTok
en M^ Numeric^
```
```
Unique token ID (customer ID) generated by PG per
customer when customer saves the first card. This
should be sent in merchant request when the customer
saves the subsequent cards next time.
```
```
16
```
```
maskedCardN
o M^
```
```
AlphaNu
m
```
```
Masked card number for card on file transactions. First
6 digits and last 4 digits will be visible.
17 actionCode M Alphanu
meric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
18 card C AlPhanu
meric
```
```
Card Number used for Performing Transaction
```
```
19 expMonth C AlPhanu
meric
```
```
Expiry Month of the Card
```
```
20 expYear C AlPhanu
meric
```
```
Expiry Year of the Card
```

©2024 API Guide Page 112 of 313

```
Sample JSON Response - Final
```
```
Redirection Parameters
```
```
[{
```
```
“paymentId”:” 100201935044735860 ”,
```
```
"trandata": "<encrypted trandata>",
```
```
“Error”:””,
```
```
“ErrorText”:””
```
```
}]
```
```
Plain Trandata
```
```
[{“paymentId”:” 100201935044735860 ”,
```
```
”result”: ”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:1221,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ",
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```

©2024 API Guide Page 113 of 313

```
"cardType":"Visa",
```
```
"cardOnFileToken":" 201936122890007 ",
```
```
"maskedCardNo":"545301******5539"
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
```
}]
```

©2024 API Guide Page 114 of 313

## MERCHANT HOSTED CARD ON FILE TRANSACTIONS (NON-3D SECURE)

## MERCHANT HOSTED CARD ON FILE TRANSACTIONS (NON-3D SECURE)

1. User visits the merchant application and creates order.
2. User enters the payment card details.
3. The card details are saved as card registration token and posted to PG.
4. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token and to process payment via Alrajhi Payment gateway
5. After authorization, the ARB PG application process the transaction and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
6. Merchant server calls the transaction status API to verify the transaction response.
7. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 115 of 313

### Saving Cards During Transaction (Card Registration)

When the merchant hosted transaction is in progress, the sensitive card information entered

by the customer is saved as token in the PCI compliant merchant’s database as well the

information is later posted to PG. The next time the customer makes any transactions, the

customer can pay directly by entering the CVV of the card.

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in merchant
portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 116 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 expYear M Numeric Expiry year of card
```
```
12 expMonth M Numeric Expiry month of card
```
```
13 member M Alphanu
m
```
```
Card holder name
```
```
14 cvv2 M Numeric CVV of the card
```
```
15 cardNo M Numeric Cardholders card number
```
```
16 cardType M Alphanu
m
```
```
Card type Ex : Credit card – C, Debit Card - D
```
```
17 cardOnFileAct
ion
```
```
M Alphanu
m
```
```
Card on File action .Mandatory field for Card On File.
Value should be "transaction" for Card On File
transactions
```
```
18 cardOnFileTok
en
```
```
C Numeric
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves the
first card. Merchant needs to send this field only for
saving subsequent cards for the customer and for
transaction using saved cards.
```
```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```

©2024 API Guide Page 117 of 313

```
Below are the plain Trandata request
```
##### [{

```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C",
```
```
"cardOnFileAction":"transaction",
```
```
//Conditional - To be excluded for saving first card for a customer.
Required for saving subsequent cards for the customer.
```
```
"cardOnFileToken":"201936122890007",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”
```
```
}]
```

©2024 API Guide Page 118 of 313

### Request - Payment Token Generation API

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf 2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 119 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 member M Alphanu
m
```
```
Card holder name
```
```
12 cvv2 M Numeric CVV of the card
```
```
13 cardType M Alphanu
m
```
```
Card type Ex : Credit card – C, Debit Card - D
```
```
14 cardOnFileAct
ion
```
```
M Alphanu
m
```
```
Card on File action .Mandatory field for Card On File.
Value should be "transaction" for Card On File
transactions
```
##### 15

```
cardOnFileTok
en M^ Numeric^
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves
the first card.
```
```
16 maskedCardN
o
```
```
M Alphanu
m
```
```
Masked card number for card on file. First 6 and last 4
digits visible.
```
```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
```
Below are the plain Trandata request
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```

©2024 API Guide Page 120 of 313

```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardType”:”C",
```
```
"cardOnFileAction":"transaction",
```
```
"cardOnFileToken":"201936122890007",
```
```
"maskedCardNo":"545301******5539",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”
```
```
}]
```

©2024 API Guide Page 121 of 313

### Final Response – Transaction Status

Once ARB payment gateway verifies the transaction and returns the response to the same request.

```
Response from ARB Payment Gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata M AlphaNu
m
```
```
All the response parameters will be provided in trandata
field
```
```
2 error C Alphanu
m
```
```
If any error during processing, PG will provide the error
code
```
```
3 errorText C Alphanu
m
```
```
If any error during processing, PG will provide the error
description
```
```
4 status M Alphanu
m
```
```
If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway. Based on this
payment Id merchant can match the final URL
redirection response
```
```
2 result M Alphanu
m
```
```
Transaction status. Value will be 'CAPTURED' for
purchase successful and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment gateway
and merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 122 of 313

```
S. No Fields M/C/O Field Type Description
```
```
9 udf3 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanum
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 amt M Numeric Transaction amount
```
##### 12

```
authRespCod
e M^ Numeric^ Auth response code provided by PG^
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 cardType M Alphabet
ic
```
```
Card Brand name. Value will be "Visa" or "MasterCard"
or "Mada".
```
##### 15

```
cardOnFileTok
en M^ Numeric^
```
```
Unique token ID (customer ID) generated by PG per
customer when customer saves the first card. This
should be sent in merchant request when the customer
saves the subsequent cards next time.
```
```
16
```
```
maskedCardN
o M^
```
```
AlphaNu
m
```
```
Masked card number for card on file transactions. First
6 digits and last 4 digits will be visible.
17 actionCode M Alphanu
meric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
18 card C AlPhanu
meric
```
```
Card Number used for Performing Transaction
```
```
19 expMonth C AlPhanu
meric
```
```
Expiry Month of the Card
```
```
20 expYear C AlPhanu
meric
```
```
Expiry Year of the Card
```
```
Below is the sample encrypted response from PG to Merchant
```
```
[{
```

©2024 API Guide Page 123 of 313

```
“tranid”: “ 201931951332346 ”,
```
```
"trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Plain trandata in response
```
```
[{
```
```
“paymentId”:-1,
```
```
”result”:”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:” 1221 ”,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ”,
```
```
“authRespCode”:”00”,
```

©2024 API Guide Page 124 of 313

```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
"cardOnFileToken":" 201936122890007 ",
```
```
"maskedCardNo":"545301******5539"
```
```
“actionCode”:”1”
```
```
}]
```

©2024 API Guide Page 125 of 313

## MERCHANT HOSTED CARD ON FILE REGISTRATIONS (WITHOUT TRANSACTION)

## MERCHANT HOSTED CARD ON FILE REGISTRATIONS (WITHOUT TRANSACTION)

1. User visits the merchant application and click card registration option.
2. Merchant application backend server calls **Card Registration Token Generation API**
    to get the token and to register the card details in Alrajhi Payment gateway
3. After authorization, the ARB PG application saves the card details and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
4. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 126 of 313

### Request – Card Registration Token Generation API

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
2 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
3 expYear M Numeric Expiry year of card
```
```
4 expMonth M Numeric Expiry month of card
```
```
5 cardNo M Numeric Cardholders card number
```
```
6 cardOnFileAct
ion
```
```
M Alphanu
m
```
```
Card on File action. Value should be "registration" for
registration without transaction.
```
```
7 cardOnFileTok
en
```
```
C Numeric
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves
the first card. Merchant needs to send this field only
for saving subsequent cards for the customer.
```

©2024 API Guide Page 127 of 313

```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
```
Below are the plain Trandata request
```
```
[{
```
```
//Mandatory Parameters
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”cardNo”,”5453********5539”,
```
```
"cardOnFileAction":"registration",
```
```
//conditional Parameter - To be excluded for saving first card for a
customer. Required for saving subsequent cards for the customer.
```
```
"cardOnFileToken":"201936122890007"
```
```
}]
```

©2024 API Guide Page 128 of 313

### Response – Card Registration Status

```
Response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata C Alphanu
m
```
```
All the below response parameters encrypted and send
the encrypted value in trandata
2 error C Numeric If any error, PG will provide the error code
3 errorText C Alphanu
m
```
```
PG will provide the error description if registration fails.
```
```
4 status M Numeric 1 for registration success case, 2 for failure case
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 cardOnFileTok
en
```
```
M Numeric
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer when customer saves
the first card.
```
```
2
```
```
maskedCardN
o M^
```
```
AlphaNu
m Masked card number for card on file.^
```
**Below is the sample encrypted response from PG to Merchant**

```
[{ "trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for registration success case, 2 for failure case
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```
**Plain Trandata for PG response to Merchant**

```
[{
```
```
"cardOnFileToken":" 201936122890007 ",
```
```
"maskedCardNo":"545301******5539"
```
```
}]
```

©2024 API Guide Page 129 of 313

## MERCHANT HOSTED CARD ON FILE DEREGISTRATION

## MERCHANT HOSTED CARD ON FILE DEREGISTRATION

1. User visits the merchant application and click card deregistration option.
2. Merchant application backend server calls **Card Deregistration Token Generation**
    **API** to get the token and to deregister the card details in Alrajhi Payment gateway
3. After authorization, the ARB PG application deletes the card details and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
4. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 130 of 313

### Request – Card Deregistration Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
2 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
3 cardOnFileAct
ion
```
```
M Alphanu
m
```
```
Card on File action. Value should be "deregistration"
for deregistration of Card on File.
```
##### 4

```
cardOnFileTok
en M^ Numeric^
```
```
Card on File Token. Unique token ID (customer ID)
generated by PG per customer.
```
```
5 maskedCardN
o
```
```
M Alphanu
m
```
```
Card on File masked card number. First 6 digits and
last 4 digits to be visible.
```
```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```

©2024 API Guide Page 131 of 313

```
Below are the plain Trandata request
```
```
[{
```
```
//Mandatory Parameters
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
"cardOnFileAction":"deregistration",
```
```
"cardOnFileToken":"201936122890007",
```
```
"maskedCardNo":"545301******5539"
```
```
}]
```

©2024 API Guide Page 132 of 313

### Response – Card Deregistration Status

```
Response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 error C Numeric If any error, PG will provide the error code
```
```
2 errorText C Alphanu
m
```
```
PG will provide the error description if deregistration
fails.
3 status M Numeric 1 for deregistration success case, 2 for failure case
```
```
Below is the sample response from PG to Merchant
```
```
[{
```
```
“status”:”1”, //1 for deregistration success case, 2 for failure case
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```

©2024 API Guide Page 133 of 313

## MERCHANT HOSTED TRANSACTION FLOW (INQUIRY, VOID, REFUND, CAPTURE TRANSACTIONS)

## MERCHANT HOSTED TRANSACTION FLOW (INQUIRY, VOID, REFUND, CAPTURE TRANSACTIONS)

 **Inquiry Transactions** : As an added security measure ARB Payment Gateway allows merchants to

do an inquiry of already completed transaction by passing certain details of the payment message,
ARB Payment Gateway provides response to this request with appropriate fields in the response;
the merchant is expected to verify the relevant fields like Transaction amount, transaction status
and other transaction fields.
 **Refund Transactions** : Merchant collects the cancellation request and initiate the transaction using

```
Refund API. Merchant may initiate refund for full amount or partial amount; Payment Gateway will
allow amount until it reached to original transaction amount.
```
 **Authorization Extension Transactions (MADA):** As per the current functionality, only MADA is
supporting Authorization Extension. Authorization Extension is nothing but extending the
Authorization period not the Authorized amount.

```
Transaction Type Action Code
Inquiry 8
void 3
refund 2
capture 5
Void Authorization Transactions (MADA) 9
Authorization Extension transactions (MADA) 14
```
**Note:** Capture transactions need to be performed within 7 days.

```
UDF7 should be sent as “ R ” for Non-Save Card Capture transactions [i.e., Action Code
= 5].
Auth Extension and refund needs to be performed within 14 days.
```

©2024 API Guide Page 134 of 313

### Request

```
Request from Merchant to ARB Payment Gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id from
Merchant portal
```
```
2 trandat
a
```
```
M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Tran data request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M AlphaNu
m
```
```
Unique Tranportal ID.
```
```
2 password M Alphanu
m
```
```
Tranportal password.
```
```
3 action M Numeric Transaction action
Ex: “2” for Refund
“3” for Void purchase
“8” for Inquiry
'"5" for Capture
“9” for Void Auth – only MADA
“14” for Auth Extension – only MADA
```
```
4 amt M Numeric Transaction amount
```
```
5 currencyCode M Numeric Currency code of merchant
```
```
6 trackId O Numeric A unique tracking id issued by the merchant's system
```
```
7 udf5 M Alphanu
m
```
```
When merchant want to perform refund/Void/Inquiry/
Void Auth / Auth Extension based on PaymentID /
TransID / TrackID then merchant need to pass, a word
PaymentID / TRANID/ TrackID in Udf5 field.
```
```
8 Customer ID 0 Alphanu
m
```
```
When Merchant required to perform Preatuh for
unschedule transaction
```
```
9 transId M Numeric When merchant want to perform refund/Void/Inquiry/
Void Auth/ Auth Extension based on PaymentID /
TransID / TrackID then merchant need to pass the value
of, PaymentID / TRANID/ TrackID in this field
```

©2024 API Guide Page 135 of 313

```
10 udf10 O Alphanu
m
```
```
Applicable only for MADA :
Need to mention whether the transaction is partial
capture or Full Capture in case of MADA transactions.
Udf10 fields needs to be set as below,
```
```
PARTIALCAPTURE for Partial Capture
FINALCAPTURE for Final Capture
```
```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
```
Below are the plain trandata request
```
```
Based on TransID (Payment Gateway Transaction ID):
```
```
[{
```
```
"amt":"70.00",
```
```
"action":"<action code>",
```
```
"password":"q@a68O$27@JLkcK",
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
"currencyCode":"682",
```
```
"trackId":"696921377",
```
```
"udf5":"TRANID",
```
```
"transId":"201931951332346",
```
```
“udf10”:”FULLCAPTURE” //Applicable only for MADA capture transactions
```
```
}]
```

©2024 API Guide Page 136 of 313

```
Based on Payment ID (Payment ID):
```
```
[{
```
```
"amt":"70.00",
```
```
"action":"<action code>",
```
```
"password":"q@a68O$27@JLkcK",
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
"currencyCode":"682",
```
```
"trackId":"696921377",
```
```
"udf5":"PaymentID",
```
```
"transId":"100201931948635783",
```
```
“udf10”:”FULLCAPTURE” //Applicable only for MADA capture transactions
```
```
}]
```
```
Based on TrackID (Merchant Transaction ID/Track ID):
```
```
[{
```
```
"amt":"70.00",
```
```
"action":"<action code>",
```
```
"password":"q@a68O$27@JLkcK",
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
"currencyCode":"682",
```
```
"trackId":"696921377",
```
```
"udf5":"TrackID",
```
```
"transId":"696921377",
```
```
“udf10”:”FULLCAPTURE” //Applicable only for MADA capture transactions
```
```
}]
```

©2024 API Guide Page 137 of 313

### Response

```
Response from ARB Payment Gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandat
a
```
```
M AlphaNu
m
```
```
All the below response parameters will be provided in trandata
field
```
```
2 error C Alphanu
m
```
```
If any error during processing, PG will provide the error code
```
```
3 errorTe
xt
```
```
C Alphanu
m
```
```
If any error during processing, PG will provide the error
description
```
```
4 status M Alphanu
m
```
```
If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway.
Based on this payment Id merchant can
match the final URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status, Value will be
“CAPTURED” for Refund Successful and
“NOT CAPTURED” for Refund Failure and
“VOIDED” for Void Purchase / Void
Authorization Successful and “NOT
VOIDED” for Void Purchase / Void
Authorization Failure
```
```
For MADA: If Refund request is initiated
after one Month and declined with response
code “199” then PG will internally initiate
the manual Refund if it is accepted then the
result is “PROCESSING” otherwise “NOT
PROCESSED”.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by
Payment gateway and merchant can use
this id for initiating supported transactions
(Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```

©2024 API Guide Page 138 of 313

```
S. No Fields M/C/O Field Type Description
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by PG
```
```
14 authCode M Numeric 6 digit authorization code received from
switch
```
```
15 cardType M Alphabetic
```
```
Card Brand name. Value will be "Visa" or
"MasterCard" or "Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
1 - Purchase
2 - Credit
3 - Void Purchase
```

©2024 API Guide Page 139 of 313

```
S. No Fields M/C/O Field Type Description
```
```
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
17 origTransactionI
D
```
```
C Alphanume
ric
```
```
It is applicable only for Supporting
Transactions action code like 2,3,5,9
and 14. It refers to the “transId” of the
Source/Original transaction
```
```
18 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
19 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
20 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Below is the sample encrypted response from PG to Merchant
```
```
[{
```
```
“tranid”: “ 201931951332346 ”,
```
```
"trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”: null,
```
```
“errorText”: null
```
```
}]
```
```
Plain trandata in response
```
```
[{
```
```
“paymentId”:100201934525118923,
```
```
”result”:”success”,
```
```
”date”:”1221”,
```

©2024 API Guide Page 140 of 313

```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”PaymentID”,
```
```
”trackId”,”3423423”,
```
```
”transId”:”201931951332346”,
```
```
”ref”:”935110000001”,
```
```
”authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
```
}]
```

©2024 API Guide Page 141 of 313

## BANK HOSTED INTEGRATION FLOW (APPLE PAY)

## BANK HOSTED INTEGRATION FLOW (APPLE PAY)

This section illustrates how you can integrate the bank hosted flow on your website

application.


©2024 API Guide Page 142 of 313

1. User visits the merchant application and creates order.
2. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token.
3. ARB Payment gateway internally validates the request.

```
 In case of successful validation, ARB PG provides Payment ID and Payment Page
URL in the response.
```
- Merchant needs to frame the payment page URL with Payment ID, Hence the
    ARB payment page is displayed with Apple Pay button.
 In case of failure, ARB PG provides **Error Code** and **Description**.

```
Note: If merchant notification is disabled, then ARB Payment gateway will provide the
final response in URL redirection.
```
4. User click the Apple Pay button and selects the required card details from apple wallet
    and performs apple authorization.
5. The ARB PG application process the transaction and returns the transaction response
    to the merchant site.
6. Merchant server calls the transaction status API to verify the transaction response.
7. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 143 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
3
```
```
responseUR
L
```
```
M Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant portal.
```
```
4 id M Alphanum
```
```
Tranportal ID. Merchant download the
same in merchant portal
```
```
5
```
```
currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```

©2024 API Guide Page 144 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field is left blank
when no data needs to be passed.
```
```
12
```
```
response
URL
```
```
M Alphanum
```
```
The merchant success URL where
Payment Gateway send the notification
request.
```
```
13 errorURL M Alphanum
```
```
The merchant error URL where Payment
Gateway send the response in case any
error while Processing the transaction.
```
```
14 langid O Alphabetic
```
```
Language ID. Based on language ID
arabic language will be displayed on
payment page. Value should be 'ar' or
'AR' for arabic language.
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
[{
```
```
//Mandatory Parameters
```

©2024 API Guide Page 145 of 313

```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata> ”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource Key.
```
```
Plain Trandata:
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```

©2024 API Guide Page 146 of 313

```
"langid":"ar",
```
```
}]
```
#### MADA Mandatory Parameters

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same
in merchant portal.
```
```
4 id M
```
```
Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
10 udf5 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field
data is passed along with a transaction request and
then returned in the transaction response.
```

©2024 API Guide Page 147 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
##### {

```
//MADA Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 2 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```
```
}]
```
```
Merchant should ensure that field is left blank
when no data needs to be passed.
```
```
11 responseURL M Alphanu
m
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
12 errorURL M Alphanu
m
```
```
The merchant error URL where Payment Gateway
send the response in case any error while
Processing the transaction.
```

©2024 API Guide Page 148 of 313

#### Split Payment or Payout.

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//Conditional if Merchant Opted for Split Payment or Payout.
```
```
"accountDetails":[
```
```
{"bankIdCode":"12345d6f","iBanNum": "567896743281926354276254",
```
```
"benificiaryName":"AlRajhi Bank Services",
```
```
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode":"1234ret3","iBanNum": "987656743281926354276254",
```
```
"benificiaryName":"DIGITAL CO",
```
```
"serviceAmount":"300.00","valueDate":"202 012 31" }] ,
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C JSON
Array
```
```
Conditional if Merchant Opted for Payout future.
Split Payment or Payout Details.
```
```
2 bankIdCode C
```
```
Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C
```
```
Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
```
5 serviceAmoun
t
```
```
C Numeric Service Amount
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 149 of 313

#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### },

```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY' 'PAY_SAVE'
'ADVANCE' 'PARTIAL_PAYMENT' 'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount^ C Numeric billAmount^
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in advance -
POSTPAID : Paid at the end
```
```
5 billNumber C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber^ C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 150 of 313

#### Airline

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 airline C JSON Object Conditional - for Airline Merchant
```
```
1.1 bookingReferenc
e
```
```
C Alphanum The booking reference number
```
```
1.1.1 itinerary^ C JSON Object Conditional -^ for Airline Merchant^
```
```
1.1.1.1 leg^ C JSON Array Conditional -^ for Airline Merchant^
```
```
1.1.1.1.1 carrierCode C Alphanum The carrier code for the leg
```
```
1.1.1.1.2 departureAirport C Alphanum The departure airport for the passenger
1.1.1.1.3 departureDate^ C Alphanum The departure date for the leg^
1.1.1.1.4 departureTime^ C Alphanum The departure airport for the passenger^
1.1.1.1.5 destinationAirpo
rt
```
```
C Alphanum The destination airport for the leg^
```
```
1.1.1.1.6 destinationArriva
lDate
```
```
C Alphanum The arrival date for the leg
```
```
1.1.1.1.7 destinationArriva
lTime
```
```
C Alphanum The arrival time for the leg
```
```
1.1.1.1.8 fareBasis^ C Alphanum The fare basis for the leg^
1.1.1.1. 9 flightNumber^ C Alphanum The flight number for the leg^
1.1.1.1.10 travelClass C Alphanum The class of service for the leg
1.1.1.2 numberInParty C Alphanum
1.1.1.3 originCountry C Alphanum The origin Country of the itinerary
1.1.2 passenger^ C JSON Array Conditional -^ for airline merchant^
1.1.2.1 firstName^ C Alphanum The passenger first^ name^
1.1.2.2 lastName C Alphanum The passenger last name
1.1.3 ticket C JSON Object Conditional - for airline merchant
1.1.3.1 issue C JSON Object Conditional - for airline merchant
1.1.3.1.1 carrierCode^ C Alphanum Code of the airline that issuing the ticket^
1.1.3.1.2 carrierName^ C Alphanum Name of the airline that is issuing the ticket.^
1.1.3.1.3 travelAgentCode C Alphanum Code of the Travel Agent that issuing the ticket
1.1.3.1.4 travelAgentNam
e
```
```
C Alphanum Name of the Travel Agent that issuing the ticket
```
```
1.1.3.2 totalFare^ C Numeric Ticket Total Fare^
```

©2024 API Guide Page 151 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional - for airline merchant
```
```
{ "airline": { "bookingReference": "5WPU68", "itinerary": { "leg": [ {
"carrierCode": "MH", "departureAirport": "MNL", "departureDate": "2021- 05 - 11",
"departureTime": "06:50:00Z", "destinationAirport": "KUL",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "10:35:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0805", "travelClass": "B" }, {
"carrierCode": "UL", "departureAirport": "KUL", "departureDate": "2021- 05 - 11",
"departureTime": "15:00:00Z", "destinationAirport": "CMB",
"destinationArrivalDate": "2021- 05 - 11", "destinationArrivalTime": "16:05:00Z",
"fareBasis": "BOWMPH6", "flightNumber": "0315", "travelClass": "B" } ],
"numberInParty": "1", "originCountry": "PHL" }, "passenger": [ { "firstName":
"KAI MR", "lastName": "QIAN" } ], "ticket": { "issue": { "carrierCode": "UL",
"carrierName": "SRILANKANAIRLINES", "travelAgentCode": "91401483",
"travelAgentName": "MANUL08AE" }, "totalFare": "54918.00", "totalFees":
"59518.00", "totalTaxes": "4600.00" } } }
```
##### }]

```
1.1.3.3 totalFees^ C Numeric Total fee for the ticket.^
1.1.3.4 totalTaxes^ C Numeric Tax portion of the order amount.^
```

©2024 API Guide Page 152 of 313

### Initial Response - Payment ID and Payment Page URL

```
Attributes - Initial Response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then
status will be ‘1’. If the validation failed,
then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if
the validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway
will provide the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway
will provide the respective error description
```
```
Sample JSON Response - Initial Response from ARB PG to Merchant
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response in case of successful validation, if failure then error code and
description will be provided. The below response will be in plain format and there is no
encryption for the below. Merchant can directly parse the response-based status and result
fields as mentioned below.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"100201931620827468:https://securepayments.alrajhibank.com.sa/pg/pa
ymentpage.htm", //Payment ID:Paymentpage URL
```
```
“error”: null,
```
```
“errorText”: null }]
```
**Failure:**

```
[{
```
```
"status": "2",
```

©2024 API Guide Page 153 of 313

```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

After Initial Response from ARB PG, merchant needs to frame the payment page URL like the

below sample.

https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=1002019316

20827468


©2024 API Guide Page 154 of 313

### Final Response – Transaction Status

```
Attribute - Final URL redirection response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique payment Id generated by PG and
merchant can use this ID to match the
response from PG
```
```
2 trandata C Alphanum All the below response parameters
encrypted and send the encrypted value
in trandata
```
```
3 error C Alphanum If any error, PG will send the error code
```
```
4 errorText C Alphanum If any error, PG will send the error
description
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by payment
gateway. Based on this payment Id
merchant can match the final URL
redirection response
```
```
2 result M Alphanum Transaction status. Value will be
'CAPTURED' for purchase successful
and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric Unique transaction Id generated by
Payment gateway and merchant can
use this id for initiating supported
transactions (Void, refund and
inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these
fields. The field data is passed along
```

©2024 API Guide Page 155 of 313

```
S. No Fields M/C/O Field Type Description
```
```
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
10 udf 4 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
11 udf5 O Alphanum The user (merchant) defines these
fields. The field data is passed along
with a transaction request and then
returned in the transaction response.
Merchant should ensure that field is
left blank when no data needs to be
passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by PG
```
```
14 authCode M Numeric 6 digit authorization code received
from switch
```
```
15 cardType M Alphabetic Card Brand name. Value will be "Visa"
or "MasterCard" or "Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
```

©2024 API Guide Page 156 of 313

```
S. No Fields M/C/O Field Type Description
```
```
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
17 card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
If Merchant notification is disabled, then ARB Payment gateway will provide the final
response in URL redirection. Below is the sample response from ARB PG to merchant
```
```
[{
```
```
//Redirection Parameters
```
```
“paymentId”:” 100201935166676976 ”,
```
```
“trandata”:”<encrypted trandata>”,
```
```
“error”:””,
```
```
“errorText”:””
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:” 100201935166676976 ”,
```

©2024 API Guide Page 157 of 313

```
”result”: ”CAPTURED”,
```
```
”transId”:201935166561122,
```
```
”ref”:”935110000001”,
```
```
”date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”
```
##### }]


©2024 API Guide Page 158 of 313

## MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY)

## MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY)

This section illustrates how you can integrate the merchant hosted flow (Apple Pay) on your

website application.

1. User visits the merchant application and creates order.
2. In the merchant page, the **Apple Pay** button is displayed. User clicks the **Apple Pay**
    button and select required card from apple wallet. (The **Apple Pay** button in merchant
    page is handled by the merchants by following the prerequisites steps)


©2024 API Guide Page 159 of 313

3. Merchant application backend server calls **Payment Token Generation API** to get
    the transaction token and to process payment via Alrajhi Payment gateway
4. After authorization, the ARB PG application process the transaction and returns the
    transaction response to the merchant site. The ARB Payment gateway will provide the
    final response in URL redirection.
5. Merchant server calls the transaction status API to verify the transaction response.
6. Finally, the merchant application displays the transaction status to user.


©2024 API Guide Page 160 of 313

### Request - Payment Token Generation API

```
Attributes - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
```
```
2 trandata M Alphanum All the below request parameters
encrypted and pass the encrypted value in
trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanum Tranportal password. Merchant download
the same in merchant portal.
```
```
4 id M Alphanum Tranportal ID. Merchant download the same
in merchant portal
```
```
5 currencyC
ode
```
```
M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
8 udf2 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
9 udf3 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
```

©2024 API Guide Page 161 of 313

```
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
(^10) udf4 O Alphanum The user (merchant) defines these
fields. The field data passed along with
a transaction request and then returned
in the transaction response. Merchant
should ensure that field left blank when
no data needs to be passed.
11 udf5 O Alphanum The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in the
transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
12 expYear M Numeric Expiry year of card
13 expMonth M Numeric Expiry month of card
14 member M Alphanum Card holder name
15 cvv2 M Numeric CVV of the card
16 cardNo M Numeric Cardholders card number
17 cardType M Alphanum Card type Ex : Credit card – C, Debit Card -
D
**Sample JSON request - Request from Merchant to ARB PG**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”
}]


©2024 API Guide Page 162 of 313

```
Plain Trandata:
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
}]
```

©2024 API Guide Page 163 of 313

#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### },

```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY' 'PAY_SAVE'
'ADVANCE' 'PARTIAL_PAYMENT' 'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount^ C Numeric billAmount^
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in advance -
POSTPAID : Paid at the end
```
```
5 billNumber C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber^ C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 164 of 313

### Final Response – Transaction Status

The ARB payment gateway verifies the transaction and returns the response to the same

request.

```
Attribute - Final response from ARB PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata M AlphaNum All the below response parameters will be
provided in trandata field
```
```
2 error C Alphanum If any error during processing, PG will
provide the error code
```
```
3 errorText C Alphanum If any error during processing, PG will
provide the error description
```
```
4 status M Alphanum If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway.
Based on this payment Id merchant can
match the final URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status. Value will be
'CAPTURED' for purchase successful and
'APPROVED' for authorization successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by
Payment gateway and merchant can use
this id for initiating supported transactions
(Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```

©2024 API Guide Page 165 of 313

```
S. No Fields M/C/O Field Type Description
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
10 udf 4 O Alphanum
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
11 udf5^ O^ Alphanum^
```
```
The user (merchant) defines these fields.
The field data is passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
```
```
12 amt M Numeric Transaction amount
```
```
13 authRespCode M Numeric Auth response code provided by PG
```
```
14 authCode M Numeric
```
```
6 digit authorization code received from
switch
```
```
15 cardType M Alphabetic
```
```
Card Brand name. Value will be "Visa" or
"MasterCard" or "Mada".
```
```
16 actionCode M Alphanume
ric
```
```
Action code of transaction. Possible
Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```

©2024 API Guide Page 166 of 313

```
S. No Fields M/C/O Field Type Description
```
```
17 Card C AlPhanume
ric
```
```
Card Number used for Performing
Transaction
```
```
18 expMonth C AlPhanume
ric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanume
ric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
The ARB payment gateway verifies the transaction and returns the response to the same
request.
```
```
[{
```
```
“tranid”: “201931951332346”,
```
```
"trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Plain Trandata:
```
```
Trandata will contain below parameters encrypted.
```
##### [{

```
“paymentId”:-1,
```
```
”result”:”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:”1221”,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```

©2024 API Guide Page 167 of 313

```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:”1242345345234”,
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
##### }]


©2024 API Guide Page 168 of 313

## PRE-AUTHENTICATION TRANSACTIONS (AIRLINE)

## PRE-AUTHENTICATION TRANSACTIONS (AIRLINE)

Pre-authorization (pre-auth) is a process of authenticating and temporary blocking of the

certain amount available on the card, based on the card details provided at the time of

booking.

1. User visits the merchant application and creates order.
2. User enters the payment card details.
3. Call the Pre-auth API to block amount from the user's account.
4. Merchant proceed with order/service completion.
5. Once the fulfilment is complete, call Capture API with the final amount to capture the
    amount from user's card and then notify the payment status to the user.


©2024 API Guide Page 169 of 313

### Request

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 170 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 expYear M Numeric Expiry year of card
```
```
12 expMonth M Numeric Expiry month of card
```
```
13 member M Alphanu
m
```
```
Card holder name
```
```
14 cvv2 M Numeric CVV of the card
```
```
15 cardNo M Numeric Cardholders card number
```
```
16 cardType M Alphanu
m
```
```
Card type Ex : Credit card – C, Debit Card – D
```
```
17 eci M Alphanu
m
```
```
Electronic commerce indicator received from third Party MPI
```
```
18 ucaf^ M Alphanu
m
```
```
UCAF received from third Party MPI
```
```
19 cavv M Alphanu
m
```
```
CAVV received from third Party MPI
```
```
Below is the sample encrypted request from Merchant to PG
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
```
Below are the plain Trandata request
```
##### [{

```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```

©2024 API Guide Page 171 of 313

```
”action”:”1”,
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C",
```
```
"eci":"7",
```
```
"ucaf":"1",
```
```
"cavv":"JcboZXndOg40CBECC2BGbheAAAA=",
```
```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```

©2024 API Guide Page 172 of 313

#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C
```
```
Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
```
5 serviceAmoun
t
```
```
C Numeric Service Amount
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 173 of 313

```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }

```
S. No Fields M/C/O Field Type Description
```
```
1 transactionTy
pe
```
```
C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE' 'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID^ C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount C Numeric billAmount
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID : Paid in
advance - POSTPAID : Paid at the end
```
```
5 billNumber C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType^ C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber^ C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 174 of 313

### Response

Once ARB payment gateway verifies the transaction and returns the response to the same request.

```
Response from ARB Payment Gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata M AlphaNu
m
```
```
All the below response parameters will be provided in
trandata field
```
```
2 error C Alphanu
m
```
```
If any error during processing, PG will provide the error
code
```
```
3 errorText C Alphanu
m
```
```
If any error during processing, PG will provide the error
description
```
```
4 status M Alphanu
m
```
```
If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway. Based on this
payment Id merchant can match the final URL
redirection response
```
```
2 result M
```
```
Alphanu
m
```
```
Transaction status. Value will be 'CAPTURED' for
purchase successful and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment gateway
and merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 175 of 313

```
S. No Fields M/C/O Field Type Description
```
```
9 udf3 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanum
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 amt M Numeric Transaction amount
```
##### 12

```
authRespCod
e M^ Numeric^ Auth response code provided by PG^
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 cardType M Alphabet
ic
```
```
Card Brand name. Value will be "Visa" or "MasterCard"
or "Mada".
```
```
15 actionCode M Alphanu
meric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
16 card C AlPhanu
meric
```
```
Card Number used for Performing Transaction
```
```
17 expMonth C AlPhanu
meric
```
```
Expiry Month of the Card
```
```
18 expYear C AlPhanu
meric
```
```
Expiry Year of the Card
```
```
Below is the sample encrypted response from PG to Merchant
```
```
[{
```
```
“tranid”: “ 201931951332346 ”,
```
```
"trandata": "<encrypted trandata>",
```

©2024 API Guide Page 176 of 313

```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Plain trandata in response
```
```
[{
```
```
“paymentId”:-1,
```
```
”result”:”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:” 1221 ”,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ”,
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```
```
"expMonth":"06", //1 – 2 Digits
```

©2024 API Guide Page 177 of 313

```
"expYear":"2024" //2 – 4 Digits
```
```
}]
```

©2024 API Guide Page 178 of 313

## INVOICE PAYMENT TRANSACTION FLOW

## INVOICE PAYMENT TRANSACTION FLOW

1. Customer visits the merchant site and selects the merchandise and confirms to pay using the

```
payment gateway.
```
2. Merchant redirects the customer with the Invoice transaction data to the payment gateway.
3. Payment Gateway verifies the invoice transaction request from the merchant and generates the
    invoice Payment URL based on the invoice type.
4. Payment gateway will provide the response to merchant with invoice Payment URL.
5. Merchant to redirect the Payment URL to Payment Gateway.
     There are two types of invoice transactions namely Dedicated and Open invoice.

```
a) If the initiated transaction type is dedicated, Merchant need to send the buyer details in the
request.
PG presents the hosted payment page with buyer details to customer and prompts the
customer to enter the card credentials.
b) If the initiated transaction type is open then merchant no need to send buyer details.
```
6. Payment gateway will get the buyer detail and process the transaction with the respective schemes.
7. Once the transaction complete, PG will send the response to merchant and customer via mail &

```
SMS.
```

©2024 API Guide Page 179 of 313

### Request - Payment Token Generation API

```
Request from Merchant to ARB Payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandat
a
```
```
M Alphanum All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Dedicated Invoice detailed description of Plain Trandata request parameters.
```
```
S. No Fields M/C/O Field Type Description
```
```
1 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
2 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in merchant
portal
```
##### 3

```
currencyCo
de M^ Numeric^3 - digit currency code of KSA. Ex:682^
```
```
4 invoiceId M Alphanu
m
```
```
50 - digit unique Id.
```
##### 5

```
itemDesc M
```
```
Alphanu
m 500 - digit Item Description.^
```
```
5 invoiceType M Alphabe
tic
```
```
1 - digit value ‘’D’’ or ‘’O’’
(D-dedicated invoice / O – Open Invoice)
```
```
6 buyerName M Alphabe
tic
```
```
50 - digit Buyer Name.
```
```
7 amt M Numeric Transaction amount.
```
```
8 email M
```
```
alphanu
m Buyer mail Id.^
```
```
9 mobile M Numeric Buyer Mobile Number.
```
```
10 expiryDate O
```
```
Alphanu
m
```
```
Expiry Date of the payment Link.
Date Format: “dd-MM-yyyy hh:mm:ss”
```
**Open Invoice detailed description of Plain Trandata request parameters.**


©2024 API Guide Page 180 of 313

```
S. No Fields M/C/O Field Type Description
```
```
1 password M
```
```
Alphanu
m
```
```
Tranportal password. Merchant download the same
in merchant portal.
```
```
2 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in
merchant portal
```
```
3 currencyCo
de
```
```
M Numeric 3 - digit currency code of KSA. Ex: “682”
```
```
4 invoiceId M
```
```
Alphanu
m 50 - digit unique Id.^
```
```
5
itemDesc M
```
```
Alphanu
m 500 - digit Item Description^
```
```
5 invoiceType M
```
```
Alphabe
tic
```
```
1 - digit value ‘’D’’ or ‘’O’’
(D-dedicated invoice / O – Open Invoice)
```
```
7 amt O numeric Transaction amount. Ex: “100.00”
```
```
10 expiryDate O
```
```
Alphanu
m
```
```
Expiry Date of the payment Link.
Date Format: “dd-MM-yyyy hh:mm:ss”
```

©2024 API Guide Page 181 of 313

### Initial Response - Payment ID and Processing Page URL

ARB Payment gateway internally validates the request and gives invoice payment page URL in the

response in case of successful validation, if failure then error code and description will be provided. The
below response will be in plain format and there is no encryption for the below. Merchant can directly

parse the response-based on the status and result fields as mentioned below.

```
Initial Response from PG to Merchant for Dedicated and Open Invoice
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"https://securepayments.alrajhibank.com.sa/mrchptl/iP.htm?Id=Y3FT9"
//Invoice Payment Page URL }]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”:” Problem occurred while validating transaction data”
```
```
}]
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then status will be ‘1’. If the
validation failed, then status will be ‘2’
```
```
2 result C Alphanu
m
```
```
It contains invoice Payment URL if the validation success
```
```
3 error C Alphanu
m
```
```
If validation failed, then Payment gateway will provide the
respective error code
```
```
4 errorT
ext
```
```
C Alphanu
m
```
```
If validation failed, then Payment gateway will provide the
respective error description
```

©2024 API Guide Page 182 of 313

**-** If success, Merchant needs to redirect the invoice payment page URL like the below
    sample
    https://securepayments.alrajhibank.com.sa/mrchptl/iP.htm?Id=Y3FT9
**-** Once merchant redirects the link, ARB Payment Gateway shows the invoice Payment
    Page to customer based on the invoice type.

### Final Response

After validating the customer card details then ARB Payment gateway will provide the final

response to merchant and customer via mail & SMS.


©2024 API Guide Page 183 of 313

## WEBHOOK MERCHANT NOTIFICATION FLOW

## WEBHOOK MERCHANT NOTIFICATION FLOW

For Webhook transactions, ARB PG will send risk based, authentication based or transaction/payment

based notification request to merchant as below :

```
Detailed Notification Request from PG to Merchant for Webhook
```
```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
1 type M Alphanum(20) Type of Notification to the Merchant
```
```
2 payLoad M JSON Object
```
```
Payment Status Info.All the Payment Gateway
related information’s available in the payload fields
(Further table below)
```
```
3 result M JSON Object Transaction Status -^ Contains the Transaction status
for the transaction (table below)
```
```
4 responseURL M Alphanum Merchant Response URL
```
```
payLoad Detailed Field description
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 paymentId M Alphanum[20] Payment ID -
```
```
Unique Id generated by Payment Gateway, this is
the same ID that Payment Gateway had provided
along with the PaymentPage URL for the initial
request
2 transId M Alphanum[19] Transaction ID -
```
```
Unique Transaction ID generated by Payment
Gateway
```
```
3 ref M Alphanum[12] RRN - The reference number of the transaction
known to payment scheme. This number or series
of letters is used for referential purposes by some
acquiring/issuing bank/institutions and should be
stored properly
```
```
4 paymentTim
estamp
```
```
M Alphanum Timestamp - ARB request initiation Timestamp
```
```
5 trackId M Alphanum[25
5]
```
```
Merchant Track ID -
```

©2024 API Guide Page 184 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
Track ID value that was sent by merchant in the
Purchase request
6 udf1 O Alphanum[25
5]
```
```
User Defined Field 1 -
```
```
Same udf value that merchant has sent in the
initial transaction request to Payment Gateway
```
```
7 udf2 O Alphanum[25
5]
```
```
User Defined Field 2 -
```
```
Same udf value that merchant has sent in the
initial transaction request to Payment Gateway
```
```
8 udf3 O Alpphanum[2
55]
```
```
User Defined Field 3
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
9 udf4 O Alphanum[25
5]
```
```
User Defined Field 4
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
10 udf5 O Alphanum255
]
```
```
User Defined Field 5
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
11 udf6 O Alphanum
[255]
```
```
User Defined Field 6
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
12 udf7 O Alphanum[25
5]
```
```
User Defined Field 7
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
13 udf8 O Alphanum[25
5]
```
```
User Defined Field 8
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
14 udf9 O Alphanum255
]
```
```
User Defined Field 9
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway


©2024 API Guide Page 185 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
15 udf10 O Alphanum[25
5]
```
```
User Defined Field 10
```
- Same udf value that merchant has sent in the
initial transaction request to Payment Gateway

```
16 amt M Numeric with
decimal places
```
- Max 12 digit
with 2 digit
decimal places

```
Transaction amount -
```
```
Transaction Amount as sent by merchant in the
request
```
```
17 authRespCod
e
```
```
O Alphanum[3] Authorization Response Code – Authorization code
received from the issuer bank
```
```
18 authCode O Alphanum[6] Authorization Code -
```
```
The resulting authorization number of the
transaction from the issuing bank. This number or
series of letters is used for referential purposes by
some acquiring/issuing bank/institutions and
should be stored properly
```
19 actionCode C Alphanumeric (^) Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
20 origTransacti
onID
C Alphanumeric (^) It is applicable only for Supporting Transactions
action code like 2,3,5,9 and 14. It refers to the
“transId” of the Source/Original transaction
21 card C AlPhanumeric (^) Card Number used for Performing Transaction
22 expMonth C AlPhanumeric (^) Expiry Month of the Card
23 expYear C AlPhanumeric (^) Expiry Year of the Card
**result Parameter detailed description**


©2024 API Guide Page 186 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
##### 1

```
status
M
```
```
Alphanum[30] Status of the Payment
```
##### 2

```
error
M
```
```
Alphanum[255] Error code of the transaction
```
##### 3

```
errorText
M
```
```
Alphanum[255] Error description
```
```
Notification Response from Merchant to PG for Webhook
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric Merchant Notification acknowledgment status
```
```
Webhook from PG:
```
```
PAYMENT
```
```
[{"result":[{"status":"CAPTURED"}], "responseURL":
"http://172.22.0.121:9207/MerchDemoREST/NotifyResponse.htm", "payLoad":
[{"date":"0415","authRespCode":"00","authCode":"623666",
```
```
"transId":202110527755152,"trackId":"04d26d6c-ca9f-4ac3-b65d-
6c5bff7af1a6", "udf5":"Select",
"udf10":"null","amt":10,"udf3":"null","udf4":"null","udf1":"null","udf2
":"null","ref":"110533003557","udf9":"null","udf8":"null","paymentTimes
tamp":"2021- 04 - 15T02:58:30.448Z",”actionCode”:”1”,
"card":"401200XXXXXX1112","expMonth":"6","expYear":"24"}],
"type":"PAYMENT"}]
```
```
PAYMENT FAILURE
```
```
[{"result":[{"errorText":"00","error":"IPAY00001","status":"NOT
CAPTURED"}], "responseURL":
```

©2024 API Guide Page 187 of 313

```
"http://172.22.0.121:9207/MerchDemoREST/NotifyResponse.htm", "payLoad":
[{"date":"0414","ref":"110423000769","authRespCode":"00","authCode":"54
4377","paymentId":"700202110427042639","transId":202110472940732,"track
Id":"e061c0ec-b32e-456b-9ac2-
8196fb8f16ec","amt":100,"paymentTimestamp":"2021- 04 -
13T22:48:21.082Z",”actionCode”:”1”,"card":"401200XXXXXX1112","expMonth"
:"6","expYear":"24"}],"type":"PAYMENT FAILURE"}]
```
```
Purchase HOST TIME OUT Webhook notification request (Action code will be
Change in payload for each segments as per document.)
```
```
[{"result":[{"status":"HOST
TIMEOUT"}],"responseURL":"https://partner.se.com.sa/RESTAdapter/AlRajhi
/PayNotification","payLoad":[{"date":"0527","authRespCode":"000","authC
ode":"163025","trackId":"ec4e181a-16e9-406e-a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"","amt":"5.0","udf3":"null","udf4":"n
ull","udf1":"null","udf2":"null","ref":"214721008795","udf9":"null",pay
mentId":700202214780010325,"udf7":"","udf8":"null", "actionCode":"1"," pa
ymentTimestamp":"2022- 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
RISK FAILURE
```
```
[{"result":"[{"errorText":"X","error":"IPAY00002","status":"IPAY0100045
```
- DENIED BY RISK"}]", "responseURL":
"http://172.22.0.121:9207/MerchDemoREST/NotfiyRsponse.htm" ,"payLoad":
"[{"authRespCode":"X","trackId":"605965227",

```
"transId":202101752650620,
"udf5":"UDF5","cardType":"Visa","udf6":"UDF6","udf10":"UDF10","amt":35.
0,"udf3":"UDF3","udf4":"UDF4","udf1":"UDF1","udf2":"UDF2","result":"IPA
Y0100045 - DENIED BY
RISK","udf9":"UDF9","paymentId":”600202101747330225”,
"udf7":"UDF7","udf8":"UDF8",”actionCode”:”1”,
"card":"401200XXXXXX1112","expMonth":"6","expYear":"24"}]", "type":"RISK
FAILURE"}]
```
```
Refund Webhook notification request
```
```
[{"result":[{"status":"CAPTURED"}],"responseURL":"https://partner.se.co
m.sa/RESTAdapter/AlRajhi/PayNotification","payLoad":[{"date":"0527","au
thRespCode":"000","authCode":"163025","trackId":"ec4e181a-16e9-406e-
a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
```

©2024 API Guide Page 188 of 313

```
da","udf6":"10018496416","udf10":"FINALCAPTURE","amt":"5.0","udf3":"nul
l","udf4":"null","udf1":"null","udf2":"null","ref":"214721008795","udf9
":"null","origTransactionID":"202214779988486","paymentId":700202214780
010325,"udf7":"","udf8":"null","actionCode":"2","paymentTimestamp":"202
2 - 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"12","expYear":"
36"}],"type":"PAYMENT"}]
```
```
VOIDED Webhook notification request
```
```
[{"result":[{"status":"VOIDED"}],"responseURL":"https://partner.se.com.
sa/RESTAdapter/AlRajhi/PayNotification","payLoad":[{"date":"0527","auth
RespCode":"000","authCode":"163025","trackId":"ec4e181a-16e9-406e-a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"","amt":"5.0","udf3":"null","udf4":"n
ull","udf1":"null","udf2":"null","ref":"214721008795","udf9":"null","or
igTransactionID":"202214779988486",paymentId":700202214780010325,"udf7"
:"","udf8":"null","actionCode":"3","paymentTimestamp":"2022- 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
NOT VOIDED Webhook notification request
```
```
[{"result":[{"status":"NOT
VOIDED"}],"responseURL":"https://partner.se.com.sa/RESTAdapter/AlRajhi/
PayNotification","payLoad":[{"date":"0527","authRespCode":"000","authCo
de":"163025","trackId":"ec4e181a-16e9-406e-a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"","amt":"5.0","udf3":"null","udf4":"n
ull","udf1":"null","udf2":"null","ref":"214721008795","udf9":"null","or
igTransactionID":"202214779988486",paymentId":700202214780010325,"udf7"
:"","udf8":"null","actionCode":"3","paymentTimestamp":"2022- 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
Auth Webhook notification request
```
```
[{"result":[{"status":"APPROVED"}],"responseURL":"https://partner.se.co
m.sa/RESTAdapter/AlRajhi/PayNotification","payLoad":[{"date":"0527","au
thRespCode":"000","authCode":"163025","trackId":"ec4e181a-16e9-406e-
a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"FINALCAPTURE","amt":"5.0","udf3":"nul
l","udf4":"null","udf1":"null","udf2":"null","ref":"214721008795","udf9
":"null","paymentId":700202214780010325,"udf7":"","udf8":"null","action
Code":"4","paymentTimestamp":"2022- 05 -
```

©2024 API Guide Page 189 of 313

```
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
Auth Webhook notification request
```
```
[{"result":[{"status":"NOT
APPROVED"}],"responseURL":"https://partner.se.com.sa/RESTAdapter/AlRajh
i/PayNotification","payLoad":[{"date":"0527","authRespCode":"000","auth
Code":"163025","trackId":"ec4e181a-16e9-406e-a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"FINALCAPTURE","amt":"5.0","udf3":"nul
l","udf4":"null","udf1":"null","udf2":"null","ref":"214721008795","udf9
":"null","paymentId":700202214780010325,"udf7":"","udf8":"null","action
Code":"4","paymentTimestamp":"2022- 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
Capture Webhook notification request
```
```
[{"result":[{"status":"APPROVED"}],"responseURL":"https://partner.se.co
m.sa/RESTAdapter/AlRajhi/PayNotification","payLoad":[{"date":"0527","au
thRespCode":"000","authCode":"163025","trackId":"ec4e181a-16e9-406e-
a132-
bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardType":"Ma
da","udf6":"10018496416","udf10":"FINALCAPTURE","amt":"5.0","udf3":"nul
l","udf4":"null","udf1":"null","udf2":"null","ref":"214721008795","udf9
":"null","origTransactionID":"202214779988486","paymentId":700202214780
010325,"udf7":"","udf8":"null","actionCode":"5","paymentTimestamp":"202
2 - 05 -
27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"6","expYear":"2
4"}],"type":"PAYMENT"}]
```
```
Manual Refund Failure
```
```
[{"result":[{"status":"NOT
PROCESSED"}],"responseURL":"https://partner.se.co
m.sa/RESTAdapter/AlRajhi/PayNotification","payLoad":[{"date":"0527","au
thRespCode":"124","authCode":"163025","trackId":"ec4e181a-16e9-
406ea132bdfda42e4e91","transId":202214720027040,"udf5":"TrackID","cardT
ype":"Mada","udf6":"10018496416","udf10":"","amt":"5.0","udf3":"nul
l","udf4":"null","udf1":"null","udf2":"null","ref":"214721008795","udf9
":"null","origTransactionID":"202214779988486","paymentId":700202214780
010325,"udf7":"","udf8":"null","actionCode":"2","paymentTimestamp":"202
2 - 05 - 27T08:27:34.155Z","card":"401200XXXXXX1112","expMonth":"12",
"expYear":"36"}],"type":"PAYMENT"}]
```

©2024 API Guide Page 190 of 313

**Note : “** origTransactionID”:” 202101747330225” – Condition Parameter

```
Merchant should send acknowledgment to PG as below:
```
```
Merchant Response Sample:
```
```
[{
```
```
"status": "1"
```
```
}]
```
```
If PG doesn't receive any acknowledgement from merchant , PG will keep sending the
notification request till the acknowledgement is received.
```

©2024 API Guide Page 191 of 313

## MERCHANT NOTIFICATION FLOW FOR BANK HOSTED TRANSACTIONS

## MERCHANT NOTIFICATION FLOW FOR BANK HOSTED TRANSACTIONS

If Notification enabled at Merchant level,

1. Payment gateway will initiate REST call to send the transaction status notification request to
    merchant and wait for the acknowledgement.
2. If PG receives the acknowledgment from merchant, then Payment Gateway logs the response
    and provides the transaction update to Cortex system for processing the settlement and
    Payment Gateway sends the final response to merchant. The final response will be URL
    redirection.
3. Merchant displays transaction result to customer.
4. In case, if PG does not receive the acknowledgment from merchant, then PG will initiate the
    VOID transaction to respective scheme to reverse the transaction and there is no payment
    advise initiated to Cortex.

If Notification disabled at Merchant level,

1. Payment Gateway logs the response and provides the transaction update to Cortex system for
    processing the settlement and Payment Gateway sends final response to merchant and this will
    be URL redirection.
2. Merchant displays transaction result to customer.


©2024 API Guide Page 192 of 313

### Request - Notification Generation API

```
Notification request from PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 payment
Id
```
```
M Numeric Unique ID generated by Payment gateway. Merchant can store
the payment ID to match the final URL redirection response
```
```
2 trandata M Alphanu
m
```
```
All the below response parameters encrypted and send the
encrypted value in trandata
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway. Based on this
payment Id merchant can match the final URL redirection
response
```
```
2 result M Alphanum Transaction status
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment gateway and
merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```

©2024 API Guide Page 193 of 313

```
S. No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
10 udf5 O Alphanum
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
11 amt M Numeric Transaction amount
```
```
12 authRespCode M Numeric Auth response code provided by PG
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 actionCode C Alphanum
eric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
Below is the sample merchant notification request and response,

```
Notification Request from ARB payment gateway to Merchant:
```
```
[{
```
```
“paymentId”:100201935044735860,
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
```
Plain Trandata:
```
```
[{“paymentId”:100201935166676976,
```
```
”result”:”CAPTURED”,
```
```
”ref”:”935110000001”,
```
```
”transId”:” 201935166561122 ”,
```

©2024 API Guide Page 194 of 313

```
“date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
“actionCode”:”1”,
```
```
"card":"401200XXXXXX1112",
```
```
"expMonth":"12", // 1 - 2 digits
```
```
"expYear":"2036" // 2 - 4 digits
```
##### }]


©2024 API Guide Page 195 of 313

### Response - Acknowledgement

**Notification response from Merchant to ARB Payment gateway**

```
S. No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
1 status M Numeric Status should be ‘1’
```
```
2 result M Alphanum Merchant response URL for which PG will provide the final URL
redirection response
```
**Acknowledgment response from merchant to PG:**

##### [{

```
"status": "1",
```
```
"result":”https://merchant.com/finalresultURL”
```
##### }]


©2024 API Guide Page 196 of 313

### Final response to merchant

```
If ARB payment gateway receives the acknowledgement from merchant, PG logs the
response and provide the response back to merchant. This will be URL redirection.
```
```
Response from PG to merchant.
```
```
[{
```
```
“paymentId”:” 100201935166676976 ”,
```
```
“trandata”:”<encrypted trandata>”,
```
```
“Error”:””,
```
```
“ErrorText”:””
```
```
}]
```
```
Plain Trandata:
```
##### [{

```
“paymentId”:” 100201935166676976 ”,
```
```
”result”:”CAPTURED”,
```
```
”ref”:”935110000001”,
```
```
”transId”:” 201935166561122 ”,
```
```
”date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0”,
```
```
”authRespCode”,”00”,
```

©2024 API Guide Page 197 of 313

```
"authCode":"000000",
```
```
“actionCode”:”1”,
```
```
"card":"401200XXXXXX1112",
```
```
"expMonth":"12", // 1 - 2 digits
```
```
"expYear":"2036" // 2 - 4 digits
```
```
}]
```

©2024 API Guide Page 198 of 313

### Response – No Acknowledgement

```
If there is no acknowledgement from Merchant After initiating the merchant notification,
PG will wait for the response based on the configured time and no acknowledgement from
merchant then PG will void the transaction and update the response back to merchant
error URL received in the initial API request.
```
```
[{
```
```
“paymentId”:” 100201935166676976 ”,
```
```
”Result”:”Voided”,
```
```
”error”:”IPAY0200025”,
```
```
”errorText”:”!ERROR!-IPAY0200025 - Problem occurred while getting
merchant acknowledgement & transaction reversed”,
```
```
”trackId”:”123456”,
```
```
”amt”:”12.0”
```
```
}]
```

©2024 API Guide Page 199 of 313

## ISSUER COUNTRY API (CARD BIN CHECK)

## ISSUER COUNTRY API (CARD BIN CHECK)

Perform a BIN lookup using this API call. Merchant can send card bin number to PG and PG

will respond with card issuer country details.

**End Point: https://securepayments.alrajhibank.com.sa/pg/payment/bincheck.htm**

```
Request from Merchant to PG
```
```
Detailed description of Request from Merchant to ARB payment gateway
```
```
S. No Fields
```
##### M/C/

##### O

```
Field
Type
```
```
Des c ription
```
```
1 bin M Numeric Card Bin First six digits of the card Number
```
```
2 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the same
in merchant portal
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant can download
the same in merchant portal.
```
```
Below is the sample request from Merchant to PG
```
```
{
```
```
"bin":"515735",
```
```
"id":"IPAYAq03cVHHs2q",
```
```
"password":"1$Q$VP73S2gycg@"
```
```
}
```

©2024 API Guide Page 200 of 313

### Response from PG to Merchant

Detailed description of Response from ARB payment gateway to Merchant

```
S. No Fields M/C/O Field Type Description
```
```
1 bin C Numeric Card Bin First six digits of the card Number
2 bank C Alphanu
m
```
```
Bank name for the card bin issuer
```
```
3 country C Alphanu
m
```
```
Country name for the card bin
```
```
4 countryco
de
```
```
C Alphanu
m
```
```
Country Code for the card bin
```
```
5 card C Alphanu
m
```
```
Card Type. Ex : MasterCard /Visa
```
```
6 errorText C Alphanu
m with
special
chars
```
```
If validation failed, then payment gateway will provide the
respective error description
```
```
7 error C Alphanu
m
```
```
If validation failed, then Payment gateway will provide the
respective error code
8 status M Numeric If the request validation is success, then status will be ‘1’.
If the validation failed, then status will be ‘2’
```
```
Below is the sample response from PG to Merchant (Success Case)
```
```
{
```
```
"country":"SAUDI ARABIA",
```
```
"bank":"Al Bank Al Saudi Al Fransi",
```
```
"bin":"446404",
```
```
"countrycode":"SAU",
```
```
"card":"MADA",
```
```
"status":"1"
```
```
}
```

©2024 API Guide Page 201 of 313

```
Below is the sample response from PG to Merchant (Error Case)
```
{

```
"errorText":"!ERROR!-IPAY0100380-Bin number should be of 6
digits.",
```
```
"error":"IPAY0100380",
```
```
"status":"2"
```
```
}
```

©2024 API Guide Page 202 of 313

## BANK HOSTED RECURRING TRANSACTION FLOW (3D SECURE)

## BANK HOSTED RECURRING TRANSACTION FLOW (3D SECURE)

Recurring Billing API methods enable merchant user (via payment gateway) to manage

regular subscription payments.

### Request - Payment Token Generation API

```
Request from Merchant to ARB Payment gateway
```
```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
3 responseURL M Alphanum
```
```
The merchant success URL where Payment Gateway send
the notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization : 4
```
```
3 password M
```
```
Alphanu
m
```
```
Tranportal password. Merchant download the
same in merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same
in merchant portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```

©2024 API Guide Page 203 of 313

```
Request from Merchant to ARB Payment gateway:
```
```
[{
```
```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata> ”,
```
```
"responseURL":"https://merchantpage/PaymentResult.jsp",
```
```
"errorURL":"https://merchantpage/PaymentResult.jsp"
```
```
}]
```
```
Plain Trandata:
```
```
7 udf1 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
9 udf3 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
11 responseURL M Alphanu
m
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
12 errorURL M
```
```
Alphanu
m
```
```
The merchant error URL where Payment
Gateway send the response in case any error
while Processing the transaction.
```

©2024 API Guide Page 204 of 313

```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource Key
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 2 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”12345656789”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”udf1”:” 1 ”, //To identify Recurring based transactions
```
```
”udf2”:”SI”, //To identify Recurring based transactions
```
```
//Optional Parameters
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
"langid":"ar",
```

©2024 API Guide Page 205 of 313

#### Split Payment or Payout.

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//Conditional if Merchant Opted for Split Payment or Payout.
```
```
"accountDetails":[
```
```
{"bankIdCode":"12345d6f","iBanNum": "567896743281926354276254",
```
```
"benificiaryName":"AlRajhi Bank Services",
```
```
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode":"1234ret3","iBanNum": "987656743281926354276254",
```
```
"benificiaryName":"DIGITAL CO",
```
```
"serviceAmount":"300.00","valueDate":"202 012 31" }] ,
```
```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryName C
```
```
Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
```
5 serviceAmount C Numeric Service Amount
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 206 of 313

#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### },

```
S. No Fields
```
##### M/C

##### /O

```
Field
Type
```
```
Description
```
```
1 transactionType C Alphanu
m
```
```
Minimum length : 3 , Maximum length : 15
Transaction Type Allowed Values 'PAY' 'PAY_SAVE'
'ADVANCE' 'PARTIAL_PAYMENT' 'OVER_PAYMENT'
```
```
2 billerID C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 3
Biller ID
```
```
3 billAmount C Numeric billAmount
```
```
4 billType C Alphanu
m
```
```
Minimum length : 7 , Maximum length : 8
Bill Type. The allowed values are: - PREPAID
: Paid in advance - POSTPAID : Paid at the end
```
```
5 billNumber C Alphanu
m
```
```
Minimum length : 1 , Maximum length : 30
Bill Number as identified by SADAD
```
```
6 IDType C Alphanu
m
```
```
Minimum length : 2 , Maximum length : 2
ID Type 01 National ID Card 02 Iqama 03 Passport
```
```
7 IDNumber C Alphanu
m
```
```
Minimum : 1 , Maximum : 20
ID Number
```

©2024 API Guide Page 207 of 313

### Initial Response - Payment ID and Payment Page URL

```
Initial Response from PG to Merchant
```
 ARB Payment gateway internally validates the request and gives payment ID and payment

```
page URL in the response in case of successful validation, if failure then error code and
description will be provided. The below response will be in plain format and there is no
encryption for the below. Merchant can directly parse the response-based status and result
fields as mentioned below.
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":"100201931620827468:https://securepayments.alrajhibank.com.sa/pg/pa
ymentpage.htm", //Payment ID:Paymentpage URL
```
```
“error”: null,
```
```
“errorText”: null }]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”: ”Problem occurred while validating transaction data”,
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then status will be ‘1’.
If the validation failed, then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if the
validation success else this will be null
```
```
3 error C Alphanum If validation failed, then Payment gateway will provide
the respective error code
```
```
4 errorText C Alphanum If validation failed, then Payment gateway will provide
the respective error description
```

©2024 API Guide Page 208 of 313

```
“result”: null
```
```
}]
```
### Framing Payment URL

 If success, Merchant needs to frame the payment page URL like the below sample

```
https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=10020193
1620827468
```
 If Merchant notification is disabled, then ARB Payment gateway will provide the final response in

```
URL redirection. Below is the sample response from ARB PG to merchant
```

©2024 API Guide Page 209 of 313

### Final Response – Transaction Status

```
Final URL redirection response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique payment Id generated by PG and merchant can use
this ID to match the response from PG
```
```
2 trandata C Alphanu
m
```
```
All the below response parameters encrypted and send the
encrypted value in trandata
```
```
3 error C Alphanu
m
```
```
If any error, PG will send the error code
```
```
4 errorText C Alphanu
m
```
```
If any error, PG will send the error description
```
```
Detailed description of Plain trandata parameters
```
```
S. No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by payment gateway. Based on this
payment Id merchant can match the final URL redirection
response
```
```
2 result M Alphanu
m
```
```
Transaction status. Value will be 'CAPTURED' for purchase
successful and 'APPROVED' for authorization successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric Unique transaction Id generated by Payment gateway and
merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```

©2024 API Guide Page 210 of 313

```
S. No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data is
passed along with a transaction request and then returned
in the transaction response. Merchant should ensure that
field is left blank when no data needs to be passed.
```
```
11 amt M Numeric Transaction amount
```
```
12 authRespCode M Numeric Auth response code provided by PG
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 cardType M Alphabet
ic
```
```
Card Brand name. Value will be "Visa" or "MasterCard" or
"Mada".
```
```
15 custid^ M Alphanu
m
```
```
Customer ID needs to be sent in the subsequent Merchant
Initiating recurring transactions
```
```
16 actionCode M Alphanu
meric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
17 card C AlPhanu
meric
```
```
Card Number used for Performing Transaction
```
```
18 expMonth C AlPhanu
meric
```
```
Expiry Month of the Card
```
```
19 expYear C AlPhanu
meric
```
```
Expiry Year of the Card
```
```
Sample JSON Response - Final
```
```
//Redirection Parameters
```

©2024 API Guide Page 211 of 313

```
 “paymentId”:” 100201935166676976 ”,
```
```
 “trandata”:”<encrypted trandata>”,
```
```
 “error”:””,
```
```
 “errorText”:””
```
```
Plain Trandata:
```
##### [{

```
“paymentId”:” 100201935166676976 ”,
```
```
”result”: ”CAPTURED”,
```
```
”transId”:201935166561122,
```
```
”ref”:”935110000001”,
```
```
”date”:” 1217 ”,
```
```
”trackId”:”1003383844”,
```
```
”udf1”:””,
```
```
”udf2”:””,
```
```
”udf3”:”8870091137”,
```
```
”udf4”:”FC”,
```
```
”udf5”:”Tidal5”,
```
```
”amt”:”70.0,
```
```
”authRespCode”,”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“custid”:”202014785236784”,
```
```
“actionCode”:”1”,
```
```
"card":"506968XXXXXX1063",
```

©2024 API Guide Page 212 of 313

```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
##### }]


©2024 API Guide Page 213 of 313

## MERCHANT HOSTED RECURRING TRANSACTION FLOW (3D SECURE)

## MERCHANT HOSTED RECURRING TRANSACTION FLOW (3D SECURE)

Recurring Billing API methods enable merchant user to manage regular subscription

payments.

### Request - Payment Token Generation API

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanum All the below request parameters encrypted and pass
the encrypted value in trandata.
3 responseURL M Alphanum The merchant success URL where Payment Gateway
send the notification request.
4 errorURL M Alphanum Merchant error URL
```
```
Detailed description of Plain trandata request parameters
```
```
S.No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
3 password M Alphanum Tranportal password. Merchant download the
same in merchant portal.
```
```
4 id M Alphanum Tranportal ID. Merchant download the same in
merchant portal
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields. The field
data passed along with a transaction request and
then returned in the transaction response.
```

©2024 API Guide Page 214 of 313

```
S.No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
Merchant should ensure that field left blank when
no data needs to be passed.
```
```
8 udf2 O Alphanum The user (merchant) defines these fields. The field
data passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field left blank when
no data needs to be passed.
9 udf3 O Alphanum The user (merchant) defines these fields. The field
data passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field left blank when
no data needs to be passed.
10 udf5 O Alphanum The user (merchant) defines these fields. The field
data passed along with a transaction request and
then returned in the transaction response.
Merchant should ensure that field is left blank
when no data needs to be passed.
11 responseURL M Alphanum The merchant success URL where Payment
Gateway send the notification request.
```
```
12 errorURL M Alphanum The merchant error URL where Payment Gateway
send the response in case any error while
Processing the transaction.
13 expYear M Numeric Expiry year of card
```
```
14 expMonth M Numeric Expiry month of card
```
```
15 member M Alphanum Card holder name
```
```
16 cvv2 M Numeric CVV of the card
```
```
17 cardNo M Numeric Cardholders card number
```
```
18 cardType M Alphanum Card type Ex : Credit card – C, Debit Card – D
```
19 browserLanguage M (^) Alphanu
m
Value representing the browser language
Returned from "navigator.language" property.
Length 1 to 8 characters.
20 browserColorDept
h
M (^) Alphanu
m
Value representing the bit depth of the colour
palette for displaying images, in bits per pixel.
Obtained from Cardholder browser using the
"screen.colorDepth" property. Length 1 to 2
characters.
Values Accepted :


©2024 API Guide Page 215 of 313

```
S.No Fields
```
##### M/C

##### /O

```
Field Type Description
```
```
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits
21 browserScreenHei
ght
```
M (^) Alphanu
m
Total height of the Cardholder’s screen in pixels.
Value is returned from the screen.height property.
Length 1 to 6 characters.
22 browserScreenWid
th
M (^) Alphanu
m
Total width of the cardholder’s screen in pixels.
Value is returned from the screen.width property.
Length 1 to 6 characters.
23 browserJavaEnabl
ed
M (^) Alphanu
m
Value is returned from the navigator.javaEnabled
property. Boolean value.
24 browserTZ M (^) Alphanu
m
Time difference between UTC time and the
Cardholder browser local time, in minutes. Value is
returned from the getTimezoneOffset() method.
Length 1 to 5 characters.
25 jsEnabled M (^) Alphanu
m
Value whether the java script is enabled in browser
or not.
**Request from Merchant to ARB Payment gateway:**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”,
"responseURL":"https://merchantpage/PaymentResult.jsp",
"errorURL":"https://merchantpage/PaymentResult.jsp"
}]


©2024 API Guide Page 216 of 313

```
Plain Trandata
```
```
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource key.
```
```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase , 4 - Authorization
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```
```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```

©2024 API Guide Page 217 of 313

```
"jsEnabled":"true",
```
```
”udf1”:” 1 ”, //To identify Recurring based transactions
```
```
”udf2”:”SI”, //To identify Recurring based transactions
```
```
//Optional Parameters
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
#### Payout Future

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
S. No Fields M/C/O Field Type Description
```
```
1 accountDetails C
```
##### JSON

```
Array
```
```
Conditional if Merchant Opted for Payout
future.
Split Payment or Payout Details.
```
```
2 bankIdCode C Alphanu
m
```
```
Bank Identification Code
Min - 8
Max - 12
```
```
3 iBanNum C
```
```
Alphanu
m
```
```
IBAN Number
Min - 24
Max - 35
```
```
4 benificiaryNa
me
```
```
C Alphabe
tic
```
```
benificiaryName (English Only)
Max - 100
```
##### 5

```
serviceAmoun
t C^ Numeric^ Service Amount^
```
```
6 valueDate C Numeric Value Date Format: YYYYMMDD
```

©2024 API Guide Page 218 of 313

```
//conditional if Merchant opted for Payout Future.
```
```
"accountDetails":[
```
```
{"bankIdCode": "12345d6f", "iBanNum":
"567896743281926354276254","benificiaryName":"AlRajhi Bank Services",
"serviceAmount":"200.00","valueDate":"2020 12 31" },
```
```
{"bankIdCode": "1234ret3", "iBanNum":
"987656743281926354276254","benificiaryName":"DIGITAL CO",
"serviceAmount":"300.00","valueDate":"202 012 31" }],
```
#### SADAD

```
Detailed description of Plain Trandata request parameters
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
S. No Fields
```
##### M/

##### C/

##### O

```
Field Type Description
```
```
1 transactionType C Alphanum Minimum length : 3 , Maximum length : 15^
Transaction Type Allowed Values 'PAY'
'PAY_SAVE' 'ADVANCE'
'PARTIAL_PAYMENT' 'OVER_PAYMENT'
```
```
2 billerID C Alphanum Minimum length : 1 , Maximum length : 3^
Biller ID
```
```
3 billAmount C Numeric billAmount
```
```
4 billType C Alphanum Minimum length : 7 , Maximum length : 8^
Bill Type. The allowed values are: -
PREPAID : Paid in advance - POSTPAID :
Paid at the end
```
```
5 billNumber C Alphanum Minimum length : 1 , Maximum length : 30^
Bill Number as identified by SADAD
```
```
6 IDType C Alphanum Minimum length : 2 , Maximum length : 2^
ID Type 01 National ID Card 02 Iqama 03
Passport
```
```
7 IDNumber C Alphanum Minimum : 1 , Maximum : 20^
ID Number
```

©2024 API Guide Page 219 of 313

```
//conditional -for SADAD merchant
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billType":"P
OSTPAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
##### }


©2024 API Guide Page 220 of 313

### Initial Response - Payment ID and Payment Page URL

ARB Payment gateway internally validates the request and gives payment ID and payment

page URL in the response if the validation success. If failure then, Error code and description

will be provided.

```
Initial Response from PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then status will be
‘1’. If the validation failed, then status will be ‘2’
```
```
2 result C Alphanu
m
```
```
It contains payment ID and Payment URL if the
validation success else this will be null
3 error C Alphanu
m
```
```
If validation failed, then Payment gateway will provide
the respective error code
4 errorText C Alphanu
m
```
```
If validation failed, then Payment gateway will provide
the respective error description
```
```
Plain Response:
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":" 700212030953264091 :https://securepayments.alrajhibank.com.sa/pg/
TranportalVbv.htm?paymentId=700212030953264091&id=r9Ht8R4U6g9dYtY",
//Payment ID:Payment URL
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```

©2024 API Guide Page 221 of 313

```
“errorText”:” Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```
### Framing Payment URL

Merchant needs to frame the payment page URL like the below sample

https://securepayments.alrajhibank.com.sa/pg/TranportalVbv.htm?paymentId=700112030

953264 091&id=r9Ht8R4U6g9dYtYg


©2024 API Guide Page 222 of 313

### Final Response – Transaction Status

Merchant needs to redirects the customer to ARB Payment gateway.

Customer browser will redirect to ACS page and will complete the authentication. PG then process for
authorization with the respective schemes. Once payment response received from respective scheme,

then ARB Payment gateway returns the response to merchant. This is URL redirection. Below is sample
response from ARB PG to merchant,

```
Final Response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by Payment gateway.
Merchant can store the payment ID to match the
final URL redirection response
2 trandata C Alphanu
m
```
```
All the below response parameters encrypted
and send the encrypted value in trandata
Ex:
[{“paymentId”:100201935166676976,”
result”:”CAPTURED”,”ref”:”93511000
0001”,”transId”:201935166561122,”d
ate”:1217,”trackId”:”1003383844”,”
udf1”:””,”udf2”:””,”udf3”:”8870091
137”,”udf
```
```
4”:”FC”,”udf5”:”Tidal5”,”amt”:”70.0,”authResp
Code”,”00”}]
3 error C Numeric If any error, PG will provide the error code
```
```
4 errorText C Alphanu
m
```
```
PG will provide the error description if any
transaction declined.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway.
Based on this payment Id merchant can
match the final URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status. Value will be 'CAPTURED'
for purchase successful and 'APPROVED' for
authorization successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```

©2024 API Guide Page 223 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment
gateway and merchant can use this id for
initiating supported transactions (Void,
refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field
is left blank when no data needs to be
passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field
is left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field
is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field
is left blank when no data needs to be
passed.
```
```
11 amt M Numeric Transaction amount
```
```
12 authRespCode M Numeric Auth response code provided by PG
```
```
13 authCode M Numeric 6 digit authorization code received^ from
switch
```
```
14 cardType M Alphabetic Card Brand name. Value will be "Visa" or "MasterCard" or "Mada".
```
```
15 custid^ M Alphanum Customer ID needs to be sent in the
subsequent Merchant Initiating recurring
transactions
```
```
16 actionCode M Alphanum Action code of transaction. Possible
Values
1 - Purchase
```

©2024 API Guide Page 224 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
Sample JSON Response - Final
```
```
Redirection Parameters
```
```
 “paymentId”:” 100201935044735860 ”,
```
```
 "trandata": "<encrypted trandata>",
```
```
 “Error”:””,
```
```
 “ErrorText”:””
```
```
Plain Trandata
```
```
[{“paymentId”:” 100201935044735860 ”,
```
```
”result”: ”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:1221,
```
```
”ref”:”935110000001”,-
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```

©2024 API Guide Page 225 of 313

```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ",
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“custid”:”202014785236784”,
```
```
“actionCode”:”1”
```
```
}]
```

©2024 API Guide Page 226 of 313

**Recurring Payment for MADA – Merchant**

## PAGE URL RECURRING PAYMENT FOR MADA – MERCHANT INITIATED INITIAL RESPONSE - PAYMENT ID AND PAYMENT

**Payment Page URL**

Merchant forwards the API request to ARB Payment gateway, below is sample request.

### Request

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields M/C/O Field Type Description
```
```
1 id M Alphanu
m
```
```
Tranportal ID. Merchant can download the Tranportal id
from Merchant portal
```
```
2 trandata M Alphanu
m
```
```
All the below request parameters encrypted and pass the
encrypted value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S. No Fields M/C/O Field Type Des c ription
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
Authorization:4
```
```
3 password M Alphanu
m
```
```
Tranportal password. Merchant download the same in
merchant portal.
```
```
4 id M Alphanu
m
```
```
Tranportal ID. Merchant download the same in merchant
portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 227 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
```
8 udf2 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 cardType M Alphanu
m
```
```
Card type Ex : Credit card – C, Debit Card – D
```
```
12 browserLangu
age
```
M (^) Alphanu
m
Value representing the browser language Returned from
"navigator.language" property. Length 1 to 8 characters.
13 browserColor
Depth
M (^) Alphanu
m
Value representing the bit depth of the colour palette for
displaying images, in bits per pixel. Obtained from
Cardholder browser using the "screen.colorDepth"
property. Length 1 to 2 characters.
Values Accepted :
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits
14 browserScree
nHeight
M (^) Alphanu
m
Total height of the Cardholder’s screen in pixels. Value is
returned from the screen.height property. Length 1 to 6
characters.
15 browserScree
nWidth
M (^) Alphanu
m
Total width of the cardholder’s screen in pixels. Value is
returned from the screen.width property. Length 1 to 6
characters.
16 browserJavaE
nabled
M (^) Alphanu
m
Value is returned from the navigator.javaEnabled
property. Boolean value.


©2024 API Guide Page 228 of 313

```
S. No Fields M/C/O Field Type Des c ription
```
17 browserTZ M (^) Alphanu
m
Time difference between UTC time and the Cardholder
browser local time, in minutes. Value is returned from the
getTimezoneOffset() method. Length 1 to 5 characters.
18 jsEnabled M (^) Alphanu
m
Value whether the java script is enabled in browser or
not.
**Below is the sample encrypted request from Merchant to PG**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”
}]
**Below are the plain Trandata request**

##### [{

```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”,
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”cardType”:”C",
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```

©2024 API Guide Page 229 of 313

```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```
```
"jsEnabled":"true",
```
```
”udf1”:”1”, //To identify Merchant Initiated Recurring transaction
```
```
”udf2”:”SI”, //To identify Merchant Initiated Recurring transaction
```
```
//Optional Parameters
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```

©2024 API Guide Page 230 of 313

### Response

Once ARB payment gateway verifies the transaction and returns the response to the same

request.

```
Response from ARB Payment Gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 trandata M AlphaNu
m
```
```
All the below response parameters will be provided in
trandata field
```
```
2 error C Alphanu
m
```
```
If any error during processing, PG will provide the error
code
```
```
3 errorText C Alphanu
m
```
```
If any error during processing, PG will provide the error
description
```
```
4 status M Alphanu
m
```
```
If transaction success 1.
If transaction failure 2.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
2 result M Alphanu
m
```
```
Transaction status. Value will be 'CAPTURED' for
purchase successful and 'APPROVED' for authorization
successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment gateway
and merchant can use this id for initiating supported
transactions (Void, refund and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
8 udf2 O
```
```
Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```

©2024 API Guide Page 231 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
9 udf3 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
10 udf5 O Alphanu
m
```
```
The user (merchant) defines these fields. The field data
is passed along with a transaction request and then
returned in the transaction response. Merchant should
ensure that field is left blank when no data needs to be
passed.
```
```
11 amt M Numeric Transaction amount
```
```
12 authRespCode M Numeric Auth response code provided by PG
```
```
13 authCode M Numeric 6 digit authorization code received from switch
```
```
14 cardType M Alphabet
ic
```
```
Card Brand name. Value will be "Visa" or "MasterCard"
or "Mada".
```
```
15 actionCode M Alphanu
meric
```
```
Action code of transaction. Possible Values
1 - Purchase
2 - Credit
3 - Void Purchase
4 - Authorization
5 - Capture
8 - Inquiry
9 - Void Authorization
14 - Authorization Extension(MADA)
```
```
16 card C AlPhanu
meric
```
```
Card Number used for Performing Transaction
```
```
17 expMonth C AlPhanu
meric
```
```
Expiry Month of the Card
```
```
18 expYear C AlPhanu
meric
```
```
Expiry Year of the Card
```
```
Below is the sample encrypted response from PG to Merchant
```
```
[{
```
```
“tranid”: “ 201931951332346 ”,
```

©2024 API Guide Page 232 of 313

```
"trandata": "<encrypted trandata>",
```
```
“status”:”1”, //1 for success transaction, 2 for failure transaction
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Plain trandata in response
```
```
[{
```
```
“paymentId”:-1,
```
```
”result”:”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:” 1221 ”,
```
```
”ref”:”935110000001”,
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ”,
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Visa",
```
```
“actionCode”:”1” ”,
```
```
"card":"506968XXXXXX1063",
```

©2024 API Guide Page 233 of 313

```
"expMonth":"06", //1 – 2 Digits
```
```
"expYear":"2024" //2 – 4 Digits
```
```
}]
```

©2024 API Guide Page 234 of 313

## MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY PSP INTEGRATION)

## MERCHANT HOSTED TRANSACTION FLOW (APPLE PAY PSP INTEGRATION)

```
 For Apple Pay Purchase Transactions Merchant forwards the API request to ARB
Payment gateway below is sample request.
```
```
 Action Code for Purchase Transactions is 1
```
**Below is the sample encrypted request from Merchant to PG**

```
[{
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
**Below are the plain Trandata request**

```
[{
```
```
"password":"OlE34@zAfcR5$2!",
```
```
"trackId":"466418734",
```
```
"amt":"50.00",
```
```
"action":"1",
```
```
"id":"IPAYN6dz0roK9DR",
```
```
"currencyCode":"682",
```
```
"trxnType":"APPLEPAYPSP",
```
```
//conditional-for SADAD merchant.
```
```
"billingDetails" :
```
```
{"IDType":"01","IDNumber":"1072587916","billNumber":"00100100018","billTyp
e":"POST-PAID","billerID":"169","billAmount":5,"transactionType":"ADVANCE"
```
```
}
```

©2024 API Guide Page 235 of 313

```
//Apple Pay Plain Integration
```
```
"applePay" :
```
```
"{"appleCardType":"credit",
```
```
"deviceManufacturerIdentifier":"049510030273",
```
```
"displayName":"Al Rajhi Tradings",
```
```
"appleCurrencyCode":"682",
```
```
"devicePAN":"5453010005456656",
```
```
"tokenExpiryDate":"270127",
```
```
"transactionIdentifier":"F6A7FB5DA676E2EB50C4DDA9DE81A4AF6BE642991A2D382CF
FCADC0FFA5109A0",
```
```
"onlinePaymentCryptogram":"BQFp0OTmAAHWt55aiasnDQABAAA=",
```
```
"paymentDataType":"3DSecure",
```
"eciIndicator":"02",

"network":"MASTERCARD"}"

}]

```
Attributes - Request from Merchant to ARB PG
```
```
S.
No
```
```
Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can
download the Tranportal id from
Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted
value in trandata.
```
```
3 responseURL M Alphanum
```
```
The merchant success URL where
Payment Gateway send the
notification request.
```
```
4 errorURL M Alphanum Merchant error URL
```

©2024 API Guide Page 236 of 313

```
Detailed description of Plain Trandata request parameters
```
```
S.
No
```
```
Fields M/C/O Field Type Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
Authorization: 4
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant
portal.
```
```
4 id M Alphanum
```
```
Tranportal ID. Merchant download
the same in merchant portal
```
```
5 currencyCode M Numeric
```
```
3 - digit currency code of KSA.
Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed
along with a transaction request
and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed
along with a transaction request
and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed
along with a transaction request
and then returned in the
transaction response. Merchant
```

©2024 API Guide Page 237 of 313

```
should ensure that field is left
blank when no data needs to be
passed.
```
```
10 udf4 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed
along with a transaction request
and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these
fields. The field data is passed
along with a transaction request
and then returned in the
transaction response. Merchant
should ensure that field is left
blank when no data needs to be
passed.
```
```
12 responseURL M Alphanum
```
```
The merchant success URL where
Payment Gateway send the
notification request.
```
```
13 errorURL M Alphanum
```
```
The merchant error URL where
Payment Gateway send the
response in case any error while
processing the transaction.
```
```
14 langid O Alphabetic
```
```
Language ID. Based on language
ID arabic language will be
displayed on payment page. Value
should be 'ar' or 'AR' for arabic
language.
```
```
15 billingDetails C JSON Object
```
```
SADAD Billing Details
Mandatory for SADAD Bill Pay
Transaction
```
```
16 trxnType C String
```
```
All the Apple Pay PSP transactions
should send “APPLEPAYPSP” to
identify the Apple based
transactions.
Mandatory for Merchant Hosted
Apple Pay PSP Transaction.
```

©2024 API Guide Page 238 of 313

```
17 applePay C JSON String
```
```
To send the Apple Pay transaction
Information for Plain transaction
Mandatory for Merchant Hosted
Apple Pay PSP Transaction
```
```
Detailed description of billingDetails request parameters
```
```
S.
```
```
No
```
```
Fields M/C/O
```
```
Field
```
```
Type
```
```
Description
```
```
1 transactionType C Alphanum Transaction Type.^
Minimum length: 3, Maximum
length: 15
Allowed Values
'PAY'
'PAY_SAVE'
'ADVANCE'
'PARTIAL_PAYMENT'
'OVER_PAYMENT'
```
```
2 billerID C Alphanum Biller ID.^
Minimum length: 1, Maximum
length: 3.
```
```
3 billAmount C Numeric Billing Amount
```
```
4 billType C Alphanum Bill Type.^
Minimum length: 7, Maximum
length: 8.
The allowed values are:
```
- PREPAID: Paid in advance
- POSTPAID: Paid at the end

```
5 billNumber C Alphanum Bill Number as identified by
SADAD.
Minimum length: 1, Maximum
length: 30.
```
```
6 IDType C Alphanum ID Type^
Minimum length: 2, Maximum
length: 2.
01 - National ID Card
02 - Iqama
03 - Passport
```
```
7 IDNumber C Alphanum Minimum:^ 1,^ Maximum:^20
```

©2024 API Guide Page 239 of 313

```
ID Number
```
```
Detailed description of applePay JSON request parameters
```
##### S.

```
No Fields^ M/C/O^
```
```
Field
Type Description^
```
```
1 network M String Network Information
received from Apple
```
```
2 displayName C String Display Name received from
Apple
```
```
3 appleCardType M String
```
```
Card Type received from
Apple received from Ap-ple
```
```
4 devicePAN M String
```
```
Device PAN received from
Apple after decrypting the
PayLoad
```
```
5 tokenExpiryDate M String
```
```
Token Expiry Date received
from Apple after de-crypting
the PayLoad
```
```
6 eciIndicator M String
```
```
ECI Indicator received from
Apple after decrypting the
PayLoad
```
```
7 onlinePaymentCryptogram M String
```
```
Online payment cryptogram
received from Apple after
decrypting the PayLoad
```
```
8 paymentDataType M String
```
```
Payment Data Type received
from Apple after de-crypting
the PayLoad
```
```
9 deviceManufacturerIdentifier M String
```
```
Device Manufacturing
Identifier received from Ap-
ple after decrypting the
PayLoad
```
```
10 transactionIdentifier M String Transaction Identifier
received from the Apple
```
##### 11

```
appleCurrencyCode M String
```
```
Currency Code received from
Apple
```

©2024 API Guide Page 240 of 313

## JS WIDGET INTEGRATION

## JS WIDGET INTEGRATION

_Refer Document “_ **_ARB Payment Gateway REST API Merchant JS Widget_**

**_Integration_V1.0.pdf_** _”_


©2024 API Guide Page 241 of 313

## MERCHANT HOSTED TRANSACTION FLOW (CREDIT CARD INSTALLMENT INTEGRATION)

## MERCHANT HOSTED TRANSACTION FLOW (CREDIT CARD INSTALLMENT INTEGRATION)

```
 To Offer credit card installment, the merchant must first retrieve the available
installment options from the ARB Payment Gateway. Then, the merchant initiates a
purchase transaction with the selected installment plan through an API Request to ARB
Payment gateway.
```
```
 Action Code for Purchase Transactions is 1.
```
### Initial - Get Installment Plans

```
Retreive the available installment options for a credit card from the ARB Payment
Gateway.
```
```
Endpoint - UAT
```
```
https://securepayments.alrajhibank.com.sa/pg/payment/getInstallment.htm
```
#### Request - Get Installment Plans

```
Attributes - Request from Merchant to ARB PG
```
```
S.
No
```
```
Fields M/C/O Field Type Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can
download the Tranportal id from
Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted
value in trandata.
```
```
Detailed description of Plain Trandata request parameters
```
```
S.
No
```
```
Fields M/C/O Field Type Description
```

©2024 API Guide Page 242 of 313

```
1 id M Alphanum
```
```
Tranportal ID. Merchant download
the same in merchant portal
```
```
2 password M Alphanum
```
```
Tranportal password. Merchant
download the same in merchant
portal.
```
```
3 trackId M Numeric Merchant unique reference no
```
```
4 amt M Numeric Transaction amount
```
```
5 currencyCode M Numeric
```
```
3 - digit currency code of KSA.
Ex:682
```
```
6 cardNo M Numeric Cardholder’s credit card number
```
**Below is the sample encrypted request from Merchant to PG**

```
[{
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
**Below are the plain Trandata request**

```
[{
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
"password":"OlE34@zAfcR5$2!",
```
```
"trackId":"466418734",
```
```
"amt":" 100 0.00",
```
```
"currencyCode":"682",
```
```
"cardNo":"5453********5539"
```
}]


©2024 API Guide Page 243 of 313

#### Response - Get Installment Plans

```
Once ARB payment gateway verifies the transaction and returns the response to the same
request.
```
```
Response from ARB Payment Gateway to Merchant
```
```
S. No Fields
```
```
M/C/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
1 trandata M AlphaN
um
```
```
All the below response parameters will be provided
in trandata field
```
```
2 id
M
```
```
Alphanu
m
```
```
Tranportal ID.
```
```
3 error C Alphanu
m
```
```
If any error during processing, PG will provide the
error code
```
```
4 errorText C Alphanu
m
```
```
If any error during processing, PG will provide the
error description
```
```
5 status M Alphanu
m
```
```
If any error during processing, PG will provide the
error status as 2.
```
```
Detailed description of Plain trandata response parameters
```
```
S. No Fields
```
```
M/C/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
1 trackId M
```
```
Numeri
c
```
```
Merchant unique reference no
```
```
2 amt M
```
```
Numeri
c
```
```
Transaction amount
```
```
3 currencyCode M
```
```
Numeri
c
```
```
3 - digit currency code of KSA. Ex:682
```
```
4 cardNo
```
```
M Numeri
c
```
```
Cardholder’s credit card number
```
```
5 installmentPlans M
```
```
Json
Array
```
```
Installment Plans
```
```
Detailed description of installmentPlans response parameters
```

©2024 API Guide Page 244 of 313

```
S.
```
```
No
```
```
Fields M/C/O
```
```
Field
```
```
Type
```
```
Description
```
```
1 numinstalments M Numeric Number of Installments. This
value should be passed in
transaction under udf7 on
selection of this installment.
```
```
2 instalmentAmount M Numeric Installment Amount^
```
```
3 shortcode M Alphanum Installment Short Code. This
value should be passed along
with Number of Installments in
transaction under udf7 on
selection of this installment.
```
```
4 instalmenttype M Alphanum Installment Type^
```
**Below is the sample encrypted response from PG to Merchant**

```
Failure
```
```
[{
```
```
"status": "2",
```
```
"error": "IPAY0700002”,
```
```
"errorText": "!ERROR!-IPAY0700002-Credit instalment is not applicable for
this bin."
```
```
}]
```
```
Success
```
```
[{
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”
```
```
}]
```
**Below are the plain Trandata response**

```
[{
```

©2024 API Guide Page 245 of 313

```
"id":"IPAYlCR6qZF7q6w",
```
```
"trackId":"466418734",
```
```
"amt":" 100 0.00",
```
```
"currencyCode":"682",
```
```
"cardNo":"5453********5539",
```
```
"installmentPlans":
[{"numinstalments":" 12 ","instalmentAmount":" 83. 33 ","shortcode":"T001","ins
talmenttype":" 12 "},
{"numinstalments":" 6 ","instalmentAmount":"166.67","shortcode":"T002","inst
almenttype":" 6 "}]
```
```
}]
```
### Merchant Hosted Credit Card Installment Transaction

```
Credit card installment purchase transactions to subscribe the regular installment
payments post selection of installment plan by customer from merchant payment page.
```
```
Endpoint - UAT
```
```
https://securepayments.alrajhibank.com.sa/pg/payment/tranportal.htm
```
#### Request - Payment Token Generation API

```
Request from Merchant to ARB payment gateway
```
```
S. No Fields
```
```
M/
```
```
C/O
```
```
Field
```
```
Type
```
```
Description
```
```
1 id M Alphanum Tranportal ID. Merchant can download the
Tranportal id from Merchant portal
2 trandata M Alphanum All the below request parameters encrypted and
pass the encrypted value in trandata.
3 responseURL M Alphanum The merchant success URL where Payment
Gateway send the notification request.
4 errorURL M Alphanum Merchant error URL
```

©2024 API Guide Page 246 of 313

```
Detailed description of Plain trandata request parameters
```
```
S.No Fields
```
```
M
```
```
/C
```
```
/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric It defines the transactions actions
Purchase: 1
3 password M Alphanum Tranportal password. Merchant download
the same in merchant portal.
4 id M Alphanum Tranportal ID. Merchant download the same
in merchant portal
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field left blank when no data
needs to be passed.
8 udf2 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field left blank when no data
needs to be passed.
9 udf3 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field left blank when no data
needs to be passed.
10 udf4 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field left blank when no data
needs to be passed.
```

©2024 API Guide Page 247 of 313

```
S.No Fields
```
```
M
```
```
/C
```
```
/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
11 udf5 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
12 udf6 O Alphanum Default value should be passed as “ CI ” to
identify the credit card installment
transactions
13 udf7 O Alphanum Credit Installment Short Code and Credit
Installment Months with an underscore
separator needs to be passed in the
request.
Example: T001_12 wherease T001 –
Credit Installment Short Code and 12 –
Number of Installments. These values
should be passed when udf6 passed as CI
and also Short code and number of
installments should be passed from
Installment Plan which has been selected by
customer.
14 udf8 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field left blank when no data
needs to be passed.
15 udf9 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
16 udf10 O Alphanum The user (merchant) defines these fields.
The field data passed along with a
transaction request and then returned in
the transaction response. Merchant should
ensure that field is left blank when no data
needs to be passed.
17 responseURL M Alphanum The merchant success URL where Payment
Gateway send the notification request.
```

©2024 API Guide Page 248 of 313

```
S.No Fields
```
```
M
```
```
/C
```
```
/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
18 errorURL M Alphanum The merchant error URL where Payment
Gateway send the response in case any
error while Processing the transaction.
19 expYear M Numeric Expiry year of card
```
```
20 expMonth M Numeric Expiry month of card
```
```
21 member M Alphanum Card holder name
```
```
22 cvv2 M Numeric CVV of the card
```
```
23 cardNo M Numeric Cardholders card number
```
```
24 cardType M Alphanum Card type Ex : Credit card – C, Debit Card
```
- D
25 browserLanguage M Alphanum Value representing the browser language
Returned from "navigator.language"
property. Length 1 to 8 characters.
26 browserColorDep
th

M Alphanum (^) Value representing the bit depth of the
colour palette for displaying images, in bits
per pixel. Obtained from Cardholder browser
using the "screen.colorDepth" property.
Length 1 to 2 characters.
Values Accepted:
1 = 1 bit
4 = 4 bits
8 = 8 bits
15 = 15 bits
16 = 16 bits
24 = 24 bits
32 = 32 bits
48 = 48 bits
27 browserScreenHe
ight
M Alphanum (^) Total height of the Cardholder’s screen in
pixels. Value is returned from the
screen.height property. Length 1 to 6
characters.


©2024 API Guide Page 249 of 313

```
S.No Fields
```
```
M
```
```
/C
```
```
/
```
```
O
```
```
Field
```
```
Type
```
```
Description
```
```
28 browserScreenWi
dth
```
M Alphanum (^) Total width of the cardholder’s screen in
pixels. Value is returned from the
screen.width property. Length 1 to 6
characters.
29 browserJavaEnab
led
M Alphanum (^) Value is returned from the
navigator.javaEnabled property. Boolean
value.
30 browserTZ M Alphanum (^) Time difference between UTC time and the
Cardholder browser local time, in minutes.
Value is returned from the
getTimezoneOffset() method. Length 1 to 5
characters.
31 jsEnabled M Alphanum (^) Value whether the java script is enabled in
browser or not.
**Request from Merchant to ARB Payment gateway:**
[{
//Mandatory Parameters
"id":"IPAYlCR6qZF7q6w",
“trandata”:”<encrypted trandata>”,
"responseURL":"https://merchantpage/PaymentResult.jsp",
"errorURL":"https://merchantpage/PaymentResult.jsp"
}]
**Plain Trandata**
Trandata will contain below parameters encrypted with AES algorithm with CBC Mode,
PKCS5Padding with initialization vector value **PGKEYENCDECIVSPC** under Resource key.


©2024 API Guide Page 250 of 313

```
[{
```
```
//Mandatory Parameters
```
```
“amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”expYear”:”2022”,
```
```
”expMonth”:”12”,
```
```
”member”:”cardholdername”,
```
```
”cvv2”:”212”,
```
```
”cardNo”,”5453********5539”,
```
```
”cardType”:”C”,
```
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
”errorURL”:”https://merchantpage/PaymentResult.jsp”,
```
```
"browserJavaEnabled":"true",
```
```
"browserLanguage":"en",
```
```
"browserColorDepth":"48",
```
```
"browserScreenHeight":"400",
```
```
"browserScreenWidth":"600",
```
```
"browserTZ":"0",
```
```
"jsEnabled":"true",
```
```
//Optional Parameters
```

©2024 API Guide Page 251 of 313

```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
//Mandatory Parameters for Credit Installment
```
```
”udf 6 ”:”CI”, //To Identify Credit Card Installment Transaction
```
```
”udf 7 ”:”T001_12”, //Selected Installment Plan (i.e., shortcode_
numinstalments)
```
```
//Optional Parameters
```
```
”udf 8 ”:”udf 8 text”,
```
```
”udf 9 ”:”udf 9 text”,
```
```
”udf 10 ”:”udf 10 text”
```
```
}]
```
#### Initial Response - Payment ID and Payment Page URL

```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response if the validation success. If failure then, Error code and
description will be provided.
```
```
Initial Response from PG to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 status M Numeric If the request validation success, then status will
be ‘1’. If the validation failed, then status will be ‘2’
```
```
2 result C Alphanum It contains payment ID and Payment URL if the
validation success else this will be null
3 error C Alphanum If validation failed, then Payment gateway will
provide the respective error code
```

©2024 API Guide Page 252 of 313

```
S. No Fields M/C/O Field Type Description
```
```
4 errorText C Alphanum If validation failed, then Payment gateway will
provide the respective error description
```
```
Plain Response:
```
```
Success:
```
```
[{
```
```
"status": "1",
```
```
"result":" 700212030953264091 :https://securepayments.alrajhibank.com.sa/pg/
TranportalVbv.htm?paymentId=700212030953264091&id=r9Ht8R4U6g9dYtY",
//Payment ID:Payment URL
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Failure:
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”:” Problem occurred while validating transaction data”,
```
```
“result”: null
```
```
}]
```

©2024 API Guide Page 253 of 313

#### Framing Payment URL

```
Merchant needs to frame the payment page URL like the below sample
```
```
https://securepayments.alrajhibank.com.sa/pg/TranportalVbv.htm?paymentId=7001120
30953264091&id=r9Ht8R4U6g9dYtYg
```
#### Final Response – Transaction Status

```
Merchant needs to redirects the customer to ARB Payment gateway.
```
```
Customer browser will redirect to ACS page and will complete the authentication. PG then process
for authorization with the respective schemes. Once payment response received from respective
scheme, then ARB Payment gateway returns the response to merchant. This is URL redirection.
Below is sample response from ARB PG to merchant,
```
```
Final Response from ARB payment gateway to Merchant
```
```
S. No Fields M/C/O Field Type Description
```
```
1 paymentId M Numeric Unique ID generated by Payment gateway.
Merchant can store the payment ID to match
the final URL redirection response
```
2 trandata C Alphanum (^) All the below response parameters encrypted
and send the encrypted value in trandata
Ex:
[{“paymentId”:100201935 166676976
,”result”:”CAPTURED”,”ref”:”9351
10000001”,”transId”:201935166561
122,”date”:1217,”trackId”:”10033
83844”,”udf1”:””,”udf2”:””,”udf3
”:”8870091137”,”udf
4”:”FC”,”udf5”:”Tidal5”,”amt”:”70.0,”authRes
pCode”,”00”}]
3 error C Numeric If any error, PG will provide the error code
4 errorText C Alphanum PG will provide the error description if any
transaction declined.
**Detailed description of Plain trandata response parameters**


©2024 API Guide Page 254 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
1 paymentId M Numeric
```
```
Unique ID generated by payment gateway.
Based on this payment Id merchant can match
the final URL redirection response
```
```
2 result M Alphanum
```
```
Transaction status. Value will be 'CAPTURED'
for purchase successful and 'APPROVED' for
authorization successful.
```
```
3 ref M Numeric Transaction reference number (RRN)
```
```
4 transId M Numeric
```
```
Unique transaction Id generated by Payment
gateway and merchant can use this id for
initiating supported transactions (Void, refund
and inquiry)
```
```
5 date M Numeric Transaction date and time
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
8 udf2 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
9 udf3 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
10 udf4 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
11 udf5 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
12 udf 6 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
13 udf 7 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
```

©2024 API Guide Page 255 of 313

```
S. No Fields
```
##### M/C/

##### O

```
Field Type Description
```
```
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
14 udf 8 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
15 udf 9 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
16 udf 10 O Alphanum
```
```
The user (merchant) defines these fields. The
field data is passed along with a transaction
request and then returned in the transaction
response. Merchant should ensure that field is
left blank when no data needs to be passed.
```
```
17 amt M Numeric Transaction amount
```
```
18 authRespCode M Numeric Auth response code provided by PG
```
```
19 authCode M Numeric 6 digit authorization code received from switch
```
```
20 cardType M Alphabetic Card Brand name. Value will be "Visa" or
"MasterCard" or "Mada".
```
```
21 actionCode M Alphanu
m
```
```
Action code of transaction. Possible Values
1 - Purchase
Sample JSON Response - Final
```
```
Redirection Parameters
```
```
 “paymentId”:” 100201935044735860 ”,
```
```
 "trandata": "<encrypted trandata>",
```
```
 “Error”:””,
```
```
 “ErrorText”:””
```
```
Plain Trandata
```
```
[{“paymentId”:” 100201935044735860 ”,
```

©2024 API Guide Page 256 of 313

```
”result”: ”CAPTURED”,
```
```
”amt”:”10.55”,
```
```
”date”:1221,
```
```
”ref”:”935110000001”,-
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```
```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
”udf 6 ”:”CI”,
```
```
”udf 7 ”:”T001_12”,
```
```
”udf 8 ”:”udf 8 text”,
```
```
”udf 9 ”:”udf 9 text”,
```
```
”udf 10 ”:”udf 10 text”,
```
```
”trackId”,”3423423”,
```
```
”transId”:” 1242345345234 ",
```
```
“authRespCode”:”00”,
```
```
"authCode":"000000",
```
```
"cardType":"Mastercard",
```
```
“actionCode”:”1”
```
```
}]
```

©2024 API Guide Page 257 of 313

## BEST PRACTICES

## BEST PRACTICES

a) The Merchant should mandatorily maintain logs for each transaction as

mentioned below

```
a. The parameters before setting the values in the respective variable.
b. Request from the merchant server to Payment Gateway
```
c. Response that is received from the Payment Gateway in the Merchant

Response URL

b) The Merchant should maintain "OWASP" (Open Web Application Security

Project) Top 10 recommendation in their web application. (These

recommendations are available on [http://www.owasp.org)](http://www.owasp.org))

c) The Merchant should have the latest SSL security certificate in the payment

request and receive webpage, if any. Always ensure that the SSL certificate

```
is valid and has not expired. Such certificates should be as per the approved
list of the Acquiring Bank. Self singed certificates are not supported by
```
Payment Gateway in Test and Production Environment.

d) The Merchant should mandatory complete the UAT and ensure all results

are in line with the recommended response prior to going LIVE.

e) Any changes in the pages would need to be tested before moving to

Production after proper communication to the Bank personnel and receipt

of approval. If the pages have a change in logic or transaction flow

particularly, the Acquiring Bank’s consent is Mandatory.

f) The transaction request and Response Handling: For ease in integration,

“Sample/Demo pages “provided in the integration document are essentially

for representation purposes only. The actual pages have to be necessarily

developed and implemented by the Merchant’s development team and used

```
in both the Test and Production environment. The Sample demo pages are
provided for the logical understanding and transaction flow only. An ideal
```
logical flow for the merchant to process the customer input data is to collect

the shopping details of the customer such as transaction amount, merchant

track id and other parameters and stored in a secure storage location and

validated immediately against the details of shopping cart module.

g) Maintenance of Transaction Logs: It is essential for the transaction logs to

be maintained in a secure storage location within the environment. This is

crucial in order to trace transaction history in case of a dispute raised by a


©2024 API Guide Page 258 of 313

customer or even internal audit purposes. These logs should ideally include

the customer IP address as well apart from the other transaction details.


©2024 API Guide Page 259 of 313

## PRIVATE AND PUBLIC KEY

## PRIVATE AND PUBLIC KEY

**-** If Merchant opted for private and public key future. ARBPG provide two keys for
    encrypting and decrypting the request and response respectively.
**-** Purchase Transaction: Key 1 should be used for encrypting the Request. Key 2 should
    be used for decrypting the response from payment gateway.
**-** Supporting transaction: Inquiry, Refund and Reversal transactions should be done by
    key 2 only i.e Key 2 should be used for encrypting and decrypting the request and
    response respectively from Payment Gateway._Toc 31220960


©2024 API Guide Page 260 of 313

## SETTING UP YOUR SERVER

## SETTING UP YOUR SERVER

**Overview**

 All pages that include Apple Pay must be served over HTTPS.

 Your domain must have a valid SSL certificate.

```
 Your server must support the Transport Layer Security (TLS) 1.2 protocol and
one of the cipher suites listed below.
```
```
TLS_RSA_WITH_AES_128_CBC_SHA256
TLS_RSA_WITH_AES_128_GCM_SHA256
TLS_DHE_RSA_WITH_AES_128_CBC_SHA256
TLS_DHE_RSA_WITH_AES_128_GCM_SHA256
TLS_ECDHE_RSA_WITH_AES_128_CBC_SHA
TLS_ECDHE_RSA_WITH_AES_128_CBC_SHA256
TLS_ECDHE_RSA_WITH_AES_128_GCM_SHA256
```
**Whitelist Apple Pay IP Addresses for Merchant Validation**

```
 To enable merchant validation and receive a session object, your server must
allow access over HTTPS (TCP over port 443) to the Apple Pay IP addresses
and domains provided below
```
```
For production environment:
Domain apple-pay-gateway.apple.com
17.171.78.7 apple-pay-gateway-nc-pod1.apple.com
17.171.78.71 apple-pay-gateway-nc-pod2.apple.com
17.171.78.135 apple-pay-gateway-nc-pod3.apple.com
17.171.78.199 apple-pay-gateway-nc-pod4.apple.com
17.171.79.12 apple-pay-gateway-nc-pod5.apple.com
17.141.128.7 apple-pay-gateway-pr-pod1.apple.com
17.141.128.71 apple-pay-gateway-pr-pod2.apple.com
17.141.128.135 apple-pay-gateway-pr-pod3.apple.com
17.141.128.199 apple-pay-gateway-pr-pod4.apple.com
17.141.129.12 apple-pay-gateway-pr-pod5.apple.com
```

©2024 API Guide Page 261 of 313

```
17.171.78.9 apple-pay-gateway-nc-pod1-dr.apple.com
17.171.78.73 apple-pay-gateway-nc-pod2-dr.apple.com
17.171.78.137 apple-pay-gateway-nc-pod3-dr.apple.com
17 .171.78.201 apple-pay-gateway-nc-pod4-dr.apple.com
17.171.79.13 apple-pay-gateway-nc-pod5-dr.apple.com
17.141.128.9 apple-pay-gateway-pr-pod1-dr.apple.com
17.141.128.73 apple-pay-gateway-pr-pod2-dr.apple.com
17.141.128.137 apple-pay-gateway-pr-pod3-dr.apple.com
17.141.128.201 apple-pay-gateway-pr-pod4-dr.apple.com
17.141.129.13 apple-pay-gateway-pr-pod5-dr.apple.com
101.230.204.232 cn-apple-pay-gateway-sh-pod1.apple.com
101.230.204.233 cn-apple-pay-gateway-sh-pod1-dr.apple.com
101.230.204.242 cn-apple-pay-gateway-sh-pod2.apple.com
101.230.204.243 cn-apple-pay-gateway-sh-pod2-dr.apple.com
101.230.204.240 cn-apple-pay-gateway-sh-pod3.apple.com
101.230.204.241 cn-apple-pay-gateway-sh-pod3-dr.apple.com
60.29.205.104 cn-apple-pay-gateway-tj-pod1.apple.com
60.29.205.105 cn-apple-pay-gateway-tj-pod1-dr.apple.com
60.29.205.106 cn-apple-pay-gateway-tj-pod2.apple.com
60.29.205.107 cn-apple-pay-gateway-tj-pod2-dr.apple.com
60.29.205.108 cn-apple-pay-gateway-tj-pod3.apple.com
60.29.205.109 cn-apple-pay-gateway-tj-pod3-dr.apple.com
```
```
For sandbox testing only:
17.171.85.7 apple-pay-gateway-cert.apple.com
101.230.204.235 cn-apple-pay-gateway-cert.apple.com
```
**Whitelist Apple IP Addresses for Domain Verification**

```
 Apple uses the following IP addresses when you register or verify your
merchant domain. If your domain is protected from public access and you
wish to complete domain verification, you should whitelist the following IP
address ranges.
```
```
17.32.139.128/27
17.32.139.160/27
17.140.126.0/27
17.140.126.32/27
```

©2024 API Guide Page 262 of 313

```
17.179.144.128/27
17.179.144.160/27
17.179.144.192/27
17.179.144.224/27
17.253.0.0/16
```

©2024 API Guide Page 263 of 313

## APPLE PAY PROCESS FOR MERCHANT REGISTRATION AND CERTIFICATES

## APPLE PAY PROCESS FOR MERCHANT REGISTRATION AND CERTIFICATES

**Create a merchant identifier**

```
 In Certificates, Identifiers & Profiles, select Identifiers from the sidebar, then
click the Add button (+) in the upper-left corner.
```
 Select Merchant IDs, then click Continue.

 Enter the merchant description and identifier name, then click Continue.

 Review the settings, then click Register.

**Create a payment processing certificate**

 In Certificates, Identifiers & Profiles, select Identifiers from the sidebar.

 Under Identifiers, select Merchant IDs using the filter in the top-right.

 On the right, select your merchant identifier.

 Under Apple Pay Payment Processing Certificate, click Create Certificate.

 Click Choose File.

 Upload the Payment Processing CSR file i.e generated initially

 Click Continue.

 Click Download.

```
 Convert the downloaded .cer file to jks file and save to the .bin file for
payment token decryption process.
```
**Merchant Domain Verification**


©2024 API Guide Page 264 of 313

 In Certificates, Identifiers & Profiles, select Identifiers from the sidebar.

 Under Identifiers, select Merchant IDs using the filter in the top-right.

 On the right, select your merchant identifier.

 Under Merchant Domains, click Add Domain.

 Enter your domain name and click save.

 Download the apple-developer-merchantid-domain-association.txt file.

```
 Place the downloaded file in the virtual directory of the server to complete
domain validation method using virtual directory.
```
```
 Apple will initiate the request in below format to check the file is present or
not.
```
```
https://www.yourdomain.com/.well-known/apple-developer-merchantid-
domain-association.txt
```
```
Create a merchant identity certificate (This is only required for Bank
hosted integration)
```
```
 In Certificates, Identifiers & Profiles, select Identifiers from the sidebar, then
select Merchant IDs from the pop-up menu on the top right.
```
 On the right, select your merchant identifier.

 Under Apple Pay Merchant Identity Certificate, click Create Certificate.

 Create a certificate signing request on your Mac, and click Continue.

 Click Choose File.

 Upload the Merchant CSR file i.e generated initially

 Click Continue.

 Click Download.


©2024 API Guide Page 265 of 313

```
 Convert the downloaded .cer file to jks file and save to the trustore
and keystore files to perform 2-way TLS handshake.
```

©2024 API Guide Page 266 of 313

## COMMANDS TO GENERATE MERCHANT IDENTITY CERTIFICATE AND PAYMENT PROCESSING CERTIFICATE

## COMMANDS TO GENERATE MERCHANT IDENTITY CERTIFICATE AND PAYMENT PROCESSING CERTIFICATE

**Generating a Merchant Identity Certificate**

```
 Generates a Certificate Signing Request (CSR) for a Merchant Identity
 Certificate per the following (and keeps the private key safely):
a) Command-line tools (either OpenSSL or Keytool can be used)
(i) OpenSSL
```
- Generate key pair in a key file
openssl req -new -newkey rsa:2048 -nodes -out rsacertreq.csr -
    keyout
rsakey.key -subj /CN=www.mydomain.com
(ii) Keytool
- Generate key pair in a pkcs 12 file
keytool -genkeypair -keyalg RSA -keystore rsakeystore.p12 -
    storetype
pkcs12 -keysize 2048 -alias rsakeyname -dname
    CN=www.mydomain.com
- Generate CSR from key pair in pkcs 12 file
keytool -certreq - alias rsakeyname -file rsacertreq.csr -keystore
rsakeystore.p12 -storetype pkcs12
 Then uploads the Merchant Identity Certificate CSR in apple portal.

```
 Download (and backup) the Apple signed Merchant Identity Certificate,
merchant_id.cer
```
```
 Import merchant certificate and private key to generate P12
a) Command-line tools
(i) OpenSSL
```
- convert merchant_id.cer to PEM
openssl x509 -inform DER -in merchant_id.cer -out merchant_id.pem
- Import merchant certificate and private key to generate P 12
openssl pkcs12 -export -out Certificates.p12 -inkey rsakey.key -in
merchant_id.pem

 Convert .p12 file to jks file and save into trustore and keystore file.


©2024 API Guide Page 267 of 313

```
a) Command-line tools
(i) Keytool
keytool -importkeystore -srckeystore Certificates.p12 -srcstoretype
pkcs12 - destkeystore applepaytrustore.bin -deststoretype jks
```
```
 Ensure below mentioned Apple Root and Intermediate certificates are
installed in your truststore to perform 2-way TLS handshake.
Download certificates using below links
https://www.digicert.com/digicert-root-certificates.htm
https://www.apple.com/certificateauthority/
(i) AppleRootCA-G3.cer
(ii) DigiCertGlobalCA-3G2.crt
(iii) DigiCertGlobalRootG2.crt
```
**Generating a Payment Processing Certificate**

```
 Generates a Certificate Signing Request
(CSR) for a Payment Processing Certificate per the following (and keeps the
private key
safely):
a) Command-line tools
(i) OpenSSL
```
- Generate key pair in a key file
openssl ecparam -genkey -name prime256v1 -out ecckey.key
- Generate CSR from key pair in key file
openssl req -new -sha256 -key ecckey.key -out ecccertreq.csr -subj
    /CN=www.mydomain.com
(ii) Keytool
- Generate key pair in a pkcs 12 file
keytool -genkeypair -keyalg EC -keystore ecckeystore.p12 -
    storetype
pkcs12 -keysize 256 -alias ecckeyname -dname
    CN=www.mydomain.com
- Generate CSR from key pair in pkcs 12 file
keytool -certreq -sigalg SHA256withECDSA -alias ecckeyname -file
ecccertreq.csr -keystore ecckeystore.p12 -storetype pkcs12

 Then uploads the Payment Processing Certificate CSR in apple portal.


©2024 API Guide Page 268 of 313

```
 Download (and backup) the Apple signed Payment Processing
Certificate,apple_pay.cer
```
```
 Import payment processing certificate and private key to generate P12
a) Command-line tools
(i) OpenSSL
```
- convert apple_pay.cer to PEM
openssl x509 -inform DER -in apple_pay.cer -out apple_pay.pem
- Import merchant certificate and private key to generate P 12
openssl pkcs12 -export -out ecckeystore.p12 -inkey ecckey.key -in
    apple_pay.pem

```
 Convert .p12 file to jks file and save into .bin file.
a) Command-line tools
(i) Keytool
keytool -importkeystore -srckeystore Certificates.p12 -srcstoretype
pkcs12 - destkeystore applepaytrustore.bin -deststoretype jks
```
## MERCHANT HOSTED URPAY INTEGRATION

## MERCHANT HOSTED URPAY INTEGRATION

Merchant forwards the API request to ARB Payment gateway, below is sample request.

**Attributes - Request from Merchant to ARB PG**

```
S. No Fields M/C/O
```
```
Field
Type
```
```
Description
```
```
1 id M Alphanum
```
```
Tranportal ID. Merchant can download
the Tranportal id from Merchant portal
```
```
2 trandata M Alphanum
```
```
All the below request parameters
encrypted and pass the encrypted value
in trandata.
```
```
3 responseURL M Alphanum
```
```
The merchant success URL where
Payment Gateway send the notification
request.
```
```
4 errorURL M Alphanum Merchant error URL
```

©2024 API Guide Page 269 of 313

**Detailed description of Plain Trandata request parameters**

```
S.
No
```
```
Fields M/C/O
```
```
Field
Type
```
```
Description
```
```
1 amt M Numeric Transaction amount
```
```
2 action M Numeric
```
```
It defines the transactions actions
Purchase: 1
```
```
3 password M Alphanum
```
```
Tranportal password. Merchant can download the
same from the portal.
```
```
4 id M Alphanum Tranportal ID. Merchant can download from the portal
```
```
5 currencyCode M Numeric 3 - digit currency code of KSA. Ex:682
```
```
6 trackId M Numeric Merchant unique reference no
```
```
7 udf1 O Alphanum The user (merchant) defines these fields. The
```
```
8 udf2 O Alphanum The user (merchant) defines these fields. The
```
```
9 udf3 O Alphanum The user (merchant) defines these fields. The
```
```
10 udf4 O Alphanum The user (merchant) defines these fields. The
```
```
11 udf5 O Alphanum The user (merchant) defines these fields. The
```
```
12 responseURL M
Alphanum
```
```
The merchant success URL where Payment
Gateway send the notification request.
```
```
13 errorURL M
Alphanum
```
```
The merchant error URL where Payment Gateway
send the response in case any error while Processing
the transaction.
```
```
14 mobileNumber M
Numeric Contains 9 digit URPAY registered mobile number
```
```
Sample JSON request - Request from Merchant to ARB PG
```
```
[{
```

©2024 API Guide Page 270 of 313

```
//Mandatory Parameters
```
```
"id":"IPAYlCR6qZF7q6w",
```
```
“trandata”:”<encrypted trandata>”, ( encrypted with AES algorithm with CBC Mode)
```
"responseURL":"https://merchantpage/PaymentResult.jsp

", "errorURL":"https://merchantpage/PaymentResult.jsp"

```
}]
```
```
Plain Trandata
```
```
Trandata will contain below parameters
```
```
PKCS5Padding with initialization vector value PGKEYENCDECIVSPC under Resource key.
```
```
[{
```
```
//Mandatory Parameters
```
```
amt”:”12.00”,
```
```
”action”:”1”, // 1 - Purchase
```
```
”password”:”q@a68O$27@JLkcK”,
```
```
”id”:”IPAYlCR6qZF7q6w”,
```
```
”currencyCode”:”682”,
```
```
”trackId”:”123456”,
```
```
”mobileNumber”:”980765432”,
```
”responseURL”:”https://merchantpage/PaymentResult.jsp”,

”errorURL”:”https://merchantpage/PaymentResult.jsp”,

```
//Optional Parameters
```
```
”udf1”:”udf1text”,
```
```
”udf2”:”udf2text”,
```

©2024 API Guide Page 271 of 313

```
”udf3”:”udf3text”,
```
```
”udf4”:”udf4text”,
```
```
”udf5”:”udf5text”,
```
```
}]
```
```
Initial Response from PG to Merchant
```
```
S. No Fields
```
```
M/C/
O
```
```
Field
Type Description
```
```
1 status M
```
```
Numeri
c
```
```
If the request validation success, then status will be
‘1’. If the validation failed, then status will be ‘2’
```
```
2 result C
```
```
Alphanu
m
```
```
It contains payment ID and Payment URL if the
validation success else this will be null
```
```
3 error C
```
```
Alphanu
m
```
```
If validation failed, then Payment gateway will
provide the respective error code
```
```
4 errorText C
```
```
Alphanu
m
```
```
If validation failed, then Payment gateway will
provide the respective error description
```
```
Plain Response
```
```
ARB Payment gateway internally validates the request and gives payment ID and payment
page URL in the response if the validation success. If failure then, Error code and
```
```
description will be provided.
```
```
Success
```
```
[{
```
```
"status": "1",
```

©2024 API Guide Page 272 of 313

```
"result":"700212030953264091:https://securepayments.alrajhibank.com.sa/pg/
```
```
URPaypage.htm", //Payment ID:Payment URL
```
```
“error”:null,
```
```
“errorText”: null
```
```
}]
```
```
Failure
```
```
[{
```
```
"status": "2",
```
```
"error":" IPAY0100124”,
```
```
“errorText”:” Problem occurred while validating transaction data”,
```
```
“result”: null
```
}]

```
Framing Payment URL
```
```
Merchant needs to frame the URL like the below sample
```
```
https://securepayments.alrajhibank.com.sa/pg/URPaypage.htm?PaymentID=7001120309532640
91
```
```
Final Response and Transaction Status
```
```
The ARB payment gateway verifies the transaction and returns the response to the same
request.
```
```
Attribute - Final response from ARB PG to Merchant
```

©2024 API Guide Page 273 of 313

```
S.
No
```
**Fields** (^) **M/C
/O
Field Type Description**
1 trandata M AlphaNum
All the below response parameters
will be provided in trandata field
2 error C Alphanum
If any error during processing, PG
will provide the error code
3 errorText C Alphanum
If any error during processing, PG
will provide the error
4 status M Alphanum
If transaction success 1.
If transaction failure 2.


©2024 API Guide Page 274 of 313

## FAQS ON INTEGRATION PROCESS

## FAQS ON INTEGRATION PROCESS

Q1. What are the pre requisities for integration process?

```
Ans. 1. Tranportal ID
```
2. Tranportal Password
3. Resource Key
4. Payment gateway endpoint

Q2. Where to get tranportal ID , Password , Resource key and end point Url's?

```
Ans. Tranportal Id , Password , Resource Key and end point URL's will be shared to the merchant
via mail to their registered E-mail Id.
```
Q3. What is resource key?

```
Ans. Resource key is unique for a terminal. It is required for encryption of request parameters
and decryption of response paramters while connecting to ARB Payment Gateway. Bank
user will share the resource key in a secured manner.
```
Q4. What is an inquiry transaction?

```
Ans. ARB Payment Gateway allows merchants to do an inquiry of already completed transaction
by passing certain details of the payment message, ARB Payment Gateway provides
response to this request with appropriate fields in the response; merchant is expected to
verify the relevant fields like Transaction amount, transaction status and other transaction
fields.
```
Q5. What are the action codes for inquiry, refunds and Void transactions?

```
Ans. action codes:
```
```
Action Codes
```
```
Action Action code
```
```
Purchase 1
Authorization 4
Refund 2
Inquiry 8
Void 3
Capture 5
Auth Extension 14
```

©2024 API Guide Page 275 of 313

Void Auth 9
Q6. Based on what parameters can transactions be inquired?

```
Ans. Transactions can be inquired based on transaction ID , Payment ID and Track ID of original
transaction.
```
Q7. How to verify transactions and settlement?

```
Ans. After the integration testing, transactions can be verified on merchant Portal
To verify if a transaction has been settled or not merchant can always refer the transaction
detail report in merchant Portal. Navigation to transaction detail report in merchant portal
is as below:
```
```
Merchant Portal ->Reports->Transaction Reports->Transaction Detail Report
```
Q8. What are the various result codes and their description.

```
Ans.
```
```
Result Description
```
```
CAPTURED Captured result will be considered as transaction success
```
```
NOT
CAPTURED
```
```
This will be considered as transaction failure
```
```
APPROVED This will be considered as transaction success for Authorization.
```
```
NOT
APPROVED
```
```
This will be considered as transaction failure for Authorization.
```
```
VOIDED Success for Void transaction
```
```
DENIED BY
RISK
```
```
If the Risk validation failed, then PG will decline the transaction with
this result
```
```
HOST
TIMEOUT
```
```
If there is no response from respective interchange during
authorization, then PG will provide the Host timeout result.
```
```
NOT
PROCESSED
```
```
MADA Manual Refund Request is declined.
```
```
PROCESSING MADA Manual Refund Request is accepted.
```

©2024 API Guide Page 276 of 313

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVA

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVA

```
public static String encryptAES(String key,String encryptString) throws
Exception{
```
```
String AES_IV = “PGKEYENCDECIVSPC”;
```
```
Byte [] encryptedText=null;
```
```
IvParameterSpec ivspec=null;
```
```
SecretKeySpec skeySpec=null;
```
```
Cipher cipher=null;
```
```
Byte [] text=null;
```
```
String s=null;
```
```
try {
```
```
ivspec = new IvParameterSpec(AES_IV.getBytes("UTF-8"));
```
```
skeySpec = new SecretKeySpec(key.getBytes("UTF-8"), "AES");
```
```
cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
```
```
cipher.init(Cipher.ENCRYPT_MODE, skeySpec,ivspec);
```
```
text = encryptString.getBytes("UTF-8");
```
```
encryptedText = cipher.doFinal(text);
```
```
s = byteArrayToHexString(encryptedText);
```
```
} catch (Exception e) {
```
```
e.printStackTrace();
```
##### }

```
finally
```
##### {

```
encryptedText=null;
```
```
ivspec=null;
```

©2024 API Guide Page 277 of 313

```
skeySpec=null;
```
```
cipher=null;
```
```
text=null;
```
##### }

```
return s.toUpperCase();
```
##### }

```
Note: Before encrypting encryptString value. merchant needs to encode the value with URL
Encoder.
public static String decryptAES(String key,String encryptedString) throws
Exception {
```
```
String AES_IV = “PGKEYENCDECIVSPC”;
```
```
SecretKeySpec skeySpec=null;
```
```
IvParameterSpec ivspec=null;
```
```
Cipher cipher =null;
```
```
Byte [] textDecrypted=null;
```
```
Try {
```
```
Byte [] b = hexStringToByteArray(encryptedString);
```
```
skeySpec = new SecretKeySpec(key.getBytes("UTF-8"),"AES");
```
```
ivspec = new IvParameterSpec(AES_IV.getBytes("UTF-8"));
```
```
cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
```
```
cipher.init(Cipher.DECRYPT_MODE, skeySpec,ivspec);
```
```
textDecrypted = cipher.doFinal(b);
```
```
} catch (Exception e) {
```
```
e.printStackTrace();
```
##### }

```
finally
```
##### {


©2024 API Guide Page 278 of 313

```
skeySpec=null;
```
```
ivspec=null;
```
```
cipher =null;
```
##### }

```
return(new String(textDecrypted));
```
##### }

```
Note : After decrypting encryptedString value. Merchant needs to decode the textDecrypted value
with URL Decoder.
```

©2024 API Guide Page 279 of 313

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVASCRIPT

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR JAVASCRIPT

```
function aesEncrypt(trandata,key)
```
##### {

```
var iv = "PGKEYENCDECIVSPC";
```
```
var rkEncryptionIv = aesjs.utils.utf8.toBytes(iv);
```
```
var enckey= aesjs.utils.utf8.toBytes(key);
```
```
var aesCtr = new aesjs.ModeOfOperation.cbc(enckey, rkEncryptionIv);
```
```
var textBytes = aesjs.utils.utf8.toBytes(trandata);
```
```
var encryptedBytes = aesCtr.encrypt(aesjs.padding.pkcs7.pad(text
Bytes));
```
```
var encryptedHex = aesjs.utils.hex.fromBytes(encryptedBytes);
```
```
return encryptedHex;
```
##### }

```
Note: Before encrypting trandata value. merchant needs to encode the value with
URL Encoder.
```
```
function AESdecryption(encryptedHex,key)
```
##### {

```
var iv = "PGKEYENCDECIVSPC";
```
```
var enckey= aesjs.utils.utf8.toBytes(key);
```
```
var rkEncryptionIv = aesjs.utils.utf8.toBytes(iv);
```
```
var encryptedBytes = aesjs.utils.hex.toBytes(encryptedHex);
```
```
var aesCbc = new aesjs.ModeOfOperation.cbc(enckey, rkEncryptionIv);
```
```
var decryptedBytes = aesCbc.decrypt(encryptedBytes);
```
```
var decryptedText = aesjs.utils.utf8.fromBytes(decryptedBytes);
```

©2024 API Guide Page 280 of 313

```
return decryptedText;
```
##### }

```
Note: After decrypting encryptedHex value. Merchant needs to decode the decryptedText value
with URL Decoder.
```

©2024 API Guide Page 281 of 313

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR PHP................................................................

## SAMPLE ENCRYPTION AND DECRYPTION CODE FOR PHP..........................................................

```
Encryption:
```
```
function encryptAES($str,$key)
```
##### {

```
$str = $this->pkcs5_pad($str);
```
```
$ivlen = openssl_cipher_iv_length($cipher="aes- 256 - cbc");
```
```
$iv="PGKEYENCDECIVSPC";
```
```
$encrypted = openssl_encrypt($str, "aes- 256 - cbc",$key, OPENSSL_ZERO_PADDING,
$iv);
```
```
$encrypted = base64_decode($encrypted);
```
```
$encrypted = unpack ('C*', ($encrypted));
```
```
$encrypted=$this->byteArray2Hex($encrypted);
```
```
$encrypted = urlencode($encrypted);
```
```
return $encrypted;
```
##### }

```
Note: Before encrypting transaction data, data needs to be encoded using URL-Encoder
```
```
Decryption:
```
```
function decryptAES ($codcode, $)
```
##### {

```
$code = $this->hex2ByteArray(trim($code));
```
```
$code=$this->byteArray2String($code);
```
```
$iv = "PGKEYENCDECIVSPC";
```

©2024 API Guide Page 282 of 313

```
$code = base64_encode($code);
```
```
$decrypted = openssl_decrypt($code, 'AES- 256 - CBC', $key, OPENSSL_ZERO_PADDING,
$iv);
```
```
return $this->pkcs5_unpad($decrypted);
```
##### }

```
Note: After decrypting transaction data needs to be decoded using URL-Decoder
```

©2024 API Guide Page 283 of 313

## CHAPTER 4 TROUBLESHOOTING

## KNOWN ERROR CODES

```
The error codes are listed below:
```
The following table contains the known error codes and their descriptions:

```
Error Code Error Code Description
IPAY0100001 Missing error url.
```
IPAY0100002 Invalid error url.

```
IPAY0100003 Missing response URL.
IPAY0100004 Invalid response URL.
```
IPAY0100005 Missing Tranportal Id.

```
IPAY0100006 Invalid tranportal id.
IPAY0100007 Missing transaction data.
```
IPAY0100008 Terminal Not Enabled.

```
IPAY0100009 Institution not enabled.
IPAY0100010 Institution has not enabled for the encryption process.
```
IPAY0100011 Merchant has not enabled for encryption process.

IPAY0100012 Empty terminal key.

```
IPAY0100013 Invalid transaction data.
IPAY0100014 Terminal Authentication requested with invalid tranportal ID data.
```
IPAY0100015 Invalid Tranportal Password.

```
IPAY0100016 Password security not enabled.
IPAY0100017 Inactive terminal.
```
IPAY0100018 Terminal password expired.

```
IPAY0100019 Invalid login attempt.
IPAY0100020 Invalid Action type.
```
IPAY0100021 Missing currency.

IPAY0100022 Invalid currency.

```
IPAY0100023 Missing amount.
IPAY0100024 Invalid Transaction Amount.
```
IPAY0100025 Invalid amount or currency.

IPAY010 0026 Invalid language id.


©2024 API Guide Page 284 of 313

IPAY0100027 Invalid track id.

```
IPAY0100028 Invalid user defined field1.
IPAY0100029 Invalid user defined field2.
```
IPAY0100030 Invalid user defined field3.

```
IPAY0100031 Invalid user defined field4.
IPAY0100032 Invalid user defined field5.
```
IPAY0100033 Terminal action not enabled.

IPAY0100034 Currency code not enabled.

```
IPAY0100036 UDF Mismatched.
IPAY0100037 Payment id missing.
```
IPAY0100038 Unable to process the request.

```
IPAY0100039 Invalid payment id.
IPAY0100042 PaymentId Expired.
```
IPAY0100043 Transaction denied: IP Blocked.

```
IPAY0100044 Problem occurred while loading payment page.
IPAY0100045 DENIED BY RISK.
```
IPAY0100049 Transaction declined due to exceeding OTP attempts.

IPAY0100050 Invalid terminal key.

```
IPAY0100051 Missing terminal key.
IPAY0100052 Problem occurred during merchant response encryption.
```
IPAY0100053 Problem occurred while processing direct debit.

```
IPAY0100054 Payment details not available.
IPAY0100055 Invalid Payment Status.
```
IPAY0100056 Instrument not allowed in Terminal and Brand.

```
IPAY0100058 Transaction denied due to invalid instrument.
IPAY0100059 Transaction denied due to invalid currency code.
```
IPAY0100060 Transaction denied due to missing amount.

```
IPAY0100063 Transaction denied due to invalid track ID.
IPAY0100064 Transaction denied due to invalid UDF1:
```
IPAY0100065 Transaction denied due to invalid UDF2:

IPAY0100066 Transaction denied due to invalid UDF3:

```
IPAY0100067 Transaction denied due to invalid UDF4:
IPAY0100068 Transaction denied due to invalid UDF5:
```
IPAY0100069 Missing Payment Instrument.

```
IPAY0100070 Transaction denied due to failed card check digit calculation.
IPAY0100071 Transaction denied due to missing CVD2.
```

©2024 API Guide Page 285 of 313

IPAY0100072 Transaction denied due to invalid CVD2.

```
IPAY0100073 Transaction denied due to invalid CVV.
IPAY0100074 Missing Expiry Year.
```
IPAY0100075 Transaction denied due to invalid expiry year.

```
IPAY0100076 Missing Expiry Month.
IPAY0100077 Transaction denied due to invalid expiry month.
```
IPAY0100078 Transaction denied due to missing expiry day.

IPAY0100079 Transaction denied due to invalid expiry day.

```
IPAY0100080 Transaction denied due to expiration date.
IPAY0100081 Card holder name is not present.
```
IPAY0100082 Card address is not present.

```
IPAY0100083 Card postal code is not present.
IPAY0100084 AVS Check: Fail
```
IPAY0100085 Electronic Commerce Indicator is invalid.

```
IPAY0100086 Transaction denied due to missing CVV.
IPAY0100087 Card pin number is not present.
```
IPAY0100088 Empty mobile number.

IPAY0100089 Invalid mobile number.

```
IPAY0100090 Empty MMID.
IPAY0100091 Invalid MMID.
```
IPAY0100092 Empty OTP number.

```
IPAY0100093 Invalid OTP number.
IPAY0100094 Sorry, this instrument is not handled.
```
IPAY0100095 Terminal inactive.

```
IPAY010009 6 IMPS for Institution Not Active for Transaction request, Institution:
IPAY0100097 IMPS for Terminal Not Active for Transaction request, Terminal:
```
IPAY0100100 Problem occurred while authorization.

```
IPAY0100101 Denied by risk : Risk Profile does not exist.
IPAY0100102 Denied by risk: Maximum Floor Limit Check.
```
IPAY0100103 Transaction denied due to Risk : Maximum transaction count.

IPAY0100106 Invalid Payment Instrument.

```
IPAY0100107 Instrument not enabled.
IPAY0100108 Perform risk check:Failed
```
IPAY0100109 Invalid subsequent transaction, payment id is null or empty.

```
IPAY0100110 Invalid subsequent transaction, Tran Ref id is null or empty.
IPAY0100111 Card decryption failed.
```

©2024 API Guide Page 286 of 313

```
IPAY0100112 Problem occurred in method load original transaction data for
invoice(card number, exp month/year).
```
```
IPAY0100113 Problem occurred in method loading original transaction data(card
number, exp month / year) for orig_tran_id.
IPAY0100114 Duplicate Record.
```
IPAY0100115 Transaction denied due to missing original transaction id.

```
IPAY0100116 Transaction denied due to invalid original transaction id.
IPAY0100117 Transaction denied due to missing card number.
```
IPAY0100118 Transaction denied due to card number length error.

```
IPAY0100119 Transaction denied due to invalid card number.
IPAY0100121 Transaction denied due to invalid card holder name.
```
IPAY0100122 Transaction denied due to invalid address.

```
IPAY0100123 Transaction denied due to invalid postal code.
IPAY0100124 Problem occurred while validating transaction data.
```
IPAY0100125 Payment instrument not enabled.

IPAY0100126 Brand not enabled.

```
IPAY0100127 Problem occurred while doing validate original transaction.
IPAY0100128 Transaction denied due to Institution ID mismatch.
```
IPAY0100129 Transaction denied due to Merchant ID mismatch.

```
IPAY0100130 Transaction denied due to Terminal ID mismatch.
IPAY0100131 Transaction denied due to Payment Instrument mismatch.
```
IPAY0100132 Transaction denied due to Currency Code mismatch.

```
IPAY0100133 Transaction denied due to Card Number mismatch.
IPAY0100134 Transaction denied due to invalid Result Code.
```
```
IPAY0100135 Problem occurred while doing perform action code reference id
(Validate Original Transaction).
IPAY0100136 Transaction denied due to previous capture check failure (Validate
Original Transaction).
IPAY0100139 Transaction denied due to void amount versus original amount
check failure (Validate Original Transaction).
```
```
IPAY0100140 Transaction denied due to previous void check failure (Validate
Original Transaction).
```
```
IPAY0100141 Transaction denied due to purchase already credited ( Validate
Original Transaction ).
```
```
IPAY0100142 Problem occurred while validating original transaction.
IPAY0100144 ISO MSG is null. See log for more details!
```

©2024 API Guide Page 287 of 313

IPAY0100145 Problem occurred while loading default messages in ISO Formatter.

```
IPAY0100146 Problem occurred while encrypting PIN.
IPAY0100147 Problem occurred while formatting purchase request in B24 ISO
Message Formatter.
```
```
IPAY0100148 Problem occurred while hashing ecom pin.
IPAY0100149 Invalid PIN Type.
```
```
IPAY0100150 Problem occurred while formatting Reverse purchase request in B24
ISO Message Formatter.
```
```
IPAY0100151 Problem occurred while formatting Credit request in B24 ISO
Message Formatter.
```
```
IPAY0100152 Problem occurred while formatting authorization request in B24 ISO
Message Formatter.
IPAY0100153 Problem occurred while formatting Capture request in B24 ISO
Message Formatter.
IPAY0100154 Problem occurred while formatting Reverse Credit request in B24
ISO Message Formatter.
```
```
IPAY0100155 Problem occurred while formatting reverse authorization request in
B24 ISO Message Formatter.
```
```
IPAY0100156 Problem occurred while formatting Reverse Capture request in B24
ISO Message Formatter.
```
```
IPAY0100157 Problem occurred while formatting vpas capture request in B24 ISO
Message Formatter.
```
IPAY0100159 External message system error.

```
IPAY0100160 Unable to process the transaction.
IPAY0100162 Merchant is not allowed for encryption process.
```
IPAY0100163 Problem occurred during transaction.

IPAY0100164 Invalid ECI Value.

```
IPAY0100166 Transaction Not Processed due to Empty Authentication Status.
IPAY0100167 Invalid Authentication value.
```
IPAY0100169 Invalid enrollment value.

```
IPAY0100170 Invalid cavv value.
IPAY0100176 Decrypting transaction data failed.
```
IPAY0100178 Merchant encryption enabled.

```
IPAY0100179 IVR not enabled.
IPAY0100180 Authentication Not Available.
```
IPAY0100181 Card encryption failed.


©2024 API Guide Page 288 of 313

IPAY0100182 Vpas merchant not enabled.

```
IPAY0100183 Error occurred Due to bytePAReq is null.
IPAY0100184 Error occurred while Parsing PAReq.
```
IPAY0100185 Problem occurred while authentication.

```
IPAY0100186 Encryption enabled.
IPAY0100187 Customer ID is missing for Faster Checkout.
```
IPAY0100188 Transaction Mode(FC) is missing for Faster Checkout.

IPAY0100189 Transaction denied due to brand directory unavailable.

```
IPAY0100190 Transaction denied due to Risk : Maximum floor limit transaction
count.
```
```
IPAY0100191 Denied by risk: Negative Card check.
IPAY0100193 Invalid xid value.
```
```
IPAY0100194 Transaction denied due to Risk: Minimum Transaction Amount
processing.
```
```
IPAY0100195 Transaction denied due to Risk : Maximum credit processing
amount.
IPAY0100196 Transaction denied due to Risk : Maximum processing amount.
```
IPAY0100197 Transaction denied due to Risk : Maximum debit amount.

```
IPAY0100198 Transaction denied due to Risk : Transaction count limit exceeded
for the IP.
```
```
IPAY0100199 Transaction denied due to previous credit check failure(Validate
Original Transaction).
```
IPAY0100200 Denied by risk : Negative BIN check.

```
IPAY0100201 Denied by risk : Declined Card check.
IPAY0100202 Error occurred in Determine Payment Instrument.
```
IPAY0100203 Problem occurred while doing perform transaction.

```
IPAY0100204 Missing payment details.
IPAY 0100205 Problem occurred while getting PARES details.
```
IPAY0100206 Problem occurred while getting currency minor digits.

IPAY0100207 Bin range not enabled.

```
IPAY0100208 Action not enabled.
IPAY0100209 Institution config not enabled.
```
IPAY0100210 Problem occurred during veres process.

```
IPAY0100211 Problem occurred during pareq process.
IPAY0100212 Problem occurred while getting veres.
```
IPAY0100213 Problem occurred while processing the hosted transaction request.


©2024 API Guide Page 289 of 313

IPAY0100214 Problem occurred while verifying tranportal password.

```
IPAY0100216 Invalid data received.
IPAY0100217 Invalid payment detail.
```
IPAY0100218 Invalid brand id.

```
IPAY0100219 Missing Card Number.
IPAY0100220 Invalid Card Number.
```
IPAY0100221 Missing card holder name.

IPAY0100222 Invalid zip code.

```
IPAY0100223 Missing cvv.
IPAY0100224 Invalid cvv.
```
IPAY0100225 Missing card expiry year.

```
IPAY0100226 Invalid card expiry year.
IPAY0100227 Missing card expiry month.
```
IPAY0100228 Invalid card expiry month.

```
IPAY0100229 Invalid card expiry day.
IPAY0100230 Card expired.
```
IPAY0100231 Invalid user defined field.

IPAY0100232 Missing original transaction id.

```
IPAY0100233 Invalid original transaction id.
IPAY0100234 Problem occurred while formatting Reverse Capture request in VISA
ISO Message Formatter.
IPAY0100235 Problem occurred while formatting reverse authorization request in
VISA ISO Message Formatter.
IPAY0100236 Problem occurred while formatting Reverse Credit request in VISA
ISO Message Formatter.
```
```
IPAY0100237 Problem occurred while formatting Reverse purchase request in
VISA ISO Message Formatter.
```
```
IPAY0100238 Problem occurred while formatting Capture request in VISA ISO
Message Formatter.
```
```
IPAY0100239 Problem occurred while formatting authorization request in VISA ISO
Message Formatter.
```
```
IPAY0100240 Problem occurred while formatting Credit request in VISA ISO
Message Formatter.
```
```
IPAY0100241 Problem occurred while formatting purchase request in VISA ISO
Message Formatter.
IPAY0100242 RC_UNAVAILABLE.
```

©2024 API Guide Page 290 of 313

IPAY0100243 NOT SUPPORTED

```
IPAY010 0244 Payment Instrument Not Configured.
IPAY0100245 Problem occurred while sending/receivinig ISO message.
```
IPAY0100246 Problem occurred while doing perform ip risk check.

```
IPAY0100247 PARES message format is invalid.
IPAY0100248 Problem occurred while validating PARES message format.
```
IPAY0100249 Merchant response url is down.

IPAY0100250 Payment details verification failed.

```
IPAY0100251 Invalid payment data.
IPAY0100252 Missing veres.
```
IPAY0100253 Problem occurred while cancelling the transaction.

```
IPAY0100254 Merchant not enabled for performing transaction.
IPAY0100255 External connection not enabled.
```
IPAY0100256 Payment encryption failed.

```
IPAY0100257 Brand rules not enabled.
IPAY0100258 Certification verification failed.
```
IPAY0100259 Problem occurred during merchant hashing process.

IPAY0100260 Payment option(s) not enabled.

```
IPAY0100261 Payment hashing failed.
IPAY0100262 Problem occurred during VEREQ process.
```
IPAY0100263 Transaction not found.

```
IPAY0100264 Signature validation failed.
IPAY0100265 PARes status not sucessful.
```
IPAY0100266 Brand directory unavailable.

```
IPAY0100268 3d secure not enabled for the brand.
IPAY0100269 Invalid card check digit.
```
```
IPAY0100271 Problem occurred while formatting purchase request in MASTER ISO
Message Formatter.
```
IPAY0100272 Problem occurred while validating xml message format.

IPAY0100273 Problem occurred while validation VERES message format.

```
IPAY0100274 VERES message format is invalid.
IPAY0100275 Problem occurred while formatting Credit request in MASTER ISO
Message Formatter.
IPAY0100276 Problem occurred while formatting Reverse purchase request in
MASTER ISO Message Formatter.
```

©2024 API Guide Page 291 of 313

```
IPAY0100277 Problem occurred while formatting Reverse Credit request in
MASTER ISO Message Formatter.
```
```
IPAY0100278 Problem occurred while formatting reverse authorization request in
MASTER ISO Message Formatter.
IPAY0100279 Problem occurred while formatting Reverse Capture request in
MASTER ISO Message Formatter.
IPAY0100280 Problem occurred while formatting Capture request in MASTER ISO
Message Formatter.
```
```
IPAY0100281 Transaction Denied due to missing Master Brand.
IPAY0100282 Transaction Denied due to missing Visa Brand.
```
IPAY0100283 Problem occurred in determine payment instrument.

```
IPAY0100284 Invalid subsequent transaction, track id is null or empty.
IPAY0100285 Transaction denied due to invalid original transaction.
```
IPAY0100289 Transaction denied due to Risk : Maximum credit amount.

```
IPAY0100291 Original Transaction ID should not be empty.
IPAY0100292 Transaction denied due to invalid PIN.
```
IPAY0100293 Transaction denied due to duplicate Merchant trackid.

```
IPAY0100294 Transaction denied due to missing Merchant trackid
IPAY0100295 Missing Merchant Track Id.
```
```
IPAY0100296 Problem occurred while formatting purchase request in AMEX ISO
Message Formatter.
IPAY0100297 Problem occurred while formatting Credit request in AMEX ISO
Message Formatter.
```
```
IPAY0100298 Problem occurred while formatting Reversal request in AMEX ISO
Message Formatter.
```
```
IPAY0100299 Problem occurred while inserting AAV details.
IPAY0100300 Transaction denied due to invalid ship-to first name.
```
IPAY0100301 Transaction denied due to invalid ship-to last name.

```
IPAY0100302 Transaction denied due to invalid ship-to address.
IPAY0100303 Transaction denied due to invalid ship-to Zip code.
```
IPAY0100304 Transaction denied due to invalid ship-to Mobile Number.

```
IPAY0100305 Transaction denied due to invalid customer email.
IPAY0100306 Transaction denied due to invalid country code.
```
IPAY0100307 Transaction denied due to invalid card first name.

```
IPAY0100308 Transaction denied due to invalid card last name.
IPAY0100310 Transaction denied due to invalid Zip code.
```

©2024 API Guide Page 292 of 313

IPAY0100311 Transaction denied due to invalid Mobile Number.

```
IPAY0100312 Problem occurred while getting AMEX header details.
IPAY0100313 AMEX header details are not available.
```
IPAY0100314 Problem occurred while getting AAV details.

```
IPAY0100315 AAV details are not available.
IPAY0100316 Problem occurred while checking AAV details.
```
IPAY01003 17 Problem occurred while updating AAV details.

IPAY0100318 Problem occurred while getting tranlog extn details.

```
IPAY0100319 Tranlog Extn details are not available.
IPAY0100320 Problem occurred while inserting Tranlog Extn details.
```
IPAY0100321 Card First Name and Last Name are missing.

```
IPAY0100322 Invalid CSC/CID length.
IPAY0100323 Invalid CSC/CID.
```
IPAY0100324 Missing CSC/CID.

```
IPAY0100325 Transaction denied due to missing CSC/CID.
IPAY0100326 Transaction denied due to invalid CSC/CID.
```
IPAY01003 27 Invalid Buyer Email ID.

IPAY0100328 Invalid Buyer Mobile No.

```
IPAY0100329 Missing Buyer Name.
IPAY0100330 Invalid Minor digits length.
```
IPAY0100331 Invalid Expiry Date.

```
IPAY0100332 Invalid Invoice Id.
IPAY0100333 Invalid Item Description.
```
IPAY0 100334 Invalid Udf1.

```
IPAY0100340 Problem occurred while adding AREQ details.
IPAY0100341 Problem occurred while getting EMV2LOG details.
```
IPAY0100342 Problem occurred while updating ARES details.

```
IPAY0100343 Problem occurred while updating RREQ details.
IPAY0100344 Problem occurred while updating RRES details.
```
IPAY0100345 Problem occurred while updating CRES details.

IPAY0100346 Problem occurred while deleting cardrange details.

```
IPAY0100347 Problem occurred while connecting webserver.
IPAY0100348 Problem occurred while doing Authentication.
```
IPAY0100349 Authentication Response validation failed.

```
IPAY0100350 Results Request Message validation failed.
IPAY0100351 Problem occurred while getting card range count details.
```

©2024 API Guide Page 293 of 313

IPAY0100352 Authentication failed.

```
IPAY0100353 Card Number not found in a participating Card Range.
IPAY0100354 Invalid or Bad POST.
```
IPAY0100355 Missing Callback URL.

```
IPAY0100356 Signature mismatch.
IPAY0100357 NOT AUTHENTICATED
```
IPAY0100358 Shopify authorization failed.

IPAY0100 359 Shopify Reference ID Missing.

```
IPAY0100360 Shopify Test Path is Not Enabled.
IPAY0100361 Shopify Base24 Connectivity is Not Enabled.
```
IPAY0100362 Invalid payout data.

```
IPAY0100363 Invalid payout amount.
IPAY0100364 Payout Amount Mismatched.
```
IPAY0100 365 Problem occurred while inserting payout details.

```
IPAY0100366 Problem occurred while getting payout details.
IPAY0100367 Invalid bank identification code.
```
IPAY0100368 Iban number is empty.

IPAY0100369 Bank identification code is empty.

```
IPAY0100370 Invalid value date.
IPAY0100371 Value date is empty.
```
IPAY0100372 Problem occurred while validating payout details.

```
IPAY0100373 Invalid Benificiary name.
IPAY0100374 Benificiary name is empty.
```
IPAY0100375 Problem occurred while updating payout details.

```
IPAY0100376 Loyalty Transaction is not enabled.
IPAY0100377 Problem occuerd while performing Loayalty Transaction.
```
IPAY0100378 Problem occuerd while performing Cybersource Transaction.

```
IPAY0100379 Bin value should be numeric.
IPAY0100380 Bin number should be of 6 digits.
```
IPAY0100381 Problem Occurred during BIN API check.

IPAY0100382 Technical Problem Occurred during BIN API check.

```
IPAY0100383 Missing Card On File Token.
IPAY0100384 Card On File Token should be numeric.
```
IPAY0100385 Problem occurred while getting Card On File details.

```
IPAY0100386 Problem occurred while inserting Card On File details.
IPAY0100387 Card details not found for given Token and Masked card number.
```

©2024 API Guide Page 294 of 313

IPAY0100388 Expiry date is less than current date.

```
IPAY0100389 Problem occurred while validating card details.
IPAY0100390 Missing masked card number.
```
IPAY0100391 Bill reference info is invalid.

```
IPAY0100392 Problem occurred during card on file registration.
IPAY0100393 Invalid Card On File Token.
```
IPAY0100394 Card number already registered.

IPAY0100395 Agency code is empty.

```
IPAY0100396 Agency code is invalid.
IPAY0100397 Agency code length is invalid.
```
IPAY0100398 Problem occurred while getting cybersource configuration details.

```
IPAY0100399 Signature mismatched.
IPAY01 00400 Signature empty.
```
IPAY0100401 Problem occurred while inserting agency details in mof.

```
IPAY0100402 Amount mismatched.
IPAY0100427 Invalid Payload Received.
```
IPAY0100403 Mada reversal not supported.

IPAY0100404 Transaction Type is invalid.

```
IPAY0100 405 Transaction Type length is invalid.
IPAY0100406 Transaction Type is empty.
```
IPAY0100407 Biller ID is invalid.

```
IPAY0100408 Biller ID length is invalid.
IPAY0100409 Biller ID is empty.
```
IPAY0100410 Invalid Billpay details.

```
IPAY0100411 Bill Amount is empty.
IPAY0100412 Bill Amount is invalid.
```
IPAY0100413 Bill Type is invalid.

```
IPAY0100414 Bill Type length is invalid.
IPAY0100415 Bill Type is empty.
```
IPAY0100416 Problem occurred while inserting Billpay details.

IPAY0100417 Bill Description length is invalid.

```
IPAY0100418 Bill Number is invalid.
IPAY0100419 Bill Number length is invalid.
```
IPAY0100420 Bill Number is empty.

```
IPAY0100421 Bill Name is invalid.
IPAY0100422 ID Type is invalid.
```

©2024 API Guide Page 295 of 313

IPAY0100423 ID Number length is invalid.

```
IPAY0100424 ID Number is empty.
IPAY0100425 Problem occurred while performing Reverse Redemtion transaction.
```
IPAY0100426 Time exceeded, transaction cannot be reversed.

```
IPAY0100502 Missing Buyer Email ID.
IPAY0100504 Problem occurred while framing credit instalment request.
```
IPAY0100505 VISA payment option is not enabled for this merchant.

IPAY0100506 MASTER payment option is not enabled for this merchant.

```
IPAY0100507 MADA payment option is not enabled for this merchant.
IPAY0100508 UDF5 length should not be greater than 255.
```
IPAY0100509 UDF6 length should not be greater than 255

```
IPAY0100511 UDF8 length should not be greater than 255.
IPAY0100512 UDF9 length should not be greater than 255.
```
IPAY0100513 UDF10 length should not be greater than 255.

```
IPAY0100514 UDF4 length should not be greater than 255.
IPAY0100515 UDF3 length should not be greater than 255.
```
IPAY0100516 UDF2 length should not be greater than 255.

IPAY0100517 UDF1 length should not be greater than 255.

```
IPAY0100518 Problem occurred during card on file deregistration.
IPAY0100519 Invalid cvd2.
```
IPAY0100521 Missing Bin Number.

```
IPAY0100522 Issuer Agency Id is empty.
IPAY0100523 Problem occurred while framing Request for webhook.
```
IPAY0100524 Missing Buyer Mobile No.

```
IPAY0100525 Invalid card holder First name length.
IPAY0100526 Invalid card holder Last name length.
```
IPAY0100527 Invalid card holder Last name.

```
IPAY0100528 Invalid card holder name.
IPAY0100529 Invalid card holder First name.
```
IPAY0100530 Issuer Agency Id is invalid.

IPAY010 0531 Issuer Agency Id length is invalid.

```
IPAY0100532 Billing Account Id is empty.
IPAY0100533 Billing Account Id is invalid.
```
IPAY0100534 Billing Account Id length is invalid.

```
IPAY0100535 Billing Cycle is invalid.
IPAY0100536 Billing Cycle length is invalid.
```

©2024 API Guide Page 296 of 313

IPAY0100537 Due amount is empty.

```
IPAY0100538 Due amount is invalid.
IPAY0100539 Paid amount is empty.
```
IPAY0100540 Paid amount is invalid.

```
IPAY0100541 Bill reference info length is invalid.
IPAY0100542 Problem occurred while getting mof details.
```
IPAY0100543 Problem occurred while framing mof info for webhook.

IPAY0100544 Problem occurred while updating Faster Checkout details

```
IPAY0100545 ID Type length is invalid.
IPAY0100546 Transaction denied due to missing PIN.
```
IPAY0100547 Invalid Buyer Name.

```
IPAY0100548 Problem occurred in method tranlog insert for invoice.
IPAY0100550 ID Type is empty.
```
IPAY0100551 Challenge Response Message validation failed.

```
IPAY0100552 Invalid Callback url.
IPAY0100553 Problem occurred while updating Acquire Ticket details.
```
IPAY0100554 Problem occurred while updating Credit Instalment details.

IPAY0100555 Transaction Declined Due To Exceeding OTP Resend Attempts.

```
IPAY0100556 Transaction denied due to authorization already captured (Validate
Original Transaction).
```
```
IPAY0100557 Problem occurred while inserting Webhook details.
IPAY0100558 Invalid iban number.
```
IPAY0100559 Bank identification code Length should be between 8 and 12.

```
IPAY0100560 Iban number Length should be between 24 and 35.
IPAY0100561 Benificiary name should be less than length of 100.
```
IPAY0100562 Invalid ECI Value in request.

```
IPAY0100563 Missing CurrencyCode.
IPAY0100565 ID Number is invalid.
```
IPAY0100566 Card Range not exists.

IPAY0100567 Problem occurred while processing the applePay transaction.

```
IPAY0100568 Problem occurred while getting mada key.
IPAY0100569 Rupay Initiate Failure.
```
IPAY0100570 Transaction denied due to session data mismatch.

```
IPAY0100571 Invalid Expiration Date.
IPAY0100572 Problem occurred while updating payment details.
```
IPAY0100573 Problem occuerd while validating MOF details.


©2024 API Guide Page 297 of 313

IPAY0100574 Problem occurred while adding transaction log details.

```
IPAY0100575 Invalid Amount length.
IPAY0100576 Missing Transaction Amount.
```
IPAY0100577 Missing Currency Code.

```
IPAY0 100578 Problem occurred while getting bin range details.
IPAY0100579 Invalid input data received.
```
IPAY0100580 Problem occurred while getting merchant session.

IPAY0100581 Transaction details not available.

```
IPAY0100582 Transaction denied due to missing expiry month.
IPAY0100583 Transaction denied due to missing expiry year.
```
IPAY0100584 Processing Direct Debit request.

```
IPAY0100586 Missing card holder Last name.
IPAY0100587 Invalid user defined field6.
```
IPAY0100588 Invalid user defined field7.

```
IPAY 0100589 Invalid user defined field8.
IPAY0100590 Invalid user defined field9.
```
IPAY0100591 Invalid user defined field10.

IPAY0100592 Invalid zip code length.

```
IPAY0100593 Missing email id.
IPAY0100595 Missing address.
```
IPAY0100596 Invalid mobile number length.

```
IPAY0100597 Missing card holder First name.
IPAY0100598 Missing Cardholder's Name.
```
IPAY0100599 Missing mobile number.

```
IPAY0100601 Invalid email id.
IPAY0100602 Invalid address length.
```
IPAY0100603 Invalid address.

```
IPAY0100604 Invalid email id length.
IPAY0100605 Missing zip code.
```
IPAY0200002 Problem occurred while getting institution details.

IPAY0200003 Problem occurred while getting merchant details.

```
IPAY0200004 Problem occurred while getting password security rules.
IPAY02 00005 Problem occurred while updating terminal details.
```
IPAY0200007 Problem occurred while validating payment details.

```
IPAY0200008 Problem occurred while verifying payment details.
IPAY0200009 Problem occurred while getting payment details.
```

©2024 API Guide Page 298 of 313

IPAY020001 0 Problem occurred while updating the details in payment log.

```
IPAY0200011 Problem occurred while getting ipblock details.
IPAY0200012 Problem occurred while updating payment log ip details.
```
IPAY0200013 Problem occurred while updating description details in payment log.

```
IPAY0200014 Problem occurred during merchant response.
IPAY0200015 Problem occurred while getting terminal.
```
IPAY0200016 Problem occurred while getting payment instrument.

IPAY0200017 Problem occurred while getting payment instrument list.

```
IPAY0200018 Problem occurred while getting transaction details.
IPAY0200019 Problem occurred while getting risk profile details.
```
IPAY0200020 Problem occurred while performing transaction risk check.

```
IPAY0200021 Problem occurred while performing risk check.
IPAY0200023 Problem occurred while determining payment instrument.
```
IPAY0200024 Problem occurred while getting brand rules details.

```
IPAY0200025 Problem occurred while getting terminal details.
IPAY0200026 Problem occurred while getting transaction log details.
```
IPAY0200027 Missing encrypted card number.

```
IPAY0200028 Problem occurred while loading default institution configuration
(Validate Original Transaction).
```
IPAY0200029 Problem occurred while getting external connection details.

```
IPAY0200030 No external connection details for extr conn id:
IPAY0200031 Alternate external connection details not found for the alt extr conn
id:
IPAY0200032 Problem occurred while getting external connection details for extr
conn id:
```
```
IPAY0200033 Problem occurred while getting vpas log details.
IPAY0200034 Problem occurred while getting details from VPASLOG table for
payment id: null
IPAY0200037 Error occurred while getting Merchant ID.
```
IPAY0200038 Problem occurred while getting vpas merchant details.

```
IPAY0200039 Problem occurred while getting Faster Checkout details.
IPAY0200040 Problem occurred while performing card risk check.
```
IPAY0200041 Problem occurred while getting institution configuration.

IPAY0200042 Problem occurred while getting brand.

```
IPAY0200043 Problem occurred while getting mada brand details.
IPAY0200044 Mada Keys not enabled.
```

©2024 API Guide Page 299 of 313

IPAY0200045 Problem occurred while updating VPASLOG table.

```
IPAY0200046 Unable to update VPASLOG table, payment id is null.
IPAY0200047 Problem occurred while getting details from VPASLOG table for
payment id.
```
```
IPAY0200048 Problem occurred while getting details from VPASLOG table.
IPAY0200049 Card number is null. Unable to update risk factors in negative card
table & declined card table.
IPAY0200 050 Problem occurred while updating risk in negative card details.
```
IPAY0200051 Problem occurred while updating risk in declined card table.

```
IPAY0200052 Problem occurred while updating risk factor.
IPAY0200053 Problem occurred while updating payment log currency details.
```
```
IPAY0200054 Problem occurred while inserting currency conversion currency
details.
IPAY0200055 Problem occurred while updating currency conversion currency
details.
IPAY0200056 Problem occurred while getting brand details.
```
IPAY020005 7 Problem occurred while getting external connection details.

```
IPAY0200058 Problem occurred while updating message log 2fa details.
IPAY0200059 Problem occurred while updating vpas details.
```
IPAY0200060 Problem occurred while adding vpas details.

IPAY0200061 Problem occurred during batch 2fa process.

```
IPAY0200062 Problem occurred while getting brand rules details.
IPAY0200063 Problem occurred while updating payment log process code details.
```
```
IPAY0200064 Problem occurred while updating payment log process code and ip
details.
```
IPAY0200065 Problem occurred while updating payment log description details.

```
IPAY0200066 Problem occurred while updating payment log instrument details.
IPAY0200067 Problem occurred while updating payment log udf Fields.
```
IPAY0200068 Problem occurred while validating IP address blocking.

IPAY0200069 Problem occurred while updating payment log card details.

```
IPAY0200070 Problem occurred while updating ipblock details.
IPAY0200071 Probelm occurred during authentication.
```
IPAY0200072 Rupay Auth log details not available.

```
IPAY0200073 Only Purchase and and Auth transaction allowed in Pre Auth
Transaction.
```
IPAY0200074 Only Purchase Action Allowed for Dinners Card.


©2024 API Guide Page 300 of 313

IPAY0200075 Aggregator is down.

```
IPAY0200076 Transaction ip details not found.
IPAY0200077 Payment details missing.
```
IPAY0200078 Host is down.

```
IPAY0200079 Problem occurred while updating payment log browser information.
IPAY0200080 Invalid keystore.
```
IPAY0200081 Unknown IMPS Tran Action Code encountered.

IPAY0200 082 Missing cvd2.

```
IPAY0200083 Invalid vereq.
IPAY0200085 Checkbin Failure.
```
IPAY0200092 Payment log details not available.

```
IPAY0200102 Error while processing the Order List Transactions.
IPAY0200103 Exception in OTP process.
```
IPAY0200104 Exception in parsing Action Code.

```
IPAY0200105 Error in ECI Validation.
IPAY0200106 Exception in validation Parameters.
```
IPAY0200107 Unable to process currency conversion

IPAY0200108 MultiCurrency Refunding is not allowed.

```
IPAY0200109 Formatter instance creation failed.
IPAY0200110 Unable to process request, unsupported visa vpas action code.
```
IPAY0200111 Unable to process request, unsupported master vpas action code.

```
IPAY0200112 Visa
IPAY0200113 Master
```
IPAY0200114 Unable to process request, unsupported VISA credit action code.

```
IPAY0200115 Unable to process request, unsupported MASTER credit action code.
IPAY0200116 Unable to process request, unsupported debit action code.
```
IPAY0200117 Netbanking not allowed.

```
IPAY0200121 FSSConnect Destination is down.
IPAY02 00200 SMS Server communication failure.
```
IPAY0200201 OTP Email Sending failed.

IPAY0200202 FAILED

```
IPAY0200203 Transaction denied while getting Ip Risk details.
IPAY0200204 Transaction denied while getting card risk details.
```
IPAY0200205 Transaction denied while getting transaction risk details.

IPAY0200206 Exception in PreAuth Transaction Process.


©2024 API Guide Page 301 of 313

```
IPAY0200207 Transaction Failed due to in mastero validation failed for the
terminal.
```
IPAY0200208 Transaction timed out during VPAS transaction

IPAY0200209 Unable to connect webserver for 3D secure enrollment.

```
IPAY0200210 Transaction denied due to error in IVR password encryption.
IPAY0200211 Error occurred while getting Institution ID.
```
IPAY0200213 Error occurred while getting Brand ID.

```
IPAY0200214 Error occurred while getting External Connection ID.
IPAY0200215 Error occurred Due to XMLPAReq is null.
```
IPAY0200216 Transaction detail is invalid.

```
IPAY0200300 Missing transaction details.
IPAY0200301 Invalid transaction details.
```
IPAY0300001 Action not supported.

```
IPAY0300002 Invalid pre authentication status.
IPAY0300003 Invalid Card Number data.
```
IPAY0300004 Card Number Not Numeric.

IPAY0300005 Invalid Subsequent Transaction.

```
IPAY0300006 Invalid Transaction Attempt.
IPAY0300007 Transaction denied due to invalid UDF6:
```
IPAY0300008 Transaction denied due to invalid UDF7:

```
IPAY0300009 Transaction denied due to invalid UDF8:
IPAY0300010 Transaction denied due to invalid UDF9:
```
IPAY0300011 Transaction denied due to invalid UDF10:

```
IPAY0300012 Transaction denied due to invalid UDF11:
IPAY0300013 Transaction denied due to invalid UDF12:
```
IPAY0300014 Problem occurred while fetching the Payzapp Response Code.

```
IPAY0300015 Payzapp Response Code not available.
IPAY0300016 Problem occurred while fetching the Payzapp Configuration.
```
IPAY0300017 Payzapp not configured.

IPAY0300018 Transaction denied due to invalid UDF13:

```
IPAY0300019 Transaction denied due to invalid UDF14:
IPAY0300020 Transaction denied due to invalid UDF15:
```
IPAY0300021 Problem occurred in Payzapp Refund Response.

```
IPAY0300023 No such terminals for this batch transaction.
IPAY0300024 Failed credit greater than debit check.
```
IPAY0300025 Failed capture greater than auth check.


©2024 API Guide Page 302 of 313

IPAY0300026 Problem occurred while getting other payment details.

```
IPAY0300027 Problem occurred while getting card range details.
IPAY0300028 Problem occurred while sending response to merchant.
```
IPAY0300029 Problem occurred while Getting Transaction details.

```
IPAY0300030 Problem occurred while Inserting Transaction Details.
IPAY0300031 Problem occurred while processing Payzapp transaction.
```
IPAY0300032 Missing ENROLLED_STATUS.

IPAY0300033 Missing AUTH_STATUS

```
IPAY0300034 Missing User Defined Field 1.
IPAY0300035 Missing User Defined Field 2.
```
IPAY0300036 Missing User Defined Field 3.

```
IPAY0300037 Missing User Defined Field 4.
IPAY0300038 Missing User Defined Field 5.
```
IPAY0300039 Missing xid

```
IPAY0300040 Missing cavv.
IPAY0300041 Missing eci
```
IPAY0300042 Missing pan in PARES message format.

IPAY0300043 Pan mismatch in PARES message format.

```
IPAY0300044 Problem occurred while doing process transaction.
IPAY0300046 Missing Action Code.
```
IPAY0300047 Problem occurred while getting negative bin details.

```
IPAY0300048 Problem occurred while getting negative card details.
IPAY0300049 Problem occurred while updating negative card details.
```
IPAY0300050 Problem occurred while getting declined card details.

```
IPAY0300051 Problem occurred while getting saf details.
IPAY0300052 Problem occurred while updating connection status in external
connection.
IPAY0300053 Currency not enabled.
```
IPAY0300054 Problem occurred while adding declined card details.

IPAY0300055 Problem occurred while updating declined card details.

```
IPAY0300056 Problem occurred while getting card risk details.
IPAY0300057 Problem occurred while getting transaction risk details.
```
```
IPAY0300058 Problem occurred while getting m24 station status from connection
status.
```
IPAY0300059 Problem occurred while doing perform action code reference id.

IPAY0300060 Problem occurred while getting transaction ip details.


©2024 API Guide Page 303 of 313

IPAY0300061 Card Number Should be Numeric.

```
IPAY0300062 Missing Tranportal Password.
IPAY0300063 Missing Input Data.
```
IPAY0300064 ECI is empty or null or length is not equal to 2.

```
IPAY0300066 Problem occurred while updating PreAuth table.
IPAY0300067 Unable to update PreAuthLOG table, payment id is null.
```
```
IPAY0300068 Problem occurred while getting connection status from extr
connection.
IPAY0300069 Transaction in progress in another tab/window.
```
IPAY0300071 Problem occurred while inserting Faster Checkout details.

```
IPAY0300072 Problem occurred while updating PreAuthLog status.
IPAY0300073 Problem occurred while inserting record in PreAuthLog.
```
IPAY0300074 Problem occurred while validating IMPS transaction.

```
IPAY0300075 Problem occurred while updating risk factors in Negative card and
Declined card
```
IPAY0300076 Problem occurred while processing original transaction details.

```
IPAY0300077 Negative bin details not found.
IPAY0300078 Negative card details not found.
```
IPAY0300079 Not original transaction.

```
IPAY0300080 Institution id mismatch.
IPAY0300081 Merchant id mismatch.
```
IPAY0300082 Terminal id mismatch.

```
IPAY0300083 Invalid captcha.
IPAY0300084 Missing debit card number.
```
IPAY0300085 Invalid card number length.

IPAY0300086 Missing pin.

```
IPAY0300087 Invalid pin.
IPAY0300088 Missing expiry month and year.
```
IPAY0300089 Invalid expiry month and year.

```
IPAY0300090 Problem occurred while adding payment log details.
IPAY0300092 Problem occurred while validating IMPS.
```
IPAY0300093 Problem occurred while getting common instrument list.

```
IPAY0300094 Problem occurred while converting batch data into transaction data.
IPAY0300095 Problem occurred while converting maestro batch data into
transaction data.
```
IPAY030009 6 Invalid Common Payment Instrument List.


©2024 API Guide Page 304 of 313

IPAY0300097 Problem occurred while common payment instrument.

```
IPAY0300098 Problem occurred during VPAS transaction.
IPAY0300099 Transaction denied due to invalid action Codes
```
IPAY0300100 Problem occurred while encrypting card details.

```
IPAY0300101 Problem occurred while generating ISO for transaction data.
IPAY0300102 Problem occurred while generating VISA ISO for transaction data.
```
IPAY0300103 Problem occurred while generating ISO for VPAS transaction.

```
IPAY03 00104 Problem occurred while generating MASTER ISO for transaction
data.
```
IPAY0300105 Problem occurred while generating VISA ISO for debit transaction.

```
IPAY0300106 Problem occurred while generating MASTER ISO for debit
transaction.
```
```
IPAY0300107 Problem occurred while generating ISO for debit transaction.
IPAY0300108 Problem occurred while generating ISO for prepaid transaction.
```
IPAY0300109 I-Frame Flag is not enabled

IPAY0300110 Rupay transaction not enabled for Terminal.

```
IPAY0300111 Message got rejected by SM.
IPAY0300112 Unable to process the message.
```
IPAY0300113 Invalid input.

```
IPAY0300114 Duplicate message.
IPAY0300115 Request come with GET method so transaction declined.
```
IPAY0300116 Transaction initiated with invalid source.

```
IPAY0300117 Invalid Unique id.
IPAY0300118 IP is blocked.
```
IPAY0300119 IP is not configured to process the message.

IPAY0300120 Remote IP Profile is not configured to process the message.

```
IPAY0300121 Invalid input format.
IPAY0300122 Connection Read Timeout.
```
```
IPAY030012 3 Search result greater than maximum number of records
allowed.Increase search granularity and re-submit.
```
IPAY0300124 Problem occurred while verifying tranportal id.

```
IPAY0300125 Missing required data.
IPAY0300126 Missing data type.
```
IPAY0300127 Transaction declined due to payment log not updated.

IPAY0300128 Duplicate transaction request.

IPAY0300130 Problem occurred while checking IP range.


©2024 API Guide Page 305 of 313

IPAY0300131 Problem occurred while checking negative bin range.

```
IPAY0400001 Problem occurred while getting merchant acknowledgement &
transaction reversed.
```
IPAY0400002 Problem occurred while parsing merchant request.

```
IPAY0400004 Missing Action.
IPAY0400005 Missing Password.
```
IPAY0400006 Missing TrackID.

```
IPAY0400007 Missing Payment Id or Tranportal Id.
IPAY0 400008 Missing UDF5.
```
IPAY0400009 Missing TransID.

```
IPAY0400010 Missing Card Type.
IPAY0400011 Blank Request.
```
IPAY0500002 paymentData not enabled.

```
IPAY0500003 paymentMethod not enabled.
IPAY0500004 Header not enabled.
```
IPAY0500005 Problem occurred while getting paymentData details.

IPAY0500006 Problem occurred while getting paymentToken details.

```
IPAY0500007 Problem occurred while getting header details.
IPAY0500008 Problem occurred while getting paymentMethod details.
```
IPAY0500009 Problem occurred while getting Token details.

```
IPAY0500010 Asymmetric keys do not match.
IPAY0500011 Problem occurred while processing the CreditInstalment Request.
```
IPAY0500012 Problem occurred while validating applePay signature.

```
IPAY0500013 Problem occurred while getting applePay brand details.
IPAY0500014 Problem occurred while processing the applePay tranportal
transaction.
```
```
IPAY0500015 3d secure not enabled for the terminal.
IPAY0500016 signature certificates count missed.
```
IPAY0500017 leaf certificate missing.

```
IPAY0500018 intermediate certificate missing.
IPAY0500019 Failed to verify apple pay signature.
```
IPAY0500020 Failed to extract sign time from apple pay signature.

```
IPAY0500021 Apple pay signature is too old.
IPAY0500022 Problem occurred while validating applePay signature time.
```
IPAY0500023 Failed to verify apple pay certificate.

IPAY0500024 Problem occurred while validating rootCA.


©2024 API Guide Page 306 of 313

IPAY0500025 Exception while initializing Code Signer Certs.

```
IPAY0500026 Problem occure while framing signedData.
IPAY0500027 Apple pay currency code and transaction currency code not
matched.
```
```
IPAY0500028 Apple pay amount and transaction amount not matched.
IPAY0500029 Apple pay transaction ID not matched.
```
IPAY0500030 Problem occurred while inserting record in Applepay Tranlog.

```
IPAY0500031 Applepay transaction not enabled for Terminal.
IPAY0500032 Applepay merchant not enabled.
```
IPAY0500033 Problem occurred while getting Applepay merchant details.

```
IPAY0500034 Payment Data missing.
IPAY0500035 Payment Method missing.
```
IPAY0500036 Payment Transaction Identifier missing.

```
IPAY0500037 Problem occurred while getting merchant session.
IPAY0500038 MADA Applepay transaction is not supported.
```
IPAY0600001 Misssing SI data.

IPAY0660001 Unable to frame the card request due to invalid Serial Number.

```
IPAY0660002 Unable to frame the card request due to invalid Profile Number.
IPAY0660003 Unable to frame the card request due to invalid User ID.
```
```
IPAY0660004 Unable to frame the card request due to invalid Operating system
type.
```
IPAY0660005 Unable to frame the card request due to invalid IP Address.

```
IPAY0660006 Unable to frame the card request due to invalid card Type.
IPAY0660007 Problem occurred while framing the card fetch request.
```
IPAY0660008 Problem occurred while fetching the card details for saved card.

IPAY0660009 Problem occurred while fetching the connection details for card list.

```
IPAY0660010 Card List details are invalid to get the card details.
IPAY0660011 Pan mismatch in Market Place Card List Response message.
```
IPAY0700001 Credit Instalment flag not enabled.

```
IPAY0700002 Credit Instalment is not applicable for this bin.
IPAY0700003 Unable to frame credit instalment request.
```
IPAY0700004 Problem occurred while framing Acquire Ticket request.

```
IPAY0700005 Credit instalment response is empty.
IPAY0700006 Raw instalment plan data is empty.
```
IPAY0700007 Failure Result Code Recieved from Prime.

IPAY0700008 Problem occurred while inserting record in CreditInstalmetLog.


©2024 API Guide Page 307 of 313

IPAY0800001 Apple Pay Payment Details is invalid.

```
IPAY0800002 Apple Pay Network Indicator is invalid.
IPAY0800003 Apple Pay onlinePaymentCryptogram is invalid.
```
IPAY0800004 Apple Pay transactionIdentifier is invalid.

```
IPAY0800005 Apple Pay type is invalid.
IPAY0800006 Apple Pay eci Indicator is invalid.
```
IPAY0800007 Apple Pay deviceManufacturerIdentifier is invalid.

IPAY0800008 Apple Pay device pan is invalid.

```
IPAY0800009 Apple Pay device pan expiry details is invalid.
IPAY0800010 Apple Pay currency code is invalid.
```
IPAY0800011 Apple Pay PSP Flag not enabled for this Merchant.

```
IPAY0800012 Absher data is invalid.
IPAY0800013 Sector ID is invalid in Absher Payment data.
```
IPAY0800014 Service code is invalid in Absher Payment data.

```
IPAY0800015 Beneficiary ID is invalid in Absher Payment data.
IPAY0800016 Beneficiary ID type is invalid in Absher Payment data.
```
IPAY0800017 Sector ID length is invalid in Absher Payment data.

IPAY0800019 Beneficiary Name is invalid in Absher Payment data.

```
IPAY0800020 Beneficiary Name length is invalid in Absher Payment data.
IPAY0800021 Branch Code is invalid in Absher Payment data.
```
IPAY0800022 Branch Code length is invalid in Absher Payment data.

```
IPAY0800023 Violation details is invalid in Absher Payment data.
IPAY0800024 Violation count is invalid in Absher Payment data.
```
IPAY0800025 Violation count should be numeric in Absher Payment data.

```
IPAY0800026 Violation count should be valid length in Absher Payment data.
IPAY0800027 Violation list is invalid in Absher Payment data.
```
IPAY0800028 Violation list size is invalid in Absher Payment data.

```
IPAY0800029 Violation id is invalid in Absher Payment data.
IPAY0800030 Violation amount is invalid in Absher Payment data.
```
IPAY0800031 Sentence details is invalid in Absher Payment data.

IPAY0800033 Number of sentences should be numeric in Absher Payment data.

```
IPAY0800034 Sentence count should be valid length in Absher Payment data.
IPAY0800035 Sentence list is invalid in Absher Payment data.
```
IPAY0800036 Sentence list size is invalid in Absher Payment data.

```
IPAY0800 037 Sentence number is invalid in Absher Payment data.
IPAY0800038 Sentence amount is invalid in Absher Payment data.
```

©2024 API Guide Page 308 of 313

IPAY0800039 Sentence installment number is invalid in Absher Payment data.

```
IPAY0800040 Sentence number should be numeric in Absher Payment data.
IPAY0800041 Sentence installment number should be numeric in Absher Payment
data.
```
```
IPAY0800042 Sentence number should be valid length in Absher Payment data.
IPAY0800043 Sentence installment number should be valid length in Absher
Payment data.
IPAY0800044 Missing Sector id.
```
IPAY0800045 Invalid Sector id.

```
IPAY0800046 Invalid IP Address.
IPAY0800047 Violation ID length is invalid in Absher Payment data.
```
IPAY0800048 Payment Inquiry Type is invalid in Absher Payment data.

```
IPAY0800049 Payment Inquiry Type should be alphanumeric in Absher Payment
data.
```
IPAY0800050 Payment Inquiry Type length is invalid in Absher Payment data.

```
IPAY0800051 Problem occurred while validating Absher Payment data.
IPAY0800052 Transaction declined due to action type not supported.
```
IPAY0800053 Invalid Merchant Country Code.

```
IPAY0800054 Card Not Supported!
IPAY0800055 Mod 10 failed for the card number.
```
IPAY0800057 Problem occurred while updating Faster Checkout Customer details.

IPAY0800058 Faster Checkout card number already registered.

```
IPAY0800059 Problem occurred while adding vpas cres details.
IPAY0800060 Problem occurred while getting details from saf dump using
ReversalKey.
IPAY0860001 Problem occurred while loading default messages in MADA ISO
Formatter.
IPAY0860002 Problem occurred while loading default mesages for Supporting in
MADA ISO Formatter.
```
```
IPAY0860003 Problem occurred while formatting purchase request in MADA ISO
Message Formatter.
```
```
IPAY0860004 Problem occurred while formatting Credit request in MADA ISO
Message Formatter.
```
```
IPAY0860005 Problem occurred while formatting Reverse purchase request in
MADA ISO Message Formatter.
```

©2024 API Guide Page 309 of 313

```
IPAY0860006 Problem occurred while formatting authorization request in MADA
ISO Message Formatter.
```
```
IPAY0860007 Problem occurred while formatting Reverse authorization request in
MADA ISO Message Formatter.
IPAY0860008 Problem occurred while formatting Authorization extension in
MADA ISO Message Formatter.
IPAY0860009 Problem occurred while formatting Capture request in MADA ISO
Message Formatter.
```
```
IPAY0860010 Problem occurred while formatting Account verification request in
MADA ISO Message Formatter.
```
```
IPAY0860011 Problem occurred while formatting Administrative Notification
request in MADA ISO Message Formatter.
```
```
IPAY086 0012 Problem occurred while formatting the secure data in MADA ISO
Message Formatter.
```
```
IPAY0860013 Problem occurred while formatting the request for Supporting
transactions in MADA ISO Message Formatter.
```
```
IPAY0860014 Problem occurred while formatting the request Authorization
supporting transactions in MADA ISO Message Formatter.
IPAY0860015 Problem occurred while formatting the Original transaction data in
MADA ISO Message Formatter.
IPAY0860016 Problem occurred while formatting the Original transaction data for
Merchant Initiated transactions in MADA ISO Message Formatter.
IPAY0860017 Problem occurred while validating the Recurring Transaction data in
MADA ISO Formatter.
```
```
IPAY0860018 Problem in getting the key exchange values for MAC generation.
IPAY08 60019 Problem occurred while generating the MAC values.
```
IPAY0860020 MAC key is empty not able to generate MAC values.

```
IPAY0880001 URPay Transaction is not enabled.
IPAY0880002 Token generation missing data.
```
IPAY0880003 Token generation response is empty.

IPAY0880004 Problem occuerd while generating Token.

```
IPAY0880005 Problem occurred while inserting URPay API details table.
IPAY0880006 Problem occurred while selecting URPay otp auth table.
```
IPAY0880007 Problem occuerd while performing URPay Transaction.

```
IPAY0880008 OTP token data is not available.
IPAY0880009 Token is empty.
```

©2024 API Guide Page 310 of 313

IPAY0880010 OTP validation response is empty.

```
IPAY0880011 Problem occurred while validating URPay otp.
IPAY0880012 Problem occurred while updating URPay API details table.
```
IPAY0880013 Problem occurred while updating URPay details.

```
IPAY0880016 OTP Reverse redemption response is empty.
IPAY0880017 Problem occurred while inserting URPay log details.
```
IPAY0880018 Problem occurred while deleting vpas pares details.

IPAY0880019 Problem occuerd while generating Otp.

```
IPAY0880020 Problem occuerd while proccessing resend Otp.
IPAY0880021 Problem occuerd while validating Otp.
```
IPAY0800061 Please try after sometime.

IPAY0100335 Duplicate Invoice ID


©2024 API Guide Page 311 of 313

## HANDLING FINAL RESPONSE FROM PAYMENT GATEWAY

**Handling Transaction Response:**

```
 By decrypting “ trandata” Merchant can able to get the JSON Response. JSON response
contains all the required success transaction data.
```
**Handling Failure Transaction Response:**

```
Step1:
From payment Gateway Response, Merchant needs to check the “trandata” first.
If the “trandata” not null.
By decrypting the trandata Merchant can able to get the failure transaction description by
extracting the key “result”.
If “result” is null then merchant needs to use the key “errorText” inside “trandata” to
get failure description.
```
```
Step 2:
If “trandata” is null or empty, then merchant needs to do follow below steps.
```
```
Step 3 :
To get Error Description: Use Parameter Key name “ErrorText”.
```
```
Step 4 :
To get Error Code: Use parameter key name "Error”.
```
```
Step 5 :
To get Transaction Id: Use parameter key “tranid" this value can be null or empty.
```
```
Step 6 :
To get Payment Id: Use parameter key "paymentid" this value can be null or empty.
```

ARB Merchant Implementation Guide - REST APIs | Chapter 5 Index

© 20 24 AlRajhi Bank API Guide Page 312 of 313

## CHAPTER 5 INDEX

**A**

##### API ................................................. 184, 209

Attributes17, 26, 34, 41, 49, 56, 66, 74, 82,
121, 133, 142, 150

**B**

Bank Hosted setup .................................... 12

**C**

Callback ................................................... 12

checkout .................................................. 12

**D**

Decryption .............................. 245, 248, 250

**Description** 16, 17, 26, 28, 33, 34, 41, 43, 48,

```
49, 56, 60, 65, 66, 74, 76, 77, 82, 89, 93,
128 , 132, 133, 142, 144, 150, 154
```
**E**

Encryption ....................... 245, 248, 250, 257
**Error Code** ................ 16, 33, 48, 65, 93, 132

**F**

Final Response28, 43, 60, 76, 89, 103, 113,
119, 123, 144, 154, 195, 206

flow .......................... 15, 32, 65, 80, 131, 148

**I**

Initial Response26, 27, 41, 42, 56, 58, 74, 75,
1 01, 142, 143, 170, 193, 204, 209

```
J
```
##### JAVA ...................................................... 245

```
K
```
```
Known Error Codes .................................. 252
```
```
M
```
```
Merchant Hosted setup .............................. 12
```
```
P
```
```
Payment Gateway17, 18, 21, 34, 35, 49, 50,
66, 94, 95, 98, 99, 113, 126, 128, 133, 134,
137, 164, 167, 177, 188, 189, 198, 199, 212
Payment ID ............................................ 127
PCI – DSS ................................................. 8
PG101, 103, 113, 164, 167, 170, 177, 179, 181,
184, 193, 204, 206, 212
Plain Trandata 13, 17, 19, 20, 22, 23, 24, 30,
34, 36, 37, 38, 39, 45, 49, 51, 52, 53, 54,
62, 66, 68, 69, 70, 71, 72, 79, 82, 83, 85,
86, 87, 91, 133, 135, 136, 138, 139, 140,
146, 150, 152, 153, 156, 161, 162, 191, 192,
201, 202, 211, 227
```
```
R
```
```
Resource key .......................................... 10
RESTFUL API’s .......................................... 13
```
```
T
```
```
Target Audience ......................................... 8
```

ARB Merchant Implementation Guide - REST APIs | Chapter 5 Index

© 20 24 AlRajhi Bank API Guide Page 313 of 313

Test Instruments ...................................... 13

Tranportal ID .............. 10, 17, 34, 49, 66, 133

**Tranportal password** ...... 10, 17, 34, 49, 133
Transaction ID ................................. 126, 127

```
U
```
```
Users ........................................................ 8
```

