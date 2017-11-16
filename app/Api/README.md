SECAPAY WATCH API 1.0
==

The Secapay API Watch provides a public system for performing functionalities such as:

 - Report Fraudulent Transactions
 - View or Search Fraudulent transactions

The primary purpose of the API is to have a trusted system that can be used to verify Phone Numbers, Emails and Bank Accounts that may be involved in SCAM or Fraud.

Once generated, you may be able to see your token to access the API and token will remain valid until re-generated.

#Documentation

The Secapay Watch API is a REST API that maintains a fairly uniform pattern both in the implementation and style.

Additional information can be achieved by simply specifying the type of information you want to include. e.g.:

	/frauds/search?keyword=email,account_name

The includable parameters are listed where applicable.

API endpoints below are listed without the base URI:

## Authentication

	In order to make authenticated calls, you only need to include the token obtained from auth/authenticate.

	Authorization: token

	This will allow you to call protected endpoints that require user authentication, e.g 'users/me'

		API prefix api/vi:

### Basic Authentication
Basic authentication is the simple default authentication that can be used to obtain a token from the API.
Tokens are valid for 1 hour(60 minutes) from the time obtained.

	Endpoint:		/auth/authenticate/
	Http method:	post
	Body:
		email:		email
		password:	password

	Response
		Successful
			Http code:	200
			[
				token : string
			]
		Error
			Http code : 401
			[
				message : invalid_credentials
			]
			Http code : 500
			[
				message : could_not_create_token
			]

### User Features
Functionalities to create, delete, retrieve or modify user information through the API

### Create New User

	Endpoint : 					/users
	Http method :				post

	Body : 
		first_name:				string
		last_name:				string
		email:					string
		password:				string
		phone_number:			string

	Response
		Successful
			Http code:	200
			[
				data : [
            		messsage:	New User created successfully
					{user}...
				]
			]
		Error
			Http code: 422
				[
					message : Could not create User. Errors...
				]


### Retrieve User Information
	
	Endpoint :		/users/me
	Http method :	get

	Response
		Successful
			Http code :	200
			[
				{user}
			]

### Retrieve User All Reported Cases

	Endpoint:		/frauds/user/{user}
	Http method :	get

	Response
		Successfull
			Http code : 200
			[
				{fraudcase(s)}
			]
			
### Update User Information
    Endpoint:      /users/{userId}/
    Http method:    put
    
    Body:
        first_name:     string
        last_name:      string
        email:   		string
        password:       string

    Response
        Successful
            Http code: 200
            [
            	data : [
            		messsage:	Update was successfull
					{user}...
				]
            ]
        Error
            Http code: 422
            [
                message : Could not update User. Errors...
            ]


### Delete User Information
    Endpoint:      /users/{userId}/
    Http method:    delete
    

    Response
        Successful
            Http code: 200
            [
                message : User ID ". userId ." Deleted Successfully
            ]
        Error
            Http code: 422
            [
                message : Could not delete User. Errors...
            ]


## Fraud Case
Functionalities to create, delete, retrieve or modify users reported case through the API.

### Retrieve Fraud Cases

	Endpoint : 		/frauds
	Http method : 	get
	Includes : accounts, emails, websites, mobiles

	Response
		Succesful
			Http code : 200
			[
				data : [
					{fraudcases}...
				]
			]	

### Create FraudCase

	Endpoint : 					/frauds
	Http method :				post

	Body : 
		scammer_name:			string
		scammer_real_name:		string
		amount_scammed_off:		decimal
		user_id:				integer
		severity_id:			integer
		item_type_id:			integer
		fraud_category_id:		integer
		scam_start_date:		datetime
		scam_realization_date:	datetime
		item_name:				string
		account:				data: [
		    						{account_no:integer,
		    						 account_name:string,bank_id:integer}...
		                        ]
		email:					data: [
		                            {email:string}...
		                        ]
		website_url:			data: [
				                    {website_url:string, bank_id:integer}...
				                ]
		phone_number:			data: [
					                {phone_number:string}...
						        ]
		fraud_file				base64 string

	Response
		Successful
			Http code:	200
			[
				{fraudCase}
			]
		Error
			Http code: 422
				[
					message : Could not create FraudCase. Errors...
				]


### Update FraudCase

    Endpoint:      /frauds/{fraudId}
    Http method:    put
    
    Body : 
		scammer_name:			string
		scammer_real_name:		string
		amount_scammed_off:		decimal
		user_id:				integer
		severity_id:			integer
		item_type_id:			integer
		fraud_category_id:		integer
		scam_start_date:		datetime
		scam_realization_date:	datetime
		item_name:				string
		account:				data: [
		                            {account_no:integer,
		                             account_name:string,bank_id:integer}...
		                        ]
		email:					data: [
		                            {email:string}...
		                        ]
		website_url:			data: [
				                    {website_url:string, bank_id:integer}...
				                ]
		phone_number:			data: [
					                {phone_number:string}...
						        ]
		fraud_file				base64 string

    Response
        Successful
            Http code: 200
            [
                {fraudcase}
            ]
        Error
            Http code: 422
            [
                message : Could not update FraudCase. Errors...
            ]

### Delete FraudCase

    Endpoint:      /frauds/{fraudId}/
    Http method:    delete
    

    Response
        Successful
            Http code: 200
            [
                message : Fraud Case ". fraudId ." Deleted Successfully;
            ]
        Error
            Http code: 422
            [
                message : Could not delete fraudcase. Errors...
            ]

### Search for Keyword

	Endpoint :		/frauds/search?keyword={keyword}
	Http method :	get
	Includes :		fraudcase, users

	Response
		Successful
			Http code :	200
			[
				{fraudcase}
			]


### Retrieve Bank Information
	
	Endpoint :		/banks
	Http method :	get

	Response
		Successful
			Http code :	200
			[
				{banks}
			]

### Retrieve Severity Information
	
	Endpoint :		/severities
	Http method :	get

	Response
		Successful
			Http code :	200
			[
				{severity}
			]

### Retrieve Item types Information
	
	Endpoint :		/itemtypes
	Http method :	get

	Response
		Successful
			Http code :	200
			[
				{itemtypes}
			]

### Retrieve Fraud Categories Information
	
	Endpoint :		/frauds/categories
	Http method :	get

	Response
		Successful
			Http code :	200
			[
				{fraudcategories}
			]

