# Easebuzz Handler

## Installation and usage

### Install via composer
```
composer require scalexy/easebuzz
```
### Add to .env
```
EASEBUZZ_KEY=XXXXXXXXXX
EASEBUZZ_SALT=XXXXXXXXXX
```
### Add to config/services.php
```
'easebuzz' => [
	'key' => env('EASEBUZZ_KEY'),
	'salt' => env('EASEBUZZ_SALT'),
],
```

## Why

We wanted it, we built it.

## Opensource

We licensed under the MIT License so that anyone can use it. But we don't intend to actively develop it. You are free to fork it and continue development. PR(s) will probably be ignored. 

## Urgent help

If there is some small bug that you need fixed like adding a new param, open an issue and we'll look into it. Don't do it to request new features, we'll close it.

## Security issues

If there are any security issues, please mail us security@scalexy.com

## Features implemented

- Neobanking
- - Contacts
- - - Create contact
- - - Retrieve all contacts
- - Beneficiary Accounts
- - - Add beneficiary account
- - - Retrieve beneficiary list
- - Payouts
- - - Transfers
- - - - Initiate payout
- - - Accounts
- - - - Fetch Virtual Account
- - InstaCollect
- - - Virtual Accounts
- - - - Create account